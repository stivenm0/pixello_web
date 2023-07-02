<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('user/image/{filename}', [UserController::class, 'getImage'])->name('user.image');

    Route::get('/profile/{id}', [UserController::class, 'profile'])->name('profile');

    Route::get('/configuracion', [UserController::class, 'config' ])->name('config');

    Route::post('/configuracion', [UserController::class, 'update'] )->name("user.update");

    Route::get('/users/{search?}', [UserController::class, 'index'])->name('users');




    Route::get('image/{filename}', [ImageController::class, 'getImage'])->name('img');

    Route::get('imagen/{id}', [ImageController::class, 'show'])->name('img.details');

    Route::get('/imagen/edit/{id}', [ImageController::class, 'edit'])->name('img.edit');

    Route::post('/imagen/update', [ImageController::class, 'update'])->name('img.update');

    Route::get('/imagen/delete/{id}', [ImageController::class, 'destroy'])->name('img.delete');

    Route::resource('/subir-image', ImageController::class)->names([
        'index'=> 'image.new',
        'store' => 'image.create'
    ]);


    Route::get('/likes', [LikeController::class, 'likes'])->name('likes');

    Route::get('/like/{image_id}', [LikeController::class, 'like'])->name('like.save');

    Route::get('/dislike/{image_id}', [LikeController::class, 'dislike'])->name('like.delete');


    Route::get('/comment/delete/{id} ', [CommentController::class, 'delete'])->name('comment.delete');

    Route::post('/comment/save', [CommentController::class, 'save'])->name('comment.save');

});





Route::fallback(function(){
    return view('E404');
});