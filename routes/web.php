<?php

use App\Http\Controllers\EnderecoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EnderecoController::class,'index']);
