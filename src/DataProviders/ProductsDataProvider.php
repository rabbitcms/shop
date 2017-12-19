<?php
/**
 * Created by PhpStorm.
 * User: lnkvisitor
 * Date: 30.09.2017
 * Time: 12:20
 */

namespace RabbitCMS\Shop\DataProviders;


use Illuminate\Database\Eloquent\Model as Eloquent;
use RabbitCMS\Carrot\Support\Grid2;
use RabbitCMS\Shop\Entities\Product;

class ProductsDataProvider extends Grid2
{
    /**
     * @return Eloquent
     */
    public function getModel(): Eloquent
    {
        return new Product();
    }
}