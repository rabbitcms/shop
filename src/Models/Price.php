<?php
declare(strict_types=1);

namespace RabbitCMS\Shop\Models;

use RabbitCMS\Shop\Contracts\PriceInterface;
use RabbitCMS\Shop\Contracts\PriceTypeInterface;

/**
 * Class DefaultPrice
 * @package RabbitCMS\Shop\Helpers
 */
class Price implements PriceInterface
{
    /**
     * @var float
     */
    private $price;

    /**
     * @var int
     */
    private $type;

    /**
     * DefaultPrice constructor.
     *
     * @param float $price
     * @param int   $type
     */
    public function __construct(float $price, int $type = self::TYPE_DEFAULT)
    {
        $this->price = $price;
        $this->type = $type;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }
}
