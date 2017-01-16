<?php
declare(strict_types=1);
namespace RabbitCMS\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use RabbitCMS\Shop\Contracts\InteractiveItemContract;
use RabbitCMS\Shop\Contracts\ItemContract;
use RuntimeException;

/**
 * Class Item.
 * @package RabbitCMS\Shop
 *
 * @property-read int $id
 * @property-read ItemContract $item
 * @property-read string $caption
 * @property-read string $description
 * @property-read float $price
 * @property-read int $count
 * @property-read Order $order
 * @property-read int $order_id
 */
class Item extends Model implements InteractiveItemContract
{
    protected $table = 'shop2_items';

    protected $casts = [
        'count' => 'int',
        'price' => 'float'
    ];

    /**
     * @param ItemContract $item
     * @param int $count
     */
    public function associate(ItemContract $item, int $count = 1)
    {
        if ($item instanceof Model) {
            $this->item()->associate($item);
            $this->count = $count;
            $this->caption = $item->getItemCaption();
            $this->description = $item->getItemDescription();
            $this->price = $item->getItemDescription();
        } else {
            throw new RuntimeException('Only eloquent entity allowed.');
        }
    }

    /**
     * @return MorphTo
     */
    protected function item(): MorphTo
    {
        return $this->morphTo('item');
    }

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * @inheritdoc
     */
    public function itemPaid(int $count = 1)
    {
        if ($this->item instanceof InteractiveItemContract) {
            $this->item->itemPaid($this->count);
        }
    }

    /**
     * @inheritdoc
     */
    public function itemUnpaid(int $count = 1)
    {
        if ($this->item instanceof InteractiveItemContract) {
            $this->item->itemUnpaid($this->count);
        }
    }
}
