<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\HomeController;


// Routes related to TodoController
Route::get('/product', [TodoController::class, 'index'])->name('product.index');
Route::get('/product/create', [TodoController::class, 'create'])->name('product.create');
Route::post('/product', [TodoController::class, 'store'])->name('product.store');
Route::get('/product/{product}/edit', [TodoController::class, 'edit'])->name('product.edit');
Route::put('/product/{product}/update', [TodoController::class, 'update'])->name('product.update');
Route::delete('/product/{product}/destroy', [TodoController::class, 'destroy'])->name('product.destroy');
Route::get('/search', [TodoController::class, 'search'])->name('product.search');
Route::get('/product/suggestions', [TodoController::class, 'suggestions'])->name('product.suggestions');
Route::get('/upload', [TodoController::class, 'indexed'])->name('product.upload');
Route::get('/', [TodoController::class, 'welcome'])->name('welcome');
Route::get('/welcome', [TodoController::class, 'welcome'])->name('welcome');
// Route for HomeController
Route::get('/home', [HomeController::class, 'index'])->name('home');
