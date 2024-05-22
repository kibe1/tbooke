<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LearningResourcesController;
use App\Http\Controllers\SchoolsCornerController;
use App\Http\Controllers\TbookeBlueboardController;
use App\Http\Controllers\TbookeLearningController;


Route::get('/', function () {return view('auth.login'); });
Route::get('/about', function () {return view('about'); });






Route::middleware(['auth', 'verified'])->group(function () {
    // Authenticated routes
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'showOwn'])->name('profile.showOwn');
    Route::get('/profile/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/feed', [FeedController::class, 'feeds'])->name('feed');
    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/learning-resources', [LearningResourcesController::class, 'learningResource'])->name('learning-resources');
    Route::get('/schools-corner', [SchoolsCornerController::class, 'schoolsCorner'])->name('schools-corner');
    Route::get('/tbooke-blueboard', [TbookeBlueboardController::class, 'tbookeBlueboard'])->name('tbooke-blueboard');
    Route::get('/tbooke-learning', [TbookeLearningController::class, 'tbookeLearning'])->name('tbooke-learning');

});



require __DIR__.'/auth.php';
