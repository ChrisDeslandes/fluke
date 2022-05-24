<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => '/equipamentos'], function () use ($router) {
    $router->get('/', 'TestsController@index');
    $router->get('/{id}', 'TestsController@show');
    $router->post('/', 'TestsController@store');
    $router->put('/{id}', 'TestsController@update');
    $router->delete('/{id}', 'TestsController@destroy');
});
