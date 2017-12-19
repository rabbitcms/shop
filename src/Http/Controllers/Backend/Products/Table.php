<?php
declare(strict_types=1);

namespace RabbitCMS\Shop\Http\Controllers\Backend\Products;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RabbitCMS\Backend\Http\Controllers\Backend\Controller;
use RabbitCMS\Modules\Support\ModuleConcerns;
use RabbitCMS\Shop\DataProviders\ProductsDataProvider;

/**
 * Class Table
 * @package RabbitCMS\Shop\Http\Controllers\Backend\Products
 */
class Table extends Controller
{
    use ModuleConcerns;

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        return $this->view('products.table');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request): JsonResponse
    {
        return (new ProductsDataProvider())->response($request);
    }
}
