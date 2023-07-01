<?php

use Illuminate\Support\Facades\Route;

// Learning routes
Route::get('/', 'LearningController@index')->name('learning.index');
Route::get('/team', 'LearningController@team')->name('learning.team');
Route::get('/contact', 'LearningController@contact')->name('learning.contact');
Route::get('/term', 'LearningController@term')->name('learning.term');

// Course routes
Route::resource('/course', 'CourseController'); // This generates multiple routes with names
Route::post('/course/{id}/enroll', 'CourseController@enroll')->name('course.enroll');
Route::get('/courses', 'CourseController@courses')->name('courses.index');
Route::get('/learn/course/{id}', 'CourseController@learnCourse')->name('course.learn');
Route::post('/course/{id}/join', 'CourseController@join')->name('course.join');
Route::get('/course/leave/{id}', 'CourseController@leave')->name('course.leave');

// Problem routes
Route::resource('/problem', 'ProblemController'); // This generates multiple routes with names

// Authentication routes
Auth::routes(); // This generates multiple routes with names

// Home route
Route::get('/home', 'HomeController@index')->name('home');

// User routes
Route::resource('/account', 'UserController'); // This generates multiple routes with names
Route::get('/user', 'UserController@currentUser')->name('user.current');

// Role Request routes
Route::resource('/role/request', 'RoleRequestController'); // This generates multiple routes with names

// Lesson routes
Route::get('/learn/lesson/{id}', 'LessonController@learnLesson')->name('lesson.learn');
Route::resource('/lesson', 'LessonController'); // This generates multiple routes with names
Route::post('/lesson/finish', 'LessonController@finish')->name('lesson.finish');
Route::get('/learn/propune-lectie/{id}', 'LessonController@propune');

// Test routes
Route::get('/learn/test/{id}', 'TestController@verify')->name('test.verify');
Route::resource('/test', 'TestController'); // This generates multiple routes with names
Route::post('/test/{id}/check', 'TestController@check')->name('test.check');

// Exercise routes
Route::get('/exercise', 'ExerciseController@index')->name('exercise.index');
Route::delete('/exercise/{id}', 'ExerciseController@delete')->name('exercise.delete');
Route::resource('/test/{test_id}/exercise', 'ExerciseController'); // This generates multiple routes with names

// Answer routes
Route::resource('/answer', 'CourseAnswerController'); // This generates multiple routes with names

// Question routes
Route::resource('/question', 'CourseQuestionController'); // This generates multiple routes with names

// Forum routes
Route::post('/posts/{id}/likes', 'ForumPostController@likes')->name('post.likes');
Route::post('/topics/{id}/posts', 'ForumPostController@store')->name('topic.posts');
Route::post('/forums/{id}/topics', 'ForumTopicController@store')->name('forum.topics');
Route::get('/forums', 'ForumController@index')->name('forum.index');
Route::get('/forums/{id}', 'ForumController@show')->name('forum.show');
Route::get('/forums/{id}/topics', 'ForumController@topics')->name('forum.topics');
Route::resource('/topics', 'ForumTopicController'); // This generates multiple routes with names
