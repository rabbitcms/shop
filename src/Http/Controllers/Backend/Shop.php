<?php
declare(strict_types=1);

namespace RabbitCMS\Shop\Http\Controllers\Backend;


use RabbitCMS\Backend\Http\Controllers\Backend\Controller;

class Shop extends Controller
{
    public function __invoke()
    {
        return $this->view('main');
    }
}