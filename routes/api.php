<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Auth API

Route::post('app_login', 'APIController@login');
Route::post('app_register', 'APIController@register');
Route::post('app_forgot_password', 'APIController@app_forgot_password');

Route::post('app_updatepassword', 'APIAuthController@updatepassword');

Route::post('app_update_profile_student', 'APIAuthController@update_profile_student');
Route::post('app_update_profile_image', 'APIAuthController@update_profile_image');


Route::post('app_update_profile_teacher', 'APIAuthController@update_profile_teacher');

Route::post('app_add_qualification', 'APIAuthController@add_qualification');
Route::post('app_list_qualification', 'APIAuthController@list_qualification');
Route::post('app_edit_qualification', 'APIAuthController@edit_qualification');
Route::post('app_delete_qualification', 'APIAuthController@delete_qualification');

Route::post('app_add_course', 'APIAuthController@add_course');
Route::post('app_course_list', 'APIAuthController@course_list');
Route::post('app_edit_course', 'APIAuthController@edit_course');
Route::post('app_delete_course', 'APIAuthController@delete_course');

Route::post('app_delete_course_subject', 'APIAuthController@delete_course_subject');
Route::post('app_delete_course_date', 'APIAuthController@delete_course_date');





// Student part Request

Route::post('app_add_request', 'APIAuthController@add_request');
Route::post('app_request_list', 'APIAuthController@request_list');
Route::post('app_edit_request', 'APIAuthController@edit_request');
Route::post('app_delete_request', 'APIAuthController@delete_request');





// Auth Find Tutor
Route::post('app_find_tutor_filter', 'APIAuthController@find_tutor_filter');
Route::post('app_find_tutor', 'APIAuthController@app_find_tutor');

Route::post('app_find_student', 'APIAuthController@app_find_student');


Route::post('app_submit_offer', 'APIAuthController@app_submit_offer');


// get student
Route::post('app_get_student', 'APIAuthController@app_get_student');

// start offer teacher side
Route::post('app_get_offer_teacher', 'APIAuthController@app_get_offer_teacher');
Route::post('app_add_offer_teacher', 'APIAuthController@app_add_offer_teacher');
Route::post('app_edit_offer_teacher', 'APIAuthController@edit_add_offer_teacher');
Route::post('app_delete_offer_teacher', 'APIAuthController@app_delete_offer_teacher');
// end offer teacher side


// start offer student side
Route::post('app_get_offer_student', 'APIAuthController@app_get_offer_student');


// book lesson

Route::post('app_lesson_category', 'APIAuthController@app_lesson_category');
Route::post('app_lesson_category_subject', 'APIAuthController@app_lesson_category_subject');
Route::post('app_get_course_date', 'APIAuthController@app_get_course_date');
Route::post('app_get_course_time', 'APIAuthController@app_get_course_time');



// offer payment
Route::post('app_payment_intent_offer', 'APIAuthController@app_payment_intent_offer');
Route::post('app_offer_payment_status', 'APIAuthController@app_offer_payment_status');


// course payment 
Route::post('app_payment_intent_course', 'APIAuthController@app_payment_intent_course');
Route::post('app_course_payment_status', 'APIAuthController@app_course_payment_status');


// booked course teacher
Route::post('app_booked_teacher_course', 'APIAuthController@app_booked_teacher_course');
Route::post('app_teacher_dashboard', 'APIAuthController@app_teacher_dashboard');

// booked course student
Route::post('app_booked_student_course', 'APIAuthController@app_booked_student_course');
Route::post('app_student_dashboard', 'APIAuthController@app_student_dashboard');

// student teacher booked detail
Route::post('app_booked_course_detail', 'APIAuthController@app_booked_course_detail');


// add home wotk 
Route::post('app_submit_homework_teacher', 'APIAuthController@app_submit_homework_teacher');
Route::post('app_homework_submit_student', 'APIAuthController@app_homework_submit_student');
Route::post('app_lesson_complete_student', 'APIAuthController@app_lesson_complete_student');


// offer detail page 
Route::post('app_booked_offer_detail', 'APIAuthController@app_booked_offer_detail');

//app list
Route::post('app_get_chat_user', 'APIAuthController@app_get_chat_user');
Route::post('app_get_chat_message', 'APIAuthController@app_get_chat_message');








