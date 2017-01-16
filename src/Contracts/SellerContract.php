<?php
declare(strict_types=1);
namespace RabbitCMS\Shop\Contracts;

/**
 * Interface SellerContract.
 *
 * @package RabbitCMS\Shop
 */
interface SellerContract
{
    /**
     * Set seller options.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setOption(string $key, $value);

    /**
     * Get seller options.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getOption(string $key, $default = null);

    /**
     * Get seller name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get seller enabled.
     *
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * Set seller enabled.
     *
     * @param bool $value
     * @return mixed
     */
    public function setEnabled(bool $value = true);
}
