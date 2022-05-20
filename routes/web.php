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


Route::get('/designation','DesignationController@designation')->name('designation');
//cron order and meal update
Route::get('/cron_order_meal_update','HomeController@cron_order_meal_update')->name('cron_order_meal_update');


// route start
Route::middleware('auth')->group(function (){
    Route::get('/','HomeController@index')->name('dashboard');
    Route::get('/total_order_chart','HomeController@total_order_chart')->name('total_order_chart');
    Route::get('/total_order_value_chart','HomeController@total_order_value_chart')->name('total_order_value_chart');
    Route::get('/week_chart','HomeController@week_chart')->name('week_chart');

    //foodmenu
    Route::get('/foodmenu','FoodMenuController@index')->name('foodmenu');
    Route::post('/foodmenu','FoodMenuController@store')->name('foodmenu.store');
    Route::post('/foodmenu/status','FoodMenuController@update_status')->name('foodmenu.status');
    Route::put('/foodmenu/update/{id}','FoodMenuController@update')->name('foodmenu.update');
    Route::post('/food_menu_delete','FoodMenuController@food_menu_delete')->name('food_menu_delete');
    Route::post('/food_multiple_status_change','FoodMenuController@food_multiple_status_change')
        ->name('food_multiple_status_change');

    //profile
    Route::get('/profile','HomeController@profile')->name('profile');
    Route::post('/profile_update','HomeController@profile_update')->name('profile.update');
    Route::post('/email_update','HomeController@email_update')->name('email.update');
    Route::post('/reset_password','HomeController@reset_password')->name('reset_password');

    //meal-setter
    Route::get('/meal-setter','MealSetterController@index')->name('meal-setter.index');
    Route::post('/meal-setter','MealSetterController@store')->name('meal-setter.store');
    Route::post('/meal-setter/status','MealSetterController@update_status')->name('meal-setter.status');
    Route::put('/meal-setter/update/{id}','MealSetterController@update')->name('meal-setter.update');
    Route::post('/meal_menu_delete','MealSetterController@meal_menu_delete')->name('meal_menu_delete');
    Route::get('/export_meal_setter','MealSetterController@export_meal_setter')->name('export_meal_setter');
    Route::get('/meal-setter/history','MealSetterController@history')->name('meal-setter.history');
    Route::get('/meal-setter/history/export','MealSetterController@history_export')->name('meal-setter.history.export');
    Route::post('/meal_multiple_status_change','MealSetterController@meal_multiple_status_change')->name('meal_multiple_status_change');
    Route::post('/meal-setter/stock','MealSetterController@stock')->name('meal-setter.stock');

    //staff
    Route::get('/staff','SkfUserController@index')->name('staff.index');
    Route::post('/staff','SkfUserController@store')->name('staff.store');
    Route::post('/staff/status','SkfUserController@update_status')->name('staff.status');
    Route::put('/staff/update/{id}','SkfUserController@update')->name('staff.update');
    Route::post('/staff_delete','SkfUserController@staff_delete')->name('staff_delete');

    //change password
    Route::post('/staff/change-password','SkfUserController@change_password')->name('staff.change_password');
    //admin user
    Route::get('/admin','SkfUserController@admin_user')->name('admin_user.index');

    // role
    Route::get('/role','RoleController@index')->name('role.index');
    Route::post('/role','RoleController@store')->name('role.store');
    Route::put('/role/update/{id}','RoleController@update')->name('role.update');
    Route::post('/role_delete','RoleController@role_delete')->name('role_delete');

    // designation
    Route::get('/designation','DesignationController@index')->name('designation.index');
    Route::post('/designation','DesignationController@store')->name('designation.store');
    Route::put('/designation/update/{id}','DesignationController@update')->name('designation.update');
    Route::post('/designation_delete','DesignationController@designation_delete')->name('designation_delete');

    //Department
    Route::get('/department','DepartmentController@index')->name('department.index');
    Route::post('/department','DepartmentController@store')->name('department.store');
    Route::put('/department/update/{id}','DepartmentController@update')->name('department.update');
    Route::post('/department_delete','DepartmentController@department_delete')->name('department_delete');

    //Message
    Route::resource('message','MealMessageController');
    Route::get('/message/email/{id}','MealMessageController@email')->name('message.email');
    Route::post('/message/email/send','MealMessageController@send_email')->name('message.email.send');
    Route::post('/message_delete','MealMessageController@message_delete')->name('message_delete');
    Route::get('/export_message','MealMessageController@export_message')->name('export_message');

    //order
    Route::get('/order','OrderController@index')->name('order.index');
    Route::get('/export_order','OrderController@export_order')->name('export_order');
    Route::get('/order/create','OrderController@create')->name('order.create');
    Route::post('/order/place','OrderController@order_place')->name('order.place');
    Route::post('/order_delete','OrderController@order_delete')->name('order_delete');
    Route::post('/status_change','OrderController@status_change')->name('status_change');
    Route::post('/multiple_status_change','OrderController@multiple_status_change')->name('multiple_status_change');

    // cart
    Route::post('/cart/add','OrderController@add_cart')->name('cart.add');

    //invoice
    Route::get('/order/invoice/{id}','OrderController@invoice')->name('order.invoice');

    // report
    Route::get('/report','OrderController@report')->name('report.index');
    Route::get('/export_report','OrderController@export_report')->name('export_report');
    Route::get('/report/user/{id}','OrderController@report_user')->name('report.user');
    Route::get('/report/user/invoice/{id}','OrderController@invoice')->name('report.invoice');
    Route::get('/report/user/export/{id}','OrderController@export_user_report')->name('export_user_report');

    // food demand
    Route::get('/food-demand','OrderController@food_demand')->name('demand.index');
    Route::get('/export_demand','OrderController@export_demand')->name('export_demand');

    //food consumption
    Route::get('/food-consumption','OrderController@food_consumption')->name('consumption.index');
    Route::get('/export_consumption','OrderController@export_consumption')->name('export_consumption');

    //settings
    Route::resource('settings','ConfigMealSiteController');
    Route::post('/settings_delete','ConfigMealSiteController@settings_delete')->name('settings_delete');

    //payment
    Route::get('/payment','PaymentController@index')->name('payment.index');
    Route::post('/single_payment','PaymentController@single_payment')->name('payment.single');
    Route::post('/all_payment','PaymentController@all_payment')->name('payment.all');

    // monthly payment
    Route::get('/employee-consumption','PaymentController@consumption')->name('employee.consumption');
    Route::get('/employee-consumption/export','PaymentController@consumption_export')->name('employee.consumption.export');

    //update notification
    Route::post('/update_notification','HomeController@update_notification')->name('update_notification');

    Route::get('/new','HomeController@new')->name('new');

});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

