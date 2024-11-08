<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/chat/{sellerId}', [ChatController::class, 'show'])->name('chat');



 

