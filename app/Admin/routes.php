<?php

use Illuminate\Routing\Router;

Admin::routes();
Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('/produk_hukum/{id}/preview', 'ProdukHukumController@preview')->name('produk_hukum.preview');
    $router->resource('produk_hukum', ProdukHukumController::class);
});
