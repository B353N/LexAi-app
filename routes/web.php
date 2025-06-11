<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use Inertia\Inertia;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ChatController;
=======
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
<<<<<<< HEAD

    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/chat/{chat}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{chat}/messages', [ChatController::class, 'storeMessage'])->name('chat.messages.store');
=======
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
});
