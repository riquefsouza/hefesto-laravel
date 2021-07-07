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

    $router->get('', 'App\Http\Controllers\HomeController@index')->name('showHome');
    $router->get('login', 'App\Http\Controllers\LoginController@index')->name('showLogin');
    $router->get('accessDenied', 'App\Http\Controllers\AccessDeniedController@index')->name('showAccessDenied');

    $router->get('changePassword', 'App\Http\Controllers\ChangePasswordController@index')->name('showChangePassword');
    $router->post('changePassword/save', 'App\Http\Controllers\ChangePasswordController@save')->name('saveChangePassword');

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

    $router->get('admProfile', 'App\Http\Controllers\AdmProfileController@index')->name('listAdmProfile');
    $router->get('admProfile/{id}', 'App\Http\Controllers\AdmProfileController@edit')->name('editAdmProfile');
    $router->post('admProfile/save', 'App\Http\Controllers\AdmProfileController@save')->name('saveAdmProfile');
    $router->delete('admProfile/{id}', 'App\Http\Controllers\AdmProfileController@delete')->name('deleteAdmProfile');

    $router->get('admMenu', 'App\Http\Controllers\AdmMenuController@index')->name('listAdmMenu');
    $router->get('admMenu/{id}', 'App\Http\Controllers\AdmMenuController@edit')->name('editAdmMenu');
    $router->post('admMenu/save', 'App\Http\Controllers\AdmMenuController@save')->name('saveAdmMenu');
    $router->delete('admMenu/{id}', 'App\Http\Controllers\AdmMenuController@delete')->name('deleteAdmMenu');

    $router->get('admUser', 'App\Http\Controllers\AdmUserController@index')->name('listAdmUser');
    $router->get('admUser/{id}', 'App\Http\Controllers\AdmUserController@edit')->name('editAdmUser');
    $router->post('admUser/save', 'App\Http\Controllers\AdmUserController@save')->name('saveAdmUser');
    $router->delete('admUser/{id}', 'App\Http\Controllers\AdmUserController@delete')->name('deleteAdmUser');

});
