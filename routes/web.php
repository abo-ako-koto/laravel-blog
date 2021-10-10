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
// ぶろぐ一覧画面を表示
Route::get('/', 
[App\Http\Controllers\BlogController::class, 'showList'])->name
('blogs');
// ブログ登録画面を表示(規則的に表示はshow,実行はexe)
Route::get('/blog/create', 
[App\Http\Controllers\BlogController::class, 'showCreate'])->name
('create');
// ブログ登録
Route::post('/blog/store', 
[App\Http\Controllers\BlogController::class, 'exeStore'])->name
('store');
// ブログ詳細画面
Route::get('/blog/{id}', 
[App\Http\Controllers\BlogController::class, 'showDetail'])->name
('show');
// ブログ編集画面表示
Route::get('/blog/edit/{id}',
[App\Http\Controllers\BlogController::class, 'showEdit'])->name
('edit');
// ブログ編集
Route::post('/blog/update', 
[App\Http\Controllers\BlogController::class, 'exeUpdate'])->name
('update');
// ブログ削除
Route::post('/blog/delete/{id}', 
[App\Http\Controllers\BlogController::class, 'exeDelete'])->name
('delete');

Auth::routes();
