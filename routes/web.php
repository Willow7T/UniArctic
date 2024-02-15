<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    

    Route::get('/articles/create', [
        ArticleController::class, 'create'
    ])->name('article.create');
    Route::get('/articles/search', [
        ArticleController::class, 'search'
        ])->name('article.search');
    Route::post('/articles/create', [
        ArticleController::class, 'store'
    ])->name('article.store');
    Route::get('/article/{id}/{title}', [
        ArticleController::class, 'show'
    ])->name('article.show');


});

