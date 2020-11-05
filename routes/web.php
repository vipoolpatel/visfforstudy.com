<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Admin Start

Route::get('locale/{locale}', function ($locale){
    \Session::put('locale', $locale);
    return redirect()->back();
});



Route::group(['middleware' => 'admin'], function () {

    Route::get('admin/notes', 'Backend\DashboardController@notes');
    Route::get('admin/contact_us', 'Backend\SeoController@contact_list');
    Route::get('admin/contact_us/delete/{id}', 'Backend\SeoController@contact_us_delete');


    Route::get('admin/dashboard', 'Backend\DashboardController@dashboard');

    Route::get('admin/notification', 'Backend\NotificationController@notification');

    Route::get('admin/withdraw-request', 'Backend\WithdrawRequestController@withdraw_request');
    Route::get('admin/earning/approve/{id}', 'Backend\WithdrawRequestController@earning_admin_approve');
    Route::get('admin/earning/reject/{id}', 'Backend\WithdrawRequestController@earning_admin_reject');


    Route::get('admin/setting', 'Backend\SettingController@setting');
    Route::post('admin/setting/request_insert', 'Backend\SettingController@request_insert');
    Route::post('admin/setting/update_request_type', 'Backend\SettingController@update_request_type');
    Route::post('admin/setting/request_type_delete/{id}', 'Backend\SettingController@request_type_delete');
    Route::post('admin/setting/level_of_student_insert', 'Backend\SettingController@level_of_student_insert');
    Route::post('admin/setting/update_level_student', 'Backend\SettingController@update_level_student');
    Route::post('admin/setting/level_student_delete/{id}', 'Backend\SettingController@level_student_delete');


    Route::get('admin/setting/get_data_request', 'Backend\SettingController@get_data_request');
    Route::get('admin/setting/get_data_level_Student', 'Backend\SettingController@get_data_level_Student');

    Route::get('admin/setting/get_data_language', 'Backend\SettingController@get_data_language');
    Route::post('admin/setting/language_insert', 'Backend\SettingController@language_insert');
    Route::post('admin/setting/update_language_name', 'Backend\SettingController@update_language_name');
    Route::post('admin/setting/language_delete/{id}', 'Backend\SettingController@language_delete');

    Route::post('admin/setting/booking_insert', 'Backend\SettingController@booking_insert');
    Route::get('admin/setting/get_data_booking', 'Backend\SettingController@get_data_booking');
    Route::post('admin/setting/update_booking_name', 'Backend\SettingController@update_booking_name');
    Route::post('admin/setting/booking_delete/{id}', 'Backend\SettingController@booking_delete');




    Route::get('admin/tutor', 'Backend\TutorController@tutor');
    Route::get('admin/tutor/add', 'Backend\TutorController@add');
    Route::post('admin/tutor/add', 'Backend\TutorController@insert');
    Route::get('admin/tutor/delete/{id}', 'Backend\TutorController@delete');
    Route::get('admin/tutor/edit/{id}', 'Backend\TutorController@edit');
    Route::post('admin/tutor/edit/{id}', 'Backend\TutorController@update');
    Route::get('admin/tutor/view/{id}', 'Backend\TutorController@view');
    Route::get('admin/tutor/change_tutor_studnet', 'Backend\TutorController@change_tutor_studnet');

    Route::get('admin/admin', 'Backend\AdminController@admin');
    Route::get('admin/admin/add', 'Backend\AdminController@add');
    Route::post('admin/admin/add', 'Backend\AdminController@insert');
    Route::get('admin/admin/delete/{id}', 'Backend\AdminController@delete');
    Route::get('admin/admin/edit/{id}', 'Backend\AdminController@edit');
    Route::post('admin/admin/edit/{id}', 'Backend\AdminController@update');
    Route::get('admin/admin/change_admin_status', 'Backend\AdminController@change_admin_status');
    Route::get('admin/admin/permission/{id}', 'Backend\AdminController@permission');
    Route::post('admin/admin/get_permission', 'Backend\AdminController@get_permission');
    Route::post('admin/admin/update_permission', 'Backend\AdminController@update_permission');




    Route::get('admin/student', 'Backend\StudentController@student');
    Route::get('admin/student/add', 'Backend\StudentController@add');
    Route::post('admin/student/add', 'Backend\StudentController@insert');
    Route::get('admin/student/delete/{id}', 'Backend\StudentController@delete');
    Route::get('admin/student/edit/{id}', 'Backend\StudentController@edit');
    Route::post('admin/student/edit/{id}', 'Backend\StudentController@update');
    Route::get('admin/student/view/{id}', 'Backend\StudentController@view');
    Route::get('admin/student/change_student_status', 'Backend\StudentController@change_student_status');

    Route::get('admin/category', 'Backend\CategoryController@category');
    Route::get('admin/category/add', 'Backend\CategoryController@add');
    Route::post('admin/category/add', 'Backend\CategoryController@insert');
    Route::get('admin/category/change_review_status', 'Backend\CategoryController@change_review_status');
    Route::get('admin/category/delete/{id}', 'Backend\CategoryController@delete');
    Route::get('admin/category/edit/{id}', 'Backend\CategoryController@edit');
    Route::post('admin/category/edit/{id}', 'Backend\CategoryController@update');

    Route::get('admin/chat/{id?}', 'Backend\ChatController@chat');
    Route::get('admin/email-marketing', 'Backend\EmailMarketingController@email_marketing');
    Route::get('admin/email-marketing/delete/{id}', 'Backend\EmailMarketingController@delete');

    // Course Menu start
    Route::get('admin/course', 'Backend\CourseController@course');
    Route::get('admin/course/view/{id}', 'Backend\CourseController@admin_view');
    Route::get('admin/course/delete/{id}', 'Backend\CourseController@admin_delete');
    Route::get('admin/course/change_status', 'Backend\CourseController@change_status');
    // Course Menu end

    // Request Menu Start
    Route::get('admin/request', 'Backend\RequestController@admin_request');
    Route::get('admin/request-page/delete/{id}', 'Backend\RequestController@admin_request_delete');
    Route::get('admin/request/change_request_status', 'Backend\RequestController@change_request_status');
    Route::get('admin/request/view/{id}', 'Backend\RequestController@admin_request_view');
    // Request Menu End

    // Subscribe Email Menu Start Now
    Route::get('admin/subscribe-email', 'Backend\SubscribeEmailController@subscribe_email');
    Route::get('admin/subscribe-email/delete/{id}', 'Backend\SubscribeEmailController@delete');
    // Subscribe Email Menu End Now


     //admin Language Start Menu
    Route::get('admin/language', 'Backend\LanguageController@language');
    Route::get('admin/language/add', 'Backend\LanguageController@add');
    Route::post('admin/language/add', 'Backend\LanguageController@insert');
    Route::get('admin/language/edit/{id}', 'Backend\LanguageController@edit');
    Route::post('admin/language/edit/{id}', 'Backend\LanguageController@update');
    Route::get('admin/language/delete/{id}', 'Backend\LanguageController@delete');
    //admin Language End Menu


    // admin Offer menu start
    Route::get('admin/offer', 'Backend\OfferController@admin_offer_list');
    Route::get('admin/offer/view/{id}', 'Backend\OfferController@view');
    Route::get('admin/offer/delete/{id}', 'Backend\OfferController@admin_offer_delete');
    Route::get('admin/offer/change_offer_status', 'Backend\OfferController@change_offer_status');
    // admin Offer menu end

    Route::get('admin/change-password', 'Backend\ProfileController@change_password');

    Route::get('admin/profile', 'Backend\ProfileController@profile');
    Route::post('admin/profile', 'Backend\ProfileController@update_admin_profile');
    // social-icon start menu
    Route::get('admin/social-icon', 'Backend\SocialIconController@list');
    Route::get('admin/social-icon/edit/{id}', 'Backend\SocialIconController@edit');
    Route::post('admin/social-icon/edit/{id}', 'Backend\SocialIconController@update');
    Route::get('admin/social-icon/delete/{id}', 'Backend\SocialIconController@delete');
    // social-icon end menu

    //SEO Menu start
    Route::get('admin/seo', 'Backend\SeoController@list');
    Route::get('admin/seo/add', 'Backend\SeoController@add');
    Route::post('admin/seo/add', 'Backend\SeoController@insert');
    Route::get('admin/seo/edit/{id}', 'Backend\SeoController@edit');
    Route::post('admin/seo/edit/{id}', 'Backend\SeoController@update');
    Route::get('admin/seo/delete/{id}', 'Backend\SeoController@delete');
    //SEO Menu end

    // start earning
    Route::get('admin/earning/{id}', 'Backend\EarningController@earning_admin');


    //end start earning


    Route::get('admin/chat-history/{id}', 'Backend\ChatController@chat_history');

    // Report Menu end

    Route::get('admin/report', 'Backend\ChatController@report_list');
    Route::get('admin/report/delete/{id}', 'Backend\ChatController@report_delete');
    Route::get('admin/lesson', 'Backend\LessonController@lesson_list');
    Route::get('admin/lesson/view/{id}', 'Backend\LessonController@view');

    // Staff activity Menu Start
    Route::get('admin/activity', 'Backend\ActivityController@list');
    Route::get('admin/activity/add', 'Backend\ActivityController@add');
    Route::post('admin/activity/add', 'Backend\ActivityController@insert');
    Route::get('admin/activity/edit/{id}', 'Backend\ActivityController@edit');
    Route::post('admin/activity/edit/{id}', 'Backend\ActivityController@update');
    Route::get('admin/activity/delete/{id}', 'Backend\ActivityController@delete');
    // Staff activity Menu End

    //  Country Start
    Route::get('admin/country', 'Backend\SocialIconController@country_list');
    Route::get('admin/country/add', 'Backend\SocialIconController@add_country');
    Route::post('admin/country/add', 'Backend\SocialIconController@insert_country');
    Route::get('admin/country/edit/{id}', 'Backend\SocialIconController@edit_country');
    Route::post('admin/country/edit/{id}', 'Backend\SocialIconController@update_country');
    Route::get('admin/country/delete/{id}', 'Backend\SocialIconController@delete_country');

    //  Country End

});
// Admin End

