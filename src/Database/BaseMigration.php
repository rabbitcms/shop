<?php
declare(strict_types=1);

namespace RabbitCMS\Shop\Database;

use Illuminate\Database\Migrations\Migration;
use RabbitCMS\Modules\Support\Facade\Modules;

/**
 * Class BaseMigration
 * @package RabbitCMS\Shop\Database
 */
class BaseMigration extends Migration
{
    /**
     * @param string $table
     *
     * @return string
     * @throws \RabbitCMS\Modules\Exceptions\ModuleNotFoundException
     */
    public function getTable(string $table): string
    {
        return Modules::detect(__CLASS__)->config('table_prefix') . $table;
    }
}
