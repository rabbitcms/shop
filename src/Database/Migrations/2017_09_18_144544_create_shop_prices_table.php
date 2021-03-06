<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use RabbitCMS\Shop\Database\BaseMigration;
use RabbitCMS\Shop\Contracts\PriceInterface;

class CreateShopPricesTable extends BaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('base_id');
            $table->unsignedInteger('type')->default(PriceInterface::TYPE_DEFAULT);
            $table->decimal('price');
            $table->unsignedTinyInteger('priority')->default(0);
            $table->dateTime('begin')->nullable();
            $table->dateTime('end')->nullable();
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')->on($this->getTable('products'))
                ->onDelete('restrict');

            $table->foreign('base_id')
                ->references('id')->on($this->getTable('products'))
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_prices');
    }
}
