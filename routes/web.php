<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * 
 * Admin route
*/

Route::prefix('admin')->group(function () {
    
});

Route::group([],function(){
    Route::get('/admin','Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Backend\RolesController');
    Route::resource('users', 'Backend\UsersController');


});