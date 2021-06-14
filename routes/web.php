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
use App\Http\Controllers\ParserController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;


Route::get('/', function () {
    return view('welcome');
});
//account
Route::group(['middleware' => 'auth'], function() {
Route::group(['prefix' => 'account'], function() {
	Route::get('/', AccountController::class)->name('account');
	Route::get('/logout', function() {
		\Auth::logout();
		return redirect()->route('login');
	})->name('account.logout');
});
//admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
	Route::resource('/categories', AdminCategoryController::class);
	Route::resource('/news', AdminNewsController::class);
});
});

//news
Route::get('/news', [NewsController::class, 'index'])
	->name('news');
Route::get('/news/{news}', [NewsController::class, 'show'])
	->where('id', '\d+')
    ->name('news.show');

Route::get('/sessions', function() {
	session(['newsession' => 'example text']);
	if(session()->has('newsession')) {
		//dd(session()->get('newsession'));
		session()->remove('newsession');
		//dd(session()->all());
	}
	echo "Сессия не установлена";

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/parser', [ParserController::class, 'index']);

Route::group(['middleware' => 'guest'], function() {
	Route::get('/login/vk', [SocialController::class, 'login'])
		->name('vk.login');
	Route::get('/callback/vk', [SocialController::class, 'callback'])
		->name('vk.callback');
});