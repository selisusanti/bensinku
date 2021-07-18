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

Route::prefix( 'promo' )->group(function() {
    Route::get('', 'PromoController@index');
    Route::post('getData', 'PromoController@getData');
    Route::get('add-promo', 'PromoController@formAddPromo');
    Route::get('edit-promo/{id}', 'PromoController@formEditPromo');
    Route::post('', 'PromoController@savePromo');
    Route::put('', 'PromoController@editPromo');
    Route::get ('delete-promo/{id}', 'PromoController@deletePromo');
});


Route::prefix( 'order-manager' )->group(function() {
    Route::get('', function () {
        return view('dashboard');
    });
});

Route::get('forgot-password', function () {
    return view('Auth.forgot-password');
});


// Authentication
Route::prefix('auth')->group(function(){
    Route::post('/send-email', 'AuthController@sendEmail');
    Route::put ( '/reset-password', 'AuthController@updatePassword' );
});


Route::get('change-password/{id}', 'AuthController@find' );


// Authentication
Route::prefix('product-settings')->group(function(){
    Route::get('', 'ProductSettingsController@index');
    Route::post('getData', 'ProductSettingsController@getData');
});