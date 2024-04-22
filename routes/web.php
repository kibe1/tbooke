<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LearningResourcesController;
use App\Http\Controllers\SchoolCornersController;
use App\Http\Controllers\TbookeBlueboardController;

Route::get('/', function () {return view('index'); });
Route::get('/about', function () {return view('about'); });





Route::middleware('auth')->group(function () {

    // Authenticated routes
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/feed', [FeedController::class, 'feeds'])->name('feed');
    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/learning-resources', [LearningResourcesController::class, 'learningResource'])->name('learning-resources');
    Route::get('/school-corners', [ SchoolCornersController::class, 'schoolCorner'])->name('school-corners');
    Route::get('/tbooke-blueboard', [TbookeBlueboardController::class, 'tbookeBlueboard'])->name('tbooke-blueboard');

});



require __DIR__.'/auth.php';
