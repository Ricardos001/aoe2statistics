<?php

use Illuminate\Support\Facades\Route;
//use App\Http\MainControllers\MainController;
use App\Http\Controllers\MainController;




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

//Route::post('/player', [MainController::class, 'searchPlayer']);
Route::get('/', [MainController::class, 'index']);
Route::get('/player/{id}', [MainController::class, 'player']);
Route::get('/players', [MainController::class, 'players']); 
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
    'register' => false,
    'confirm' => false,
    'reset' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/new-player', [MainController::class, 'newPlayer'])->middleware('auth');    
// Route::post('/admin/new-match', [MainController::class, 'storeNewPlayer']->middleware('auth'));    
