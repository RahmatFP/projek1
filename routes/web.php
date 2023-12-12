<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'poli'], function ($router){
    $router->get('/','policontroller@index');
    $router->get('/{id}','policontroller@show');
    $router->post('/', 'policontroller@store');
    $router->delete('/{id}','policontroller@destroy');
    $router->put('/{id}','policontroller@update');
});

$router->group(['prefix'=>'pegawai'], function ($router){
    $router->get('/','pegawaicontroller@index');
    $router->get('/{id}','pegawaicontroller@show');
    $router->post('/', 'pegawaicontroller@store');
    $router->delete('/{id}','pegawaicontroller@destroy');
    $router->put('/{id}','pegawaicontroller@update');
});

$router->group(['prefix'=>'pasien'], function ($router){
    $router->get('/','pasiencontroller@index');
    $router->get('/{id}','pasiencontroller@show');
    $router->post('/', 'pasiencontroller@store');
    $router->delete('/{id}','pasiencontroller@destroy');
    $router->put('/{id}','pasiencontroller@update');
});
$router->get('/migration','migrationcontroller@index');