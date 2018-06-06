<?php

use Illuminate\Routing\Router;

$locale = LaravelLocalization::setLocale() ?: App::getLocale();
$router->get('/', [
    'as' => $locale . '.blog',
    'uses' => 'PublicController@index',
    'middleware' => config('asgard.blog.config.middleware'),
]);


/** @var Router $router */
$router->group(['prefix' => 'news'], function (Router $router) {
    $locale = LaravelLocalization::setLocale() ?: App::getLocale();

    $router->get('/{slug}', [
        'as' => $locale . '.blog.slug',
        'uses' => 'PublicController@show',
        'middleware' => config('asgard.blog.config.middleware'),
    ]);



});


$router->group(['prefix' => 'blog'], function (Router $router) {

    $router->get('/page/{numberPage}', [
        'as' => 'public.blog.numberPage',
        'uses' => 'PublicController@index',
        'middleware' => config('asgard.blog.config.middleware'),
    ]);
});


/** @var Router $router */
/*$router->group(['prefix' => 'blog'], function (Router $router) {
    $locale = LaravelLocalization::setLocale() ?: App::getLocale();
    $router->get('posts', [
        'as' => $locale . '.blog',
        'uses' => 'PublicController@index',
        'middleware' => config('asgard.blog.config.middleware'),
    ]);
    $router->get('posts/{slug}', [
        'as' => $locale . '.blog.slug',
        'uses' => 'PublicController@show',
        'middleware' => config('asgard.blog.config.middleware'),
    ]);

})*/;
