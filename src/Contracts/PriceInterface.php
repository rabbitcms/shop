<?php
declare(strict_types=1);

namespace RabbitCMS\Shop\Contracts;

/**
 * Interface PriceInterface
 * @package RabbitCMS\Shop\Contracts
 */
interface PriceInterface
{
    const TYPE_DEFAULT = 1;
    const TYPE_OLD = 2;

    /**
     * Get price value.
     * @return float
     */
    public function getPrice(): float;

    /**
     * Get price type.
     * @return int
     */
    public function getType(): int;
}
