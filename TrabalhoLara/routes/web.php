<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController; //importar o Controller
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('books', BookController::class);