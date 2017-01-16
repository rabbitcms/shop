<?php
declare(strict_types=1);
namespace RabbitCMS\Shop\Contracts;

/**
 * Interface InteractiveItemContract.
 * @package RabbitCMS\Shop
 */
interface InteractiveItemContract
{
    /**
     * Call on order paid.
     *
     * @param int $count
     *
     * @return void
     */
    public function itemPaid(int $count = 1);

    /**
     * Call on order paid revert.
     *
     * @param int $count
     *
     * @return void
     */
    public function itemUnpaid(int $count = 1);
}
