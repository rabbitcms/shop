<?php
declare(strict_types=1);

namespace RabbitCMS\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RabbitCMS\Shop\Contracts\ItemContract;

/**
 * Class Product
 * @package RabbitCMS\Shop
 * @property-read int $id
 * @property string $caption
 * @property string $description
 * @property float $price
 * @property bool $enabled
 *
 */
class Product extends Model implements ItemContract
{
    use SoftDeletes;
    protected $table = 'shop2_products';

    /**
     * Get item identifier.
     *
     * @return int
     */
    public function getItemId(): int
    {
        return $this->getKey();
    }

    /**
     * Get item caption.
     *
     * @return string
     */
    public function getItemCaption(): string
    {
        return $this->caption;
    }

    /**
     * Get item description.
     *
     * @return string
     */
    public function getItemDescription(): string
    {
        return $this->description;
    }

    /**
     * Get item price.
     *
     * @return float
     */
    public function getItemPrice(): float
    {
        return $this->price;
    }
}
