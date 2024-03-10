<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;


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

Route::get('/', [
    WelcomeController::class, 'index'
])->name('welcome');



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
    Route::get('/articles/search', function () {
        return view('article.search');
    })->name('article.search');

    Route::get('/article/{id}/{title}', [
        ArticleController::class, 'show'
    ])->middleware('articlePublished')->name('article.show');


    Route::post('/articles/create', [
        ArticleController::class, 'store'
    ])->name('article.store')->middleware('stuRole');
    Route::post('/articles/{article}/reupload', [
        ArticleController::class, 'reupload'
    ])->name('articles.reupload')->middleware('canreupload');



    Route::get('download/{file}', function ($file) {

        ini_set('memory_limit', '-1');

        set_time_limit(0);

        // Get the file path from the session
        $filePath = session('download_file');

        // Check if the file exists
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        // Set headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush(); // Flush system output buffer

        // Open the file in binary mode
        $fp = @fopen($filePath, "rb");

        // Output the file in chunks
        if ($fp !== false) {
            while (!feof($fp)) {
                // Read and output a chunk
                echo fread($fp, 8192);
                flush(); // Flush output buffer
            }

            // Close the file
            fclose($fp);
        } else {
            abort(500, 'Error opening file.');
        }

        // Delete the file
        unlink($filePath);
        exit;
    })->name('download.file');
});
