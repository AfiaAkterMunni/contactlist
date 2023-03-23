<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('auth')->group(function(){
    Route::get('/', [ContactController::class, 'show'])->name('contact');
    Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/contact/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
    Route::post('/contact/update/{id}', [ContactController::class, 'update'])->name('contact.update');
    Route::get('/contact/inactive/{id}', [ContactController::class, 'inactive'])->name('contact.inactive');
    Route::get('/contact/search', [ContactController::class, 'search'])->name('contact.search');


    Route::get('/categories', [CategoryController::class, 'show'])->name('categories');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
