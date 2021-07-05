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

$router->group(['prefix' => '/'], function () use ($router) {

    $router->get('admParameterCategory', 'App\Http\Controllers\AdmParameterCategoryController@index')->name('listAdmParameterCategory');
    $router->get('admParameterCategory/{id}', 'App\Http\Controllers\AdmParameterCategoryController@edit')->name('editAdmParameterCategory');
    $router->post('admParameterCategory/save', 'App\Http\Controllers\AdmParameterCategoryController@save')->name('saveAdmParameterCategory');
    $router->delete('admParameterCategory/{id}', 'App\Http\Controllers\AdmParameterCategoryController@delete')->name('deleteAdmParameterCategory');

    $router->get('admParameter', 'App\Http\Controllers\AdmParameterController@index')->name('listAdmParameter');
    $router->get('admParameter/{id}', 'App\Http\Controllers\AdmParameterController@edit')->name('editAdmParameter');
    $router->post('admParameter/save', 'App\Http\Controllers\AdmParameterController@save')->name('saveAdmParameter');
    $router->delete('admParameter/{id}', 'App\Http\Controllers\AdmParameterController@delete')->name('deleteAdmParameter');

    $router->get('admPage', 'App\Http\Controllers\AdmPageController@index')->name('listAdmPage');
    $router->get('admPage/{id}', 'App\Http\Controllers\AdmPageController@edit')->name('editAdmPage');
    $router->post('admPage/save', 'App\Http\Controllers\AdmPageController@save')->name('saveAdmPage');
    $router->delete('admPage/{id}', 'App\Http\Controllers\AdmPageController@delete')->name('deleteAdmPage');

});