// Student Start
Route::group(['middleware' => 'student'], function () {

    Route::get('student/dashboard', 'Backend\DashboardController@dashboard');
    Route::get('student/course', 'Backend\CourseController@course');
    Route::get('student/course/view/{id}', 'Backend\LessonController@view');


     Route::get('student/notes', 'Backend\DashboardController@notes');
    // today start

    Route::get('student/offer-page', 'Backend\OfferController@offer_page');
    Route::get('student/offer-page/view/{id}', 'Backend\OfferController@view');
    // Today End

    Route::get('student/request-page', 'Backend\RequestController@request_page');
    Route::get('student/request-add', 'Backend\RequestController@request_add');
    Route::post('student/request-add', 'Backend\RequestController@request_insert');
    Route::get('student/request-page/delete/{id}', 'Backend\RequestController@request_delete');
    Route::get('student/request-page/edit/{id}', 'Backend\RequestController@request_edit');
    Route::post('student/request-page/edit/{id}', 'Backend\RequestController@request_update');
    Route::get('student/request-page/view/{id}', 'Backend\RequestController@request_view');

    Route::get('student/chat/{id?}', 'Backend\ChatController@chat');


    Route::get('student/profile', 'Backend\ProfileController@profile');
    Route::post('student/profile', 'Backend\ProfileController@update_student_profile');
    Route::get('student/change-password', 'Backend\ProfileController@change_password');


    Route::get('student/offer/payment/{id}', 'Backend\PaymentController@offer_payment');
    Route::get('student/offer/payment_success', 'Backend\PaymentController@payment_success');
    Route::get('student/offer/payment_cancel', 'Backend\PaymentController@payment_cancel');


    // book sesson

    Route::get('book-lesson/{id}', 'FindTutorController@book_lesson');
    Route::post('getBookLessonSubjectCategory', 'FindTutorController@getBookLessonSubjectCategory');
    Route::post('getCourseDate', 'FindTutorController@getCourseDate');
    Route::post('getCourseTime', 'FindTutorController@getCourseTime');

    Route::post('book_order_course', 'Backend\PaymentController@book_order_course');

    Route::get('student/course/payment_success_course', 'Backend\PaymentController@payment_success_course');
    Route::get('student/course/payment_cancel_course', 'Backend\PaymentController@payment_cancel_course');


    // Route::post('student/contact', 'Backend\ChatController@ContactMe');


    Route::post('student/lesson/homework_submit', 'Backend\CourseController@homework_submit_student');

    Route::post('student/lesson/complete/{id}', 'Backend\CourseController@lesson_complete');

    Route::get('student/notification', 'Backend\NotificationController@student_notification');
});
// Student End

