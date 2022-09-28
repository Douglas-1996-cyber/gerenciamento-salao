<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('corte','App\Http\Controllers\CorteController');
Route::resource('lucro','App\Http\Controllers\LucroController')->middleware('auth');
Route::resource('marcacao','App\Http\Controllers\MarcacaoController')->middleware('auth');
Route::resource('servico','App\Http\Controllers\ServicoController')->middleware('auth');
Route::patch('servico/{servico}/adicionar', 'App\Http\Controllers\ServicoController@adicionar')->name('servico.adicionar')->middleware('auth');
Route::patch('lucro/{lucro}/fechar', 'App\Http\Controllers\LucroController@fechar')->name('lucro.fechar')->middleware('auth');
