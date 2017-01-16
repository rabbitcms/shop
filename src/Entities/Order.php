<?php
declare(strict_types=1);
namespace RabbitCMS\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use RabbitCMS\Carrot\Eloquent\PrintableJson;
use RabbitCMS\Shop\Contracts\CustomerContract;
use RuntimeException;

/**
 * Class Order
 * @package RabbitCMS\Shop
 * @property-read int $id
 * @property int $status
 * @property-read CustomerContract $customer
 * @property array $options
 */
class Order extends Model
{
    use SoftDeletes;
    use PrintableJson;

    const STATUS_NEW = 0;
    const STATUS_PENDING = 1;
    const STATUS_PAID = 2;
    const STATUS_CANCELED = 10;
    const STATUS_REFUNDED = 11;

    protected $table = "shop2_orders";

    protected $casts = [
        'options' => 'array'
    ];

    /**
     * Seller class.
     * @var string
     */
    protected static $sellerClass = Seller::class;

    /**
     * @param CustomerContract $customer
     */
    public function associateCustomer(CustomerContract $customer)
    {
        if ($customer instanceof Model) {
            $this->customer()->associate($customer);
            $this->setOption('customer', array_merge(
                $customer->getCustomerOptions(),
                [
                    'phone' => $customer->getCustomerPhone(),
                    'email' => $customer->getCustomerEmail(),
                    'name' => $customer->getCustomerName(),
                    'address' => $customer->getCustomerAddress()
                ]
            ));
        } else {
            throw new RuntimeException('Only eloquent entity allowed.');
        }
    }

    /**
     * @param Seller $seller
     */
    public function associateSeller(Seller $seller)
    {
        $this->seller()->associate($seller);
    }

    /**
     * @return MorphTo
     */
    protected function customer(): MorphTo
    {
        return $this->morphTo('customer');
    }

    /**
     * @return BelongsTo
     */
    protected function seller(): BelongsTo
    {
        return $this->belongsTo(static::$sellerClass, 'seller_id');
    }

    /**
     * Set order option.
     *
     * @param string $key
     * @param mixed $option
     */
    public function setOption(string $key, $option)
    {
        $this->options = array_merge($this->options, [$key => $option]);
    }

    /**
     * @param string $class
     */
    public static function setSellerClass(string $class)
    {
        if (!class_exists($class)) {
            throw new RuntimeException("Seller class '{$class}' not found.");
        }
        static::$sellerClass = $class;
    }
}
