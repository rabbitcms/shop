<?php
declare(strict_types=1);

use Illuminate\Routing\Router;

/* @var Router $router */

$router->group(['prefix' => 'products', 'as' => 'products.'], function (Router $router) {
    $router->get('', 'Products\Table')->name('index');
    $router->post('', 'Products\Table@handle')->name('index');
    $router->get('create', 'Products\Create')->name('create');
    $router->post('create', 'Products\Create@handle')->name('create');
});

$router->get('{other?}','Shop')->where(['other'=>'.*']);
