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
    
    //Article Create Page under the Kernel Cheching Route with Role Middleware
    Route::get('/articles/create', [
        ArticleController::class, 'create'
    ])->name('article.create')->middleware('stuRole');
    Route::post('/articles/create', [
        ArticleController::class, 'store'
    ])->name('article.store')->middleware('stuRole');
    
    Route::get('/articles/search', [
        ArticleController::class, 'search'
        ])->name('article.search');
   
    Route::get('/article/{id}/{title}', [
        ArticleController::class, 'show'
    ])->name('article.show');
    
    //admin Panel
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admindashboard')->middleware('adminRole');



});

