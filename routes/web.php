<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blogs', function () {
    return view('blogs.index');
});
Route::get('/blogs/insert', function () {
    return view('blogs.create');
});

Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
Route::post('/bogs/destrory', [BlogController::class, 'destroy'])->name('blogs.destroy');





// Route::get('/media', function () {
//     return view('media-manager.index');
// });

Route::get("/media/{any?}", function () {
    return view('media-manager.index');
})->where('any', '.*');

Route::post('/media/upload', [MediaController::class, 'upload'])->name('media.upload');


Route::get('/pagebuilder', function () {
    return view('pagebuilder.editor');
});

Route::post('/render-widget', [WidgetController::class, 'render'])->name('render-widget');
Route::post('/render-controls', [WidgetController::class, 'renderControls'])->name('render-controls');
Route::post('/save-page', [WidgetController::class, 'savePage'])->name('save-page');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
