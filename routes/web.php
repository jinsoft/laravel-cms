<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('/');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('login', 'AuthController@showLoginForm');
    Route::post('login', 'AuthController@login')->name('admin.login');
    Route::post('logout', 'AuthController@logout')->name('admin.logout');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', 'AdminController@index')->name('admin');
        Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
        Route::get('/console', 'AdminController@console')->name('admin.console');

        Route::get('/setting/smtp', 'SettingController@smtp')->name('admin.setting.smtp');
        Route::get('/setting/info', 'SettingController@info')->name('admin.setting.info');
        Route::post('/setting/{uuid}', 'SettingController@infoUpdate')->name('admin.setting.infoUpdate');
        //消息
        Route::get('/message', 'MessageController@index')->name('admin.message');
    });
});


