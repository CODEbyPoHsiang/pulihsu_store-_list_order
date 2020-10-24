<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//API的路由

//顯示通訊錄所有資料清單
Route::get('/', 'MemberApiController@index');
// 查看單一聯絡人資料
Route::get('/{member_id?}', 'MemberApiController@show');
//新建通訊錄聯絡人資料
Route::post('/new', 'MemberApiController@store');
// 更新聯絡人資料
Route::put('/edit/{member_id}', 'MemberApiController@update');
// 刪除聯絡人資料
Route::delete('/delete/{member_id}', 'MemberApiController@destroy');