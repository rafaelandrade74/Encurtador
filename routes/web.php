<?php

use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/Home')->group(function () {
    Route::get('/{slug}', [HomeController::class, 'index'])->name('home');
});

Route::get('/login', [EnderecoController::class,'index'])->name('login');

Route::prefix('/Endereco')->group(function(){
  Route::get('/', [EnderecoController::class,'index'])->name('endereco');
  Route::get('/create', [EnderecoController::class,'create'])->name('endereco.create');
  Route::post('/store', [EnderecoController::class,'store'])->name('endereco.store');
  Route::get('/edit/{endereco}', [EnderecoController::class,'edit'])->name('endereco.edit');
  Route::put('/update/{endereco}', [EnderecoController::class,'update'])->name('endereco.update');
  Route::delete('/destroy/{endereco}', [EnderecoController::class,'destroy'])->name('endereco.destroy');
});


//Route::Fallback(function(){
//    return redirect()->away('https://www.google.com');
//});
