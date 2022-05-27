<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () {
    return view('index');
});

$router->group(['prefix' => '/records'], function () use ($router) {
    $router->get('/', 'TestRecordsController@index');
    $router->get('/{test_record_id}', 'TestRecordsController@show');
    $router->post('/', 'TestRecordsController@store');
    $router->delete('/{test_record_id}', 'TestRecordsController@destroy');

    $router->get('/{test_record_id}/results', 'TestResultsController@index');
});

$router->group(['prefix' => '/results'], function () use ($router) {
    $router->get('/{test_result_id}', 'TestResultsController@show');
    $router->patch('/{test_result_id}', 'TestResultsController@update');
    $router->delete('/{test_result_id}', 'TestResultsController@destroy');

    $router->get('/{test_result_id}/items', 'TestItemsController@index');
});

$router->group(['prefix' => '/items'], function () use ($router) {
    $router->get('/{test_item_id}', 'TestItemsController@show');
    $router->delete('/{test_item_id}', 'TestItemsController@destroy');

    $router->get('/{test_item_id}/item_results', 'ItemResultsController@index');
});

$router->group(['prefix' => '/item_results'], function () use ($router) {
    $router->get('/{item_result_id}', 'ItemResultsController@show');
    $router->delete('/{item_result_id}', 'ItemResultsController@destroy');
});
