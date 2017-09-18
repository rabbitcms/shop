<?php
declare(strict_types=1);

namespace RabbitCMS\Shop\Entities\Concerns;

use RabbitCMS\Modules\Support\Facade\Modules;

/**
 * Trait HasTablePrefix
 * @package RabbitCMS\Shop\Entities\Concerns
 */
trait HasTablePrefix
{
    /**
     * @return string
     */
    public function getTable(): string
    {
        return Modules::detect(get_class($this))->config('table_prefix') . parent::getTable();
    }
}
