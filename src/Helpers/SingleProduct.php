<?php
declare(strict_types=1);

namespace RabbitCMS\Shop\Helpers;

use RabbitCMS\Shop\Contracts\PriceInterface;
use RabbitCMS\Shop\Contracts\ProductInterface;
use RabbitCMS\Shop\Entities\Product;

/**
 * Class SingleProduct
 * @package RabbitCMS\Shop\Helpers
 */
class SingleProduct implements ProductInterface
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @var Product
     */
    protected $base;

    /**
     * CombinedProduct constructor.
     *
     * @param Product $base
     * @param Product $product
     *
     * @internal param string $price
     */
    public function __construct(Product $base, Product $product)
    {
        $this->base = $base;
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getCaption(): string
    {
        return $this->product->getCaption();
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->product->getDescription();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->product->name;
    }

    /**
     * @return string
     */
    public function getArticle(): string
    {
        return $this->product->article;
    }

    /**
     * @inheritdoc
     */
    public function getPrice(int $type = PriceInterface::TYPE_DEFAULT): PriceInterface
    {
        return $this->product->getPriceFor($this->base, $type);
    }
}