// Tutor Teacher Start
Route::group(['middleware' => 'tutor'], function () {
     Route::get('tutor/notes', 'Backend\DashboardController@notes');

    Route::get('tutor/dashboard', 'Backend\DashboardController@dashboard');

    Route::get('tutor/lesson', 'Backend\LessonController@lesson');
    Route::get('tutor/lesson/view/{id}', 'Backend\LessonController@view');
    Route::get('tutor/chat/{id?}', 'Backend\ChatController@chat');

    Route::get('tutor/student-request', 'Backend\StudentRequestController@student_request');

    // course part
    Route::get('tutor/course', 'Backend\CourseController@course');
    Route::get('tutor/new-course', 'Backend\CourseController@new_course');
    Route::post('tutor/new-course', 'Backend\CourseController@insert_new_course');

    Route::get('tutor/course/view/{id}', 'Backend\CourseController@view');
    Route::get('tutor/course/delete/{id}', 'Backend\CourseController@delete');
    Route::get('tutor/course/edit/{id}', 'Backend\CourseController@edit');
    Route::post('tutor/course/edit/{id}', 'Backend\CourseController@update');
    // end course part

    // offer part
    Route::get('tutor/offer', 'Backend\OfferController@offer');
    Route::get('tutor/offer/add', 'Backend\OfferController@add');
    Route::post('tutor/offer/add', 'Backend\OfferController@insert');
    Route::get('tutor/offer/edit/{id}', 'Backend\OfferController@edit');
    Route::post('tutor/offer/edit/{id}', 'Backend\OfferController@update');
    Route::get('tutor/offer/edit/{id}', 'Backend\OfferController@edit');
    Route::get('tutor/offer/view/{id}', 'Backend\OfferController@view');
    Route::get('tutor/offer/delete/{id}', 'Backend\OfferController@delete');

    // end offer part

    Route::get('tutor/earning', 'Backend\EarningController@earning');
    Route::post('tutor/paypal/withdrawn', 'Backend\EarningController@paypal_withdrawn');
    Route::post('tutor/paypal/save', 'Backend\EarningController@paypal_save');
    Route::post('tutor/bank/save', 'Backend\EarningController@bank_save');




    // profile part

    Route::get('tutor/profile', 'Backend\ProfileController@profile');
    Route::post('tutor/profile', 'Backend\ProfileController@update_tutor_profile');
    Route::get('tutor/change-password', 'Backend\ProfileController@change_password');

    Route::get('tutor/qualification', 'Backend\ProfileController@qualification');
    Route::get('tutor/qualification/add', 'Backend\ProfileController@add_qualification');
    Route::post('tutor/qualification/add', 'Backend\ProfileController@insert_qualification');
    Route::get('tutor/qualification/edit/{id}', 'Backend\ProfileController@edit_qualification');
    Route::post('tutor/qualification/edit/{id}', 'Backend\ProfileController@update_qualification');
    Route::get('tutor/qualification/view/{id}', 'Backend\ProfileController@view_qualification');

    Route::get('tutor/qualification/delete/{id}', 'Backend\ProfileController@delete_qualification');


    Route::post('findstudent/getPopupLoaddata', 'FindStudentController@getPopupLoaddata');
    Route::post('findstudent/sendoffer', 'FindStudentController@sendoffer');


    Route::post('tutor/lesson/homework_submit', 'Backend\CourseController@homework_submit');

    Route::get('tutor/my-availability', 'Backend\AvailabilityController@my_availability');
    Route::post('tutor/my-availability', 'Backend\AvailabilityController@update_my_availability');

    // end profile part
    // Notification Start
    Route::get('tutor/notification', 'Backend\NotificationController@tutor_notification');
    // Notification End

   

});
// Tutor Teacher End

