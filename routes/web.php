<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TestController;

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

Route::get('/index', function(){
    return view('layouts.master');
});
Route::get('/category/id/{id}', [CategoryController::class, 'getCategoriesByID']);
Route::get('/categories', [CategoryController::class, 'getCategories']);
Route::get('/category/form/create', [CategoryController::class, 'inputCategoryCreate']);
Route::get('/category/form/edit/{id}', [CategoryController::class, 'inputCategoryEdit']);

Route::get('/test/id/{id}', [TestController::class, 'getTestsByID']);
Route::get('/tests', [TestController::class, 'getTests']);
Route::get('/test/form/create', [TestController::class, 'inputTestCreate']);
Route::get('/test/form/edit/{id}', [TestController::class, 'inputTestEdit']);

Route::get('/category/downoald/{id}', array('as'=> 'downloadCategory', 'uses' => 'App\Http\Controllers\CategoryController@downloadCategory'));
Route::get('/test/downoald/{id}', array('as'=> 'downloadTest', 'uses' => 'App\Http\Controllers\TestController@downloadTest'));

Route::post('category/create', [CategoryController::class, 'create']);
Route::post('test/create', [TestController::class, 'create']);

Route::put('/category/update/{id}', [CategoryController::class, 'update']);
Route::put('/test/update/{id}', [TestController::class, 'update']);

Route::delete('category/delete/{id}', [CategoryController::class, 'destroy']);
Route::delete('test/delete/{id}', [TestController::class, 'destroy']);