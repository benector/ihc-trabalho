<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AcaoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\ProjetoExtensaoController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [ProjetoExtensaoController::class, 'index'])
    ->middleware('auth');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('acoes', AcaoController::class);
        Route::resource('users', UserController::class);
        Route::resource('areas', AreaController::class);
        Route::resource('projetos', ProjetoExtensaoController::class);
});


Route::get('/projetos-extensao',
    [ProjetoExtensaoController::class, 'publicIndex']
)->name('projetos.publicos.index');


require __DIR__.'/auth.php';
