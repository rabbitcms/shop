<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use RabbitCMS\Shop\Database\BaseMigration;

/**
 * Class CreateShopProductsTable
 */
class CreateShopProductsTable extends BaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getTable('products'), function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('type');
            $table->unsignedInteger('parent_id')->nullable()->default(null);
            $table->string('name');
            $table->string('article');
            $table->string('caption')->nullable();
            $table->string('description')->nullable();
            $table->boolean('enabled');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id')
                ->references('id')->on($this->getTable('products'))
                ->onDelete('restricted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->getTable('products'));
    }
}
