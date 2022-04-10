<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyCRUDController;
use App\Http\Controllers\CategoryCRUDController;



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
// Route::resource('companies', CompanyCRUDController::class);     

 
Route::get('ajax-crud-datatable', [CompanyCRUDController::class, 'index']);
Route::post('store-company', [CompanyCRUDController::class, 'store']);
Route::post('edit-company', [CompanyCRUDController::class, 'edit']);
Route::post('delete-company', [CompanyCRUDController::class, 'destroy']);

// category
Route::get('category-crud-datatable', [CategoryCRUDController::class, 'categoryindex']);
Route::post('categorystore', [CategoryCRUDController::class, 'categorystore']);
Route::post('categoryedit', [CategoryCRUDController::class, 'categoryedit']);
Route::post('categorydelete', [CategoryCRUDController::class, 'categorydestroy']);

