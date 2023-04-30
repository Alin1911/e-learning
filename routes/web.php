<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::get('/', 'LearningController@index');
Route::get('/team', 'LearningController@team');
Route::get('/contact', 'LearningController@contact');
Route::get('/term', 'LearningController@term');


Route::resource('course', CourseController::class);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('course/{id}/join', [CourseController::class, 'join'])->name('course.join');
Route::post('course/{id}/leave', [CourseController::class, 'leave'])->name('course.leave');
Auth::routes();

Route::resource('/answer', 'CourseAnswerController');
Route::resource('/exercise', 'ExerciseController');
Route::resource('/test', 'TestController');
Route::resource('/forum', 'ForumController');
Route::resource('/lesson/{course_id}', 'LessonController');
Route::resource('/question', 'CourseQuestionController');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');