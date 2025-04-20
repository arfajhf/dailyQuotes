<?php

use App\Http\Controllers\frontEnd\QuotesController;
use App\Http\Controllers\quetesController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[QuotesController::class, 'index']);
