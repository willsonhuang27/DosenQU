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
});

Route::get('/login', 'PageController@showLogin');

Route::get('/dashboard', 'UserController@showDashboard')->middleware(\App\Http\Middleware\AuthCheck::class);
Route::post('/doLogin', 'UserController@login');
Route::get('/logout', 'UserController@logout');

////grouping
//Route::group(['middleware'=>['checkAuth']],function(){
//    Route::get('/login', 'PageController@showLogin');
//    Route::post('/doLogin', 'UserController@login');
//});

