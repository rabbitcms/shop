<?php
declare(strict_types=1);

namespace RabbitCMS\Shop\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use RabbitCMS\Shop\Contracts\ItemInterface;
use RabbitCMS\Shop\Contracts\PriceInterface;
use RabbitCMS\Shop\Contracts\ProductInterface;
use RabbitCMS\Shop\Entities\Concerns\HasTablePrefix;
use RabbitCMS\Shop\Exceptions\ProductNotFound;
use RabbitCMS\Shop\Helpers\CombinedProduct;
use RabbitCMS\Shop\Helpers\SingleProduct;

/**
 * Class Product
 * @package RabbitCMS\Shop
 * @property-read int                  $id
 * @property-read int                  $type
 * @property-read int|null             $parent_id
 * @property string                    $name
 * @property string                    $article
 * @property string                    $caption
 * @property string                    $description
 * @property bool                      $enabled
 * @property-read Collection|Price[]   $prices
 * @property-read Product|null         $parent
 * @property-read Collection|Product[] $products
 */
class Product extends Model implements ItemInterface
{
    use SoftDeletes;
    use HasTablePrefix;

    protected $table = 'products';

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(Price::class, 'product_id');
    }

    /**
     * Get item identifier.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->getKey();
    }

    /**
     * @return string
     */
    public function getCaption(): string
    {
        return $this->caption ?: $this->parent->getCaption() ?? '';
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description ?: $this->parent->getDescription() ?? '';
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->getPriceFor($this->parent ?? $this)->getPrice();
    }


    /**
     * @param string $article
     *
     * @return ProductInterface
     * @throws ProductNotFound
     */
    public static function findByArticle(string $article): ProductInterface
    {
        /* @var self $variant */
        $variant = null;
        /* @var self $product */
        $product = null;
        $articles = explode('-', $article);
        /** @noinspection ReturnNullInspection */
        while (($part = array_shift($articles)) !== null) {
            $variant = self::query()->where([
                'parent_id' => $variant ? $variant->getKey() : null,
                'name' => $part
            ])->first();

            if ($variant === null) {
                throw new ProductNotFound("Product '{$article}' not found.");
            }

            if ($variant instanceof self && $variant->isProduct()) {
                $product = $variant;
            }
        }


        if ($product === null || count($articles) !== 0) {
            throw new ProductNotFound("Product '{$article}' not found.");
        }

        if ($variant->isCombined()) {
            return new CombinedProduct($variant, $product);
        }
        return new SingleProduct($variant, $product);
    }

    /**
     * @param Product $base
     *
     * @param int     $type
     *
     * @return PriceInterface
     */
    public function getPriceFor(Product $base, int $type = Price::TYPE_DEFAULT): PriceInterface
    {
        /* @var Price $price */
        $now = Carbon::now()->format($this->getDateFormat());
        $price = $this->prices()->getQuery()
            ->where('base_id', $base->getKey())
            ->where('type', $type)
            ->where(function (Builder $query) use ($now) {
                $query->whereNull('begin')
                    ->orWhere('begin', '<=', $now);
            })
            ->where(function (Builder $query) use ($now) {
                $query->whereNull('end')
                    ->orWhere('end', '>=', $now);
            })
            ->first();

        return $price;
    }

    /**
     * @return bool
     */
    public function isProduct(): bool
    {
        return $this->type === ProductInterface::TYPE_PRODUCT;
    }

    /**
     * @return bool
     */
    public function isVariant(): bool
    {
        return $this->parent_id !== null;
    }

    /**
     * @return bool
     */
    public function isCombined(): bool
    {
        return $this->type === ProductInterface::TYPE_COMBINED;
    }
}
