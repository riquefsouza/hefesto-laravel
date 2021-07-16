<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Autenticador;

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
//, 'middleware' => 'App\Http\Middleware\Autenticador'
$router->group(['prefix' => '/'], function () use ($router) {

    $router->get('', 'App\Http\Controllers\HomeController@index')->name('showHome');

    $router->get('login', 'App\Http\Controllers\LoginController@index')->name('showLogin');
    $router->post('login/enter', 'App\Http\Controllers\LoginController@login')->name('postLogin');
    $router->get('logout', 'App\Http\Controllers\LoginController@logout')->name('dologout');

    $router->get('accessDenied', 'App\Http\Controllers\AccessDeniedController@index')->name('showAccessDenied');

    $router->get('admin/changePasswordEdit', 'App\Http\Controllers\ChangePasswordController@index')->name('showChangePassword');
    $router->post('admin/changePasswordEdit/save', 'App\Http\Controllers\ChangePasswordController@save')->name('saveChangePassword');

    $router->get('admin/admParameterCategory', 'App\Http\Controllers\AdmParameterCategoryController@index')->name('listAdmParameterCategory');
    $router->get('admin/admParameterCategory/{id}', 'App\Http\Controllers\AdmParameterCategoryController@edit')->name('editAdmParameterCategory');
    $router->post('admin/admParameterCategory/save', 'App\Http\Controllers\AdmParameterCategoryController@save')->name('saveAdmParameterCategory');
    $router->delete('admin/admParameterCategory/{id}', 'App\Http\Controllers\AdmParameterCategoryController@delete')->name('deleteAdmParameterCategory');

    $router->get('admin/admParameter', 'App\Http\Controllers\AdmParameterController@index')->name('listAdmParameter');
    $router->get('admin/admParameter/{id}', 'App\Http\Controllers\AdmParameterController@edit')->name('editAdmParameter');
    $router->post('admin/admParameter/save', 'App\Http\Controllers\AdmParameterController@save')->name('saveAdmParameter');
    $router->delete('admin/admParameter/{id}', 'App\Http\Controllers\AdmParameterController@delete')->name('deleteAdmParameter');

    $router->get('admin/admPage', 'App\Http\Controllers\AdmPageController@index')->name('listAdmPage');
    $router->get('admin/admPage/{id}', 'App\Http\Controllers\AdmPageController@edit')->name('editAdmPage');
    $router->post('admin/admPage/save', 'App\Http\Controllers\AdmPageController@save')->name('saveAdmPage');
    $router->delete('admin/admPage/{id}', 'App\Http\Controllers\AdmPageController@delete')->name('deleteAdmPage');

    $router->get('admin/admProfile', 'App\Http\Controllers\AdmProfileController@index')->name('listAdmProfile');
    $router->get('admin/admProfile/{id}', 'App\Http\Controllers\AdmProfileController@edit')->name('editAdmProfile');
    $router->post('admin/admProfile/save', 'App\Http\Controllers\AdmProfileController@save')->name('saveAdmProfile');
    $router->delete('admin/admProfile/{id}', 'App\Http\Controllers\AdmProfileController@delete')->name('deleteAdmProfile');

    $router->get('admin/admMenu', 'App\Http\Controllers\AdmMenuController@index')->name('listAdmMenu');
    $router->get('admin/admMenu/{id}', 'App\Http\Controllers\AdmMenuController@edit')->name('editAdmMenu');
    $router->post('admin/admMenu/save', 'App\Http\Controllers\AdmMenuController@save')->name('saveAdmMenu');
    $router->delete('admin/admMenu/{id}', 'App\Http\Controllers\AdmMenuController@delete')->name('deleteAdmMenu');

    $router->get('admin/admUser', 'App\Http\Controllers\AdmUserController@index')->name('listAdmUser');
    $router->get('admin/admUser/{id}', 'App\Http\Controllers\AdmUserController@edit')->name('editAdmUser');
    $router->post('admin/admUser/save', 'App\Http\Controllers\AdmUserController@save')->name('saveAdmUser');
    $router->delete('admin/admUser/{id}', 'App\Http\Controllers\AdmUserController@delete')->name('deleteAdmUser');

});
