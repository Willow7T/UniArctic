<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Livewire\FilterSearch;


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
Route::get('/MailTest', function () {
    return view('mail.mailtocoordinator');
})->name('mailtest');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', [
        HomeController::class, 'index'
        ])->name('home');
    
 
    
    //Article Create Page under the Kernel Cheching Route with Role Middleware
    Route::get('/articles/create', [
        ArticleController::class, 'create'
    ])->name('article.create')->middleware('stuRole');
   
    Route::get('/articles/{article}/download', [
        ArticleController::class, 'download'
        ])->name('articles.download')->middleware('candownload');
 


    
    //admin Dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admindashboard')->middleware('adminRole');
    //coordinator Dashboard
    Route::get('/coordinator/dashboard', function () {
        return view('coordinator.dashboard');
    })->name('coordinatordashboard')->middleware('coorRole');
    //Manager Dashboard
    Route::get('/manager/dashboard', function () {
        return view('manager.dashboard');
    })->name('managerdashboard')->middleware('manRole');


    //without Role Middleware
    Route::get('/articles/search', [
        ArticleController::class, 'search'
        ])->name('article.search');
   
    Route::get('/article/{id}/{title}', [
        ArticleController::class, 'show'
    ])->middleware('articlePublished')->name('article.show');
    

    Route::post('/articles/create', [
        ArticleController::class, 'store'
    ])->name('article.store')->middleware('stuRole');
    Route::post('/articles/{article}/reupload', [
        ArticleController::class, 'reupload'
        ])->name('articles.reupload')->middleware('canreupload');
});

