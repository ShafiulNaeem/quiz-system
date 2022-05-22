<?php

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

//Route::get('/welcome', function () {
//    return view('welcome');
//});
Auth::routes();

// route start
Route::middleware('auth')->group(function (){
    Route::get('/','HomeController@index')->name('dashboard');
    Route::get('/{title}/{id}','HomeController@question')->name('exam.question');

    //Exam
    Route::get('/exam','ExamController@index')->name('exam.index');
    Route::post('/exam','ExamController@store')->name('exam.store');
    Route::post('/exam/status','ExamController@update_status')->name('exam.status');
    Route::put('/exam/update/{id}','ExamController@update')->name('exam.update');
    Route::post('/exam_delete','ExamController@exam_delete')->name('exam_delete');

    //question
    Route::resource('question','QuestionController');
    Route::post('/question/status','QuestionController@update_status')->name('question.status');
    Route::post('/question_delete','QuestionController@question_delete')->name('question_delete');


});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

