<?php
declare(strict_types=1);

namespace RabbitCMS\Shop\Helpers;

use RabbitCMS\Shop\Contracts\PriceInterface;
use RabbitCMS\Shop\Contracts\ProductInterface;
use RabbitCMS\Shop\Entities;
use RabbitCMS\Shop\Models;

/**
 * Class CombinedProduct
 * @package RabbitCMS\Shop\Helpers
 */
class CombinedProduct extends SingleProduct
{
    /**
     * @return ProductInterface[]
     */
    public function getProducts(): array
    {
        // TODO: Implement getProducts() method.
    }

    /**
     * @inheritdoc
     */
    public function getPrice(int $type = PriceInterface::TYPE_DEFAULT): PriceInterface
    {
        /** @noinspection ReturnNullInspection */
        return new Models\Price(array_reduce(
            $this->getProducts(),
            function (float $price, Entities\Product $product) use ($type) {
                return $price + $product->getPriceFor($this->product, $type)->getPrice();
            },
            0.0
        ), $type);
    }
}