Route::group(['middleware' => 'common'], function () {
     Route::get('common/notes/delete/{id}', 'Backend\DashboardController@notes_delete');

    Route::get('tutor/course/subject/delete/{id}', 'Backend\CourseController@delete_subject');
    Route::get('tutor/course/lesson/delete/{id}', 'Backend\CourseController@delete_lesson');

    Route::post('common/change-password', 'Backend\ProfileController@update_change_password');

    Route::post('getchatdata', 'Backend\ChatController@getchatdata');
    // Route::post('sendreplychat', 'Backend\ChatController@sendreplychat');

    Route::post('getappendchat', 'Backend\ChatController@getappendchat');

    Route::post('update_message_count', 'Backend\ChatController@update_message_count');
    Route::post('get_chat_user', 'Backend\ChatController@get_chat_user');


    Route::post('report_submit', 'Backend\ChatController@report_submit');

    Route::post('note/lesson/add', 'Backend\CourseController@lesson_note_add');

    Route::post('user/note/add', 'Backend\DashboardController@user_note_add');

    Route::get('admin/send_mssage/{id}', 'Backend\ChatController@send_mssage_admin');

});







Route::get('/', 'HomeController@home');
Route::get('find-student', 'FindStudentController@find_student');
Route::get('find-tutor', 'FindTutorController@find_tutor');
Route::get('become-tutor', 'AuthController@become_tutor');
Route::get('tutor-profile/{id}', 'FindTutorController@tutor_profile');
Route::get('student-profile/{id}', 'FindStudentController@student_profile');




Route::get('login', 'AuthController@login');
Route::get('signup', 'AuthController@signup');
Route::get('become-student', 'AuthController@become_student');
Route::get('forgot-password', 'AuthController@forgot_password');
Route::post('become-tutor/add', 'AuthController@become_tutor_add');
Route::post('become-student/add', 'AuthController@become_student_add');
Route::post('auth-login/login', 'AuthController@auth_login');
Route::post('forgot_password/reset', 'AuthController@forgot_password_update');
Route::get('reset/{token?}', 'AuthController@reset_password');
Route::post('reset/{token?}', 'AuthController@reset_password_update');
Route::get('activate/{token?}', 'AuthController@activate');

 

Route::get('logout', 'AuthController@logout');
//Subscribe us now Email Start
Route::post('subscribe_email/add', 'AuthController@subscribe_email');
//Subscribe us now Email End


// general page
Route::get('why-us', 'HomeController@why_us');
Route::get('about', 'HomeController@about');
Route::get('contact-us', 'HomeController@contact_us');
Route::post('contact_us/add', 'HomeController@contact_us_add');
Route::get('terms', 'HomeController@terms');
Route::get('privacy', 'HomeController@privacy');

// end general page


Route::get('payment/release', 'CronJobController@paymentRelease');
