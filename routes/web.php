<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [ChatController::class, "loadDashboard"])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/check-channel', [ChatController::class, "checkChannel"])->middleware(['auth', 'verified'])->name('checkChannel');
Route::get('/create-channel', [ChatController::class, "createChannel"])->middleware(['auth', 'verified'])->name('createChannel');
Route::post('/store-message', [ChatController::class, "storeMessage"]);
Route::get('/get-messages', [ChatController::class, "getMessages"]);
Route::get('/test',function(){
    return view('test');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
