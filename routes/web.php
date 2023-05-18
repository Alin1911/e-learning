<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'LearningController@index');
Route::get('/team', 'LearningController@team');
Route::get('/contact', 'LearningController@contact');
Route::get('/term', 'LearningController@term');
Route::post('/course/{id}/enroll', 'CourseController@enroll');

Route::resource('course', CourseController::class);
Route::resource('/problem', ProblemController::class);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('course/{id}/join', [CourseController::class, 'join'])->name('course.join');
Route::post('course/{id}/leave', [CourseController::class, 'leave'])->name('course.leave');
Route::resource('/account', "UserController");
Auth::routes();

Route::get('/user', 'UserController@currentUser');
Route::get('/courses', 'CourseController@courses');
Route::get('/learn/course/{id}', 'CourseController@learnCourse');
Route::get('/learn/lesson/{id}', 'LessonController@learnLesson');
Route::get('/learn/test/{id}', 'TestController@verify');
Route::get('/exercise', 'ExerciseController@index');
Route::resource('/answer', 'CourseAnswerController');
Route::resource('/test/{test_id}/exercise', 'ExerciseController');
Route::resource('/test', 'TestController');
Route::resource('/lesson', 'LessonController');
Route::resource('/question', 'CourseQuestionController');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/forums', 'ForumController@index');
Route::get('/forums/{id}', 'ForumController@show');
Route::get('/forums/{id}/topics', 'ForumController@topics');

Route::get('/topics/{id}', 'ForumTopicController@show');
Route::post('/forums/{id}/topics', 'ForumTopicController@store');
Route::get('/topics/{id}/posts', 'ForumTopicController@posts');

Route::post('/topics/{id}/posts', 'ForumPostController@store');
