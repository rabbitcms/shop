<?php
declare(strict_types=1);
namespace RabbitCMS\Shop\Contracts;

/**
 * Interface ItemContract.
 * @package RabbitCMS\Shop
 */
interface ItemContract
{
    /**
     * Get item identifier.
     *
     * @return int
     */
    public function getItemId(): int;

    /**
     * Get item caption.
     *
     * @return string
     */
    public function getItemCaption(): string;

    /**
     * Get item description.
     *
     * @return string
     */
    public function getItemDescription(): string;

    /**
     * Get item price.
     *
     * @return float
     */
    public function getItemPrice(): float;
}
