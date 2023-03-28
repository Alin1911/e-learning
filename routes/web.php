<?php

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
use App\Http\Middleware\AffiliateMiddleware;

Route::get('/', 'LearningController@index');

Route::resource('/course', 'CourseController');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);