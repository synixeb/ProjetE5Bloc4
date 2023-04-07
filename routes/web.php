<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\PraticienController;
use App\Http\Controllers\SpeController;


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
    return view('home');
});

Route::get('getlogin', [CompteController::class, 'getLogin']);
Route::post('/login', [CompteController::class, 'signIn']);
Route::get('/getLogout', [CompteController::class, 'signOut']);
Route::get('/getPraticienListe', [PraticienController::class, 'getPraticienListe']);
Route::get('/ajouterPraticien', [PraticienController::class, 'addPraticien']);
Route::get('/supprimerPraticien/{id}', [PraticienController::class, 'supprimePraticien']);
Route::get('/modifierPraticien/{id}', [PraticienController::class, 'updatePraticien']);
Route::post('validerInsertPraticien', [PraticienController::class, 'validateInsertPraticien']);
Route::post('validerUpdatePraticien', [PraticienController::class, 'validateUpdatePraticien']);
Route::get('/listerSpe/{id}', [SpeController::class, 'SpeById']);

