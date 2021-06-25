<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** @var \Laravel\Lumen\Routing\Router $router */

Route::get('/', function () {
    return view('welcome');
});

//$router->get('admParameterCategory', 'AdmParameterCategoryController@index');
//Route::get('/admParameterCategory', 'App\Http\Controllers\AdmParameterCategoryController@index');

$router->group(['prefix' => '/'], function () use ($router) {

    $router->get('admParameterCategory', 'App\Http\Controllers\AdmParameterCategoryController@index');

});