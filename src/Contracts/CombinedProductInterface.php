<?php
declare(strict_types=1);

namespace RabbitCMS\Shop\Contracts;

/**
 * Interface CombinedProductInterface
 * @package RabbitCMS\Shop\Contracts
 */
interface CombinedProductInterface extends ProductInterface
{
    /**
     * @return ProductInterface[]
     */
    public function getProducts(): array;
}
