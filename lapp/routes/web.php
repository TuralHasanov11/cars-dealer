<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CarModelsController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;


// Pages
Route::get('/', [PagesController::class, 'index'])->name('home');

Route::prefix('search')->name('search.')->group(function(){
    Route::get('/', [SearchController::class, 'index'])->name('index');
    Route::get('/detailed', [SearchController::class, 'detailed'])->name('detailed');
});

Auth::routes();

Route::resource('brands', BrandsController::class);
Route::resource('brands.models', CarModelsController::class);
Route::resource('equipment', EquipmentController::class);

Route::prefix('cars')->name('cars.')->group(function(){
    Route::get('/', [CarsController::class, 'index'])->name('index');
    Route::get('/create', [CarsController::class, 'create'])->name('create');
    Route::get('/bookmarks',[CarsController::class, 'bookmarks'])->name('bookmarks');
    Route::get('/{car}', [CarsController::class, 'show'])->name('show');
    Route::get('/{car}/edit', [CarsController::class, 'edit'])->name('edit');
    Route::get('/{car}/bookmark', [CarsController::class, 'addBookmark'])->name('bookmark');
    Route::get('/{car}/bookmark/remove', [CarsController::class, 'removeBookmark'])->name('bookmark.remove');
    Route::post('/', [CarsController::class, 'store'])->name('store');
    Route::put('/{car}', [CarsController::class, 'update'])->name('update');
    Route::delete('/{car}', [CarsController::class, 'destroy'])->name('destroy');
});

Route::prefix('user')->name('user.')->middleware(['auth'])->group(function(){
    Route::get('/cars', [UserController::class, 'cars'])->name('cars.index');
});

Route::prefix('admin')->name('admin.')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('cars', [AdminController::class, 'cars'])->name('cars');
    Route::get('cars/{car}', [AdminController::class, 'showCar'])->name('showCar');
    Route::delete('cars/{car}', [AdminController::class, 'destroyCar'])->name('destroyCar');
    
    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::get('users/{user}', [AdminController::class, 'showUser'])->name('showUser');
    Route::delete('user/{user}', [AdminController::class, 'destroyUser'])->name('destroyUser');
});
