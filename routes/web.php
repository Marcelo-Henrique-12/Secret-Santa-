<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\SorteioController;
use App\Models\Participante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Cadastro de participantes


Route::resource('participante', ParticipanteController::class);
Route::delete('participante/desativar/{id}',[ParticipanteController::class, 'desativar'])->name('participante.desativar');
Route::get('participante/reativar/{id}',[ParticipanteController::class, 'reativar'])->name('participante.reativar');
Route::resource('sorteio', SorteioController::class);
Route::post('/sorteioemail/{id}', [SorteioController::class, 'mailto'])->name('sorteio.email');
