<?php

use Illuminate\Support\Facades\Route;
//use App\Http\MainControllers\MainController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MainController2;
use App\Http\Controllers\AdminController;




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

// Route::get('/laravelweolcome', function () {
//     return view('welcome');
// });

Route::get('/', [MainController2::class, 'index']);
Route::get('/player/{id}', [MainController::class, 'player']);
Route::get('/players', [MainController2::class, 'players']); 
Route::post('/player', [MainController2::class, 'searchPlayer']);
//Route::post('/matches', [MainController::class, 'searchMatches']);
//Route::get('/matches', [MainController::class, 'matches']); 
//Route::post('/admin/new-player', [MainController::class, 'storeNewPlayer']);
//Route::post('/admin/new-match', [MainController::class, 'storeNewMatch']);
//Route::get('/admin/new-match', [MainController::class, 'newMatch']);

//sets
//Route::get('/admin/set-player/{id}', [MainController::class, 'setPlayerIndex']);
//Route::post('/admin/set-player/{id}', [MainController::class, 'setPlayerStore']);
//Route::post('/admin/delete-player/{id}', [MainController::class, 'deletePlayer']);

//Route::get('/admin/set-match/{id}', [MainController::class, 'setMatchIndex']);
//Route::post('/admin/set-match/{id}', [MainController::class, 'setMatchStore']);
//Route::post('/admin/delete-match/{id}', [MainController::class, 'deleteMatch']);

Auth::routes([
    'confirm' => false,
    'reset' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [MainController2::class, 'admin'])->middleware('auth');    
Route::get('/admin/new-player', [AdminController::class, 'newPlayerGet']);
Route::post('/admin/new-player', [AdminController::class, 'newPlayerPost'])->middleware('auth');   
Route::post('/admin/delete-player/{id}', [AdminController::class, 'deletePlayer'])->middleware('auth');
Route::get('/admin/players', [AdminController::class, 'players'])->middleware('auth');

// Route::post('/admin/new-match', [MainController::class, 'storeNewPlayer']->middleware('auth'));    
