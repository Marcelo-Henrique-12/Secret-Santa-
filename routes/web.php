<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NovoParticipanteController;
use App\Http\Controllers\SorteioController;
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


Route::resource('novoparticipante', NovoParticipanteController::class);
Route::resource('sorteio', SorteioController::class);
Route::post('/sorteioemail/{id}', [SorteioController::class, 'mailto'])->name('sorteio.email');