<?php

use Illuminate\Support\Facades\Route;

use App\Models\HomeHero;
use App\Models\Reason;
use App\Models\BlogPost;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PressController;
use App\Http\Controllers\PostController;

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




Route::get('/', [HomeController::class, 'index'])->name('home.index');


Route::get('/espace-presse', [PressController::class, 'index'])->name('press.index');
Route::get('/presse/{slug}', [PressController::class, 'show'])->name('press.show');

Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.show');

Route::get('/qui-sommes-nous', [AboutController::class, 'index'])->name('about');