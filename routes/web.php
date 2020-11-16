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

//Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/articles', [App\Http\Controllers\ArticlesController::class,
 'index'])->name('article.index')->middleware('auth'); // to add login autherization for access

Route::get('/articles/create', [App\Http\Controllers\ArticlesController::class, 'create']);
//Route::article('/articles/create', [App\Http\Controllers\ArticlesController::class, 'store']);


//Route::get('/', HomeController::class);
Route::get('/category', [CategoryController::class, 'index']);
//Route::get('/like', [LikeController::class, '']);
Route::get('/article', [ArticlesController::class, 'show']);
Route::get('/search', [ArticlesController::class, 'search']);
Route::get('/logout', 'UserController@logout');
// Route::group(['prefix' => 'auth'], function () {
//   Auth::routes();
// });

// check for logged in user
Route::middleware(['auth'])->group(function () {
  // show new article form
  Route::get('new-article', 'ArticlesController@create');
  // save new article
  //Route::article('new-article', 'ArticlesController@store');
  // edit article form
  Route::get('edit/{slug}', 'ArticlesController@edit');
  // update article
  //Route::article('update', 'ArticlesController@update');
  // delete article
  Route::get('delete/{id}', 'ArticlesController@destroy');
  // display user's all articles
 // Route::get('my-all-articles', 'UserController@user_articles_all');
  // display user's drafts
  //Route::get('my-drafts', 'UserController@user_articles_draft');
  // add comment
  //Route::article('comment/add', 'CommentController@store');
  // delete comment
  //Route::article('comment/delete/{id}', 'CommentController@destroy');
});

//users profile
//Route::get('user/{id}', 'UserController@profile')->where('id', '[0-9]+');
// display list of articles
//Route::get('user/{id}/articles', 'UserController@user_articles')->where('id', '[0-9]+');
// display single article
//Route::get('/{slug}', ['as' => 'article', 'uses' => 'ArticlesController@show'])->where('slug', '[A-Za-z0-9-_]+');