<?php
declare(strict_types=1);
namespace RabbitCMS\Shop\Contracts;

/**
 * Interface ItemContract.
 * @package RabbitCMS\Shop
 */
interface ItemInterface
{
    /**
     * Get item identifier.
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Get item caption.
     *
     * @return string
     */
    public function getCaption(): string;

    /**
     * Get item description.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get item price.
     *
     * @return float
     */
    public function getPrice(): float;
}
