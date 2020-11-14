<?php
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/articles', [App\Http\Controllers\ArticlesController::class,
 'index'])->name('article.index')->middleware('auth'); // to add login autherization for access

Route::get('/articles/create', [App\Http\Controllers\ArticlesController::class, 'create']);
Route::post('/articles/create', [App\Http\Controllers\ArticlesController::class, 'store']);


//Route::get('/', HomeController::class);
Route::get('/category', CategoryController::class);
Route::get('/like', LikeController::class);
Route::get('/article', [PostController::class, 'show']);
Route::get('/search', [PostController::class, 'search']);