<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

route::controller(PageController::class)->group(function () {
    Route::get('/',                 'home')->name('home');
    Route::get('blog', 'blog')->name('blog');
    Route::get('blog/{post:slug}',  'post')->name('post');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('posts', PostController::class)->middleware(['auth', 'verified'])->except('show');

require __DIR__.'/auth.php';