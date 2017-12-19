<?php
declare(strict_types=1);

namespace RabbitCMS\Shop;

use RabbitCMS\Modules\ModuleProvider as BaseModuleProvider;
use RabbitCMS\Modules\Support\Facade\Modules;

/**
 * Class ModuleProvider
 * @package RabbitCMS\Shop
 */
class ModuleProvider extends BaseModuleProvider
{
    public function register()
    {
        parent::register();
    }

    /**
     * Fetch module name
     *
     * @return string
     */
    protected function name(): string
    {
        return Modules::detect(get_class($this))->getName();
    }
}
