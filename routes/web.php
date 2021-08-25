<?php

use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'home'])->middleware(['auth'])->name('home');

Route::get('/posts/create', [PostController::class, 'createForm'])->middleware(['auth'])->name('post.form');

Route::post('/posts/create', [PostController::class, 'save'])->middleware(['auth'])->name('post.save');

Route::post('/posts/delete', [PostController::class, 'delete'])->middleware(['auth'])->name('post.delete');

Route::get('/posts/{id}/edit', [PostController::class, 'editForm'])->middleware(['auth'])->name('post.edit.form');

require __DIR__.'/auth.php';
