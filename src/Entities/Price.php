<?php
declare(strict_types=1);

namespace RabbitCMS\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RabbitCMS\Shop\Contracts\PriceInterface;
use RabbitCMS\Shop\Contracts\PriceTypeInterface;
use RabbitCMS\Shop\Entities\Concerns\HasTablePrefix;

/**
 * Class Price
 * @package RabbitCMS\Shop\Entities
 * @property-read int     $id
 * @property-read int     $product_id
 * @property-read int     $base_id
 * @property int          $type
 * @property string       $name
 * @property float        $price
 * @property int          $priority
 * @property Carbon|null  $begin
 * @property Carbon|null  $end
 * @property-read Product $product
 * @property-read Product $base
 */
class Price extends Model implements PriceInterface
{
    use HasTablePrefix;

    protected $table = 'prices';

    /**
     * @var array
     */
    protected $attributes = [
        'type' => self::TYPE_DEFAULT
    ];

    protected $casts = [
        'price' => 'float',
        'type' => 'int'
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * @return BelongsTo
     */
    public function base(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'base_id');
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return (float)$this->price;
    }

    /**
     * Get price type.
     *
     * @return int
     */
    public function getType(): int
    {
        return (int)$this->type;
    }
}
