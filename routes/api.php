<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/status', function () {
   return response()->json([
       'status' => 'API is running!',
   ]);
});


Route::get('/welcome',[MainController::class, 'welcome']);
Route::get('/current-time',[MainController::class, 'currentTime']);
Route::get('/current-date',[MainController::class, 'currentDate']);