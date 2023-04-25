<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::get('/', 'LearningController@index');


Route::resource('course', CourseController::class);


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('course/{id}/join', [CourseController::class, 'join'])->name('course.join');
Route::post('course/{id}/leave', [CourseController::class, 'leave'])->name('course.leave');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
