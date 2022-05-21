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

    //Exams
    Route::get('/exam','ExamController@index')->name('exam.index');
    Route::post('/exam','ExamController@store')->name('exam.store');
    Route::post('/exam/status','ExamController@update_status')->name('exam.status');
    Route::put('/exam/update/{id}','ExamController@update')->name('exam.update');
    Route::post('/exam_delete','ExamController@exam_delete')->name('exam_delete');

    //question
    Route::resource('question','QuestionController');

    //Message
    Route::resource('message','MealMessageController');
    Route::get('/message/email/{id}','MealMessageController@email')->name('message.email');
    Route::post('/message/email/send','MealMessageController@send_email')->name('message.email.send');
    Route::post('/message_delete','MealMessageController@message_delete')->name('message_delete');
    Route::get('/export_message','MealMessageController@export_message')->name('export_message');


});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

