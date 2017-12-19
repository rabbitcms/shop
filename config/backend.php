<?php
declare(strict_types=1);

use RabbitCMS\Backend\Support\Backend;

return [
    'boot' => function (Backend $backend) {
        $backend->addAclResolver(
            function (Backend $backend) {
                $backend->addAclGroup('shop', trans('shop::acl.module'));
                $backend->addAcl('shop', 'products.read', trans('shop::acl.products.read'));
                $backend->addAcl('shop', 'products.write', trans('shop::acl.products.write'));
            }
        );
        $backend->addMenuResolver(function (Backend $menu) {
            $menu->addMenu(null, 'shop', trans('shop::menu.shop'), null, 'icon-cart', null, 30);
            $menu->addMenu(
                'shop',
                'products',
                trans('shop::menu.products'),
                route('backend.shop.products.index', [], false),
                'fa-angle-double-right',
                ['shop.products.read'],
                10,
                false
            );
        }, Backend::MENU_PRIORITY_MENU);
    },
    'requirejs' => [
        'rabbitcms/shop' => 'js/shop'
    ]
];
