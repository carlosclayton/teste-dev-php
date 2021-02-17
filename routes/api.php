<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {


    $api->group([
        'as' => 'api',
        'middleware' => [],
        'limit' => 50,
        'expires' => 1
    ], function ($api) {

        $api->group([
            'prefix' => 'users',
            'as' => 'users.',
        ], function ($api) {
            $api->get('/user', function (Request $request) {
                return response([
                    'data' => $request->user()
                ]);
            })->name('.user');
        });

        $api->group([
            'namespace' => 'App\Http\Controllers',
            'prefix' => 'brands',
            'as' => 'brands.'
        ], function ($api) {
            $api->get('/', 'BrandsController@index')->name('.index');
            $api->post('/', 'BrandsController@store')->name('.store');
            $api->put('/{brand}', 'BrandsController@update')->name('.update');
            $api->get('/{brand}', 'BrandsController@show')->name('.show');
            $api->delete('/{brand}', 'BrandsController@destroy')->name('.destroy');
        });

        $api->group([
            'namespace' => 'App\Http\Controllers',
            'prefix' => 'cars',
            'as' => 'cars.'
        ], function ($api) {
            $api->get('/', 'CarsController@index')->name('.index');
            $api->post('/', 'CarsController@store')->name('.store');
            $api->put('/{cars}', 'CarsController@update')->name('.update');
            $api->get('/{cars}', 'CarsController@show')->name('.show');
            $api->delete('/{cars}', 'CarsController@destroy')->name('.destroy');
        });
    });
});
