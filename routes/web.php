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

//Display Index Page
Route::get('/', 'MemberController@index');


// Populate Data in Edit Modal Form
Route::get('/{member_id?}', 'MemberController@show');


//create New Product
Route::post('', 'MemberController@store');


// update Existing Product
Route::put('/{member_id}', 'MemberController@update');


// delete product
Route::delete('/{member_id}', 'MemberController@destroy');