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


    // login route

    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');
        
  // loginout route

  Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit');
    
  // password reset route
  Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
  Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

  
});