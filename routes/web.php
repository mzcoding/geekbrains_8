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

use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;


Route::get('/', function () {
    return view('welcome');
});

//admin
Route::group(['prefix' => 'admin'], function() {
	Route::resource('/categories', AdminCategoryController::class);
	Route::resource('/news', AdminNewsController::class);
});

//news
Route::get('/news', [NewsController::class, 'index'])
	->name('news');
Route::get('/news/{news}', [NewsController::class, 'show'])
	->where('id', '\d+')
    ->name('news.show');

Route::get('/collections', function() {
	 $collection = collect([
	 	10, 15, 20, 25,30,50,75,100
	 ]);

	 dd($collection->map(fn($item) => $item *2)->count());
});