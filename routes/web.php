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
    return redirect('/kakaopay');
});

Route::get('kakaopay', "KakaopayController@index");
Route::get('kakaopay/{id}', "KakaopayController@show")->name('kakaopay.show');

Route::prefix('kakaopay/single')->group(function () {
    Route::get('test', "KakaopaySingleController@test");
    Route::get('success', "KakaopaySingleController@success");
    Route::get('fail', "KakaopaySingleController@fail");
    Route::get('cancel', "KakaopaySingleController@cancel");
    Route::get('complete', "KakaopaySingleController@complete");
});

Route::prefix('kakaopay/subscription')->group(function () {
    Route::get('test', "KakaopaySubscriptionController@test");
    Route::post('test-recurring', "KakaopaySubscriptionController@testRecurring");
    Route::get('success', "KakaopaySubscriptionController@success");
    Route::get('fail', "KakaopaySubscriptionController@fail");
    Route::get('cancel', "KakaopaySubscriptionController@cancel");
    Route::get('complete', "KakaopaySubscriptionController@complete");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
