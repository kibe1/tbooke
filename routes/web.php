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
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AnnouncementController;


Route::get('/', function () {return view('auth.login'); });
Route::get('/about', function () {return view('about'); });






Route::middleware(['auth', 'verified'])->group(function () {

    // Authenticated routes
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/feed', [FeedController::class, 'feeds'])->name('feed');
    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/learning-resources', [LearningResourcesController::class, 'learningResource'])->name('learning-resources');
    Route::get('/schools-corner', [ SchoolsCornerController::class, 'schoolsCorner'])->name('schools-corner');
    Route::get('/tbooke-blueboard', [TbookeBlueboardController::class, 'tbookeBlueboard'])->name('tbooke-blueboard');
    Route::get('/tbooke-learning', [TbookeLearningController::class, 'tbookeLearning'])->name('tbooke-learning');
    Route::post('/save-resource', [ResourceController::class, 'store'])->name('save-resource');
    Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');
    Route::get('/learning-resources', [ResourceController::class, 'index'])->name('learning-resources');
    Route::post('/submit-form', [FormController::class, 'store'])->name('submit-form');
    Route::get('/submissions', [FormController::class, 'submissions'])->name('submissions');
    Route::get('submission/success/{submission}', [FormController::class, 'showSuccess'])->name('submission.success');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('/tbooke-blueboard', [AnnouncementController::class, 'index'])->name('tbooke-blueboard');
});



require __DIR__.'/auth.php';
