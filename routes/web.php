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
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => 'login'], function () {
Route::get('/home', 'HomeController@index')->name('home');
Route::get('payments', 'PagesController@payments')->name('payments');
Route::get('transfers', 'PagesController@transfers')->name('transfers');
Route::get('transactions', 'PagesController@transactions')->name('transactions');
Route::get('maintenance', 'PagesController@maintenance')->name('maintenance');

Route::post('payment', 'TransactionsController@payments')->name('payment');
Route::post('transfer', 'TransactionsController@transfers')->name('transfer');
Route::post('email', 'TransactionsController@email')->name('email');
Route::post('passwords', 'TransactionsController@passwords')->name('passwords');
    });

Route::group(['middleware' => 'cs'], function () {
Route::post('search', 'PagesController@accountsearch')->name('accountsearch');
Route::post('changeType/{id}', 'TransactionsController@changeType')->name('changeType');
Route::get('accounts', 'PagesController@deposits')->name('accounts');
Route::get('account/{id}', 'PagesController@show')->name('deposit.show');
Route::get('addcs', 'PagesController@addcs')->name('addcs');
Route::post('deposit/{id}', 'TransactionsController@deposit')->name('deposit');
Route::post('withdraw/{id}', 'TransactionsController@withdraw')->name('withdraw');
Route::post('registercs', 'TransactionsController@registercs')->name('registercs');
  });
