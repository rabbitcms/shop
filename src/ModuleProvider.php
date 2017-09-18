<?php
declare(strict_types=1);

namespace RabbitCMS\Shop;

use Illuminate\Support\ServiceProvider;

/**
 * Class ModuleProvider
 * @package RabbitCMS\Shop
 */
class ModuleProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}
