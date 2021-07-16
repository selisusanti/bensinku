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

Route::prefix( '/' )->group(function() {
    Route::get ( '', 'AuthController@loginPage' );
}); 

Route::prefix( 'login' )->group(function() {
    Route::post( '', 'AuthController@login' );
});

Route::prefix( 'logout' )->group(function() {
    Route::get ( '', 'AuthController@logout' );
});

Route::prefix( 'home' )->group(function() {
    Route::get ( '', 'HomeController@viewHome');
    Route::post ( '/data', 'HomeController@getData');
});