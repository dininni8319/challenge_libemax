<?php

use App\Http\Controllers\ChallengeController;
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

Route::get('/', [ChallengeController::class, 'index'])->name('homepage');
Route::post('/create', [ChallengeController::class, 'createEmployee'])->name('newEmployee');
