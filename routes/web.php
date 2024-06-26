<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\HomeController;

//Route::get('/',function (){
//   echo phpinfo();
//});


Route::get('/home/{slug?}', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('/endereco')->group(function(){
        Route::get('/index/{page?}', [EnderecoController::class,'index'])->name('endereco');
        Route::get('/view/{id?}', [EnderecoController::class,'view'])->name('endereco.view');
        Route::get('/create', [EnderecoController::class,'create'])->name('endereco.create');
        Route::post('/store', [EnderecoController::class,'store'])->name('endereco.store');
        Route::get('/edit/{endereco}', [EnderecoController::class,'edit'])->name('endereco.edit');
        Route::post('/update/{endereco}', [EnderecoController::class,'update'])->name('endereco.update');
        Route::delete('/destroy/{endereco}', [EnderecoController::class,'destroy'])->name('endereco.destroy');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::Fallback(function(){
    return redirect()->away(Env('APP_URL_FALLBACK'));
});

require __DIR__.'/auth.php';
