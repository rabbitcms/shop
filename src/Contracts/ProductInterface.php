<?php
declare(strict_types=1);

namespace RabbitCMS\Shop\Contracts;

/**
 * Interface ProductInterface
 * @package RabbitCMS\Shop\Contracts
 */
interface ProductInterface
{
    const TYPE_GROUP = 0;
    const TYPE_PRODUCT = 1;
    const TYPE_COMBINED = 2;

    /**
     * @return string
     */
    public function getCaption(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getArticle(): string;

    /**
     * @param int $type
     *
     * @return PriceInterface
     */
    public function getPrice(int $type = PriceInterface::TYPE_DEFAULT): PriceInterface;
}
