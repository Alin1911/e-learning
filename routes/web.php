<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::get('/', 'LearningController@index');
Route::get('/team', 'LearningController@team');
Route::get('/contact', 'LearningController@contact');
Route::get('/term', 'LearningController@term');
Route::post('/course/{id}/enroll', 'CourseController@enroll');

Route::resource('course', CourseController::class);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('course/{id}/join', [CourseController::class, 'join'])->name('course.join');
Route::post('course/{id}/leave', [CourseController::class, 'leave'])->name('course.leave');
Auth::routes();

Route::get('/user', 'UserController@currentUser');
Route::get('/courses', 'CourseController@courses');
Route::get('/learn/course/{id}', 'CourseController@learnCourse');
Route::resource('/answer', 'CourseAnswerController');
Route::resource('/test/{test_id}/exercise', 'ExerciseController');
Route::resource('/test', 'TestController');
Route::resource('/forum', 'ForumController');
Route::resource('/lesson', 'LessonController');
Route::resource('/question', 'CourseQuestionController');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');