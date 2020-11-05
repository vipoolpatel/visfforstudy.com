<?php

namespace App\Http\Controllers\Backend;

use App\Models\CourseModel;
use App\Models\CategoryModel;
use App\Models\LanguageModel;
use App\Models\SubjectModel;
use App\Models\CourseLessonModel;
use App\Models\LevelOfStudentModel;
use App\Models\StatusModel;
use App\Models\PriceModel;
use App\Models\RequestTypeModel;
use App\Models\OrderCourseModel;
use App\Models\OrderCourseNoteModel;
use App\Models\OrderCourseHomeWorkModel;
use App\Models\UserPermissionModel;
use App\Models\UserReviewModel;
use App\Models\OfferModel;
use App\Models\UsersModel;
use App\Notifications\CommonNotification;
use App\Notifications\TeacherNotification;


use App\Models\TransactionModel;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use File;
use DateTimeZone;
use DateTime;
use Image;

class CourseController extends Controller
{

      public function course(Request $request) {

            $getrecord = CourseModel::orderBy('id', 'desc');
            if(Auth::user()->is_admin == 2) { 
               $getrecord = $getrecord->where('user_id', '=', Auth::user()->id);
            }
             //Search Box Start
            if (!empty($request->course_title)){
              $getrecord = $getrecord->where('course_title', 'like', '%' . $request->course_title . '%');
            }
            if(!empty($request->language_id)) {
             $getrecord = $getrecord->where('language_id', 'like', '%' . $request->language_id . '%');
            }

            if(!empty($request->category_id)) {
             $getrecord = $getrecord->where('category_id', 'like', '%' . $request->category_id . '%'); 
            }

            if(!empty($request->status)) {
                $getrecord = $getrecord->where('status', 'like', '%' . $request->status . '%'); 
            }
            if(!empty($request->price_id)) {
                $getprice = PriceModel::find($request->price_id);
                $getrecord = $getrecord->where('course.lesson_per_rate','>=', $getprice->min_price);
                $getrecord = $getrecord->where('course.lesson_per_rate','<=', $getprice->max_price);
             }
   
            //Search Box End
            $getrecord = $getrecord->where('is_delete', '=', 0);

            $getrecord = $getrecord->paginate(50);
            $data['getrecord'] = $getrecord;

            $data['getcategory']      = CategoryModel::getCategory();
            $data['getlanguge']       = LanguageModel::getLanguge();
            $data['getlevel']         = LevelOfStudentModel::getLevelOfStudent();
            $data['getrequesttype']   = RequestTypeModel::getRequestType();
            $data['getstatus']        = StatusModel::getStatus();

            $data['getprice']         = PriceModel::getPrice();

          if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 4)
          {
             $p_courses_page = UserPermissionModel::getPermission('courses_page');
             if(empty($p_courses_page)) {
                return redirect('admin/dashboard');
             }
             
              $data['body'] = 'loggedin student course';
              return view('backend.admin.course.list', $data);
          }
          else if(Auth::user()->is_admin == 2)
          { 
              $data['body'] = 'loggedin student course';
              return view('backend.tutor.course.list', $data);
          }
          else if(Auth::user()->is_admin == 3)
          {
              $data['getOrder'] = OrderCourseModel::where('is_payment','=',1)->where('student_id','=',Auth::user()->id)->orderBy('id','desc')->paginate(40);

              $data['body'] = 'loggedin student course';
              return view('backend.student.course.list', $data);
          }

      }



      public function view($id)
      {
          $record = CourseModel::find($id);
          $data['value'] = $record;
          $data['body'] = 'loggedin student course single';
          return view('backend.tutor.course.view', $data);
      }


      public function new_course()
     {
          $data['getCategory'] = CategoryModel::getCategory();
          $data['getLanguage'] = LanguageModel::getLanguge();
          $data['getRequestType'] = RequestTypeModel::getRequestType();

          $data['body'] = 'booking loggedin teacher publish';
          return view('backend.tutor.course.add', $data);
     }


     public function insert_new_course(Request $request)
     {
          $record = new CourseModel;
          $record->category_id = trim($request->category_id);
          $record->language_id = trim($request->language_id);
          $record->user_id = Auth::user()->id;


          if(!empty($request->file('image'))) {

              $ext           = 'jpg';
              $file          = $request->file('image');
              $randomStr     = date('YmdHis').str_random(30);
              $filename      = strtolower($randomStr) . '.' . $ext;
              $file->move('upload/course/', $filename);
              $record->image = $filename;

              $thumb_img = Image::make('upload/course/'.$filename)->resize(400, 400);
              $thumb_img->save('upload/course/' . $filename, 100);

          }

          if(!empty($request->file('course_video'))) {

               $ext           = $request->file('course_video')->extension();
               $file          = $request->file('course_video');
               $randomStr     = date('YmdHis').str_random(30);
               $filename      = strtolower($randomStr) . '.' . $ext;
               $file->move('upload/course/', $filename);
               $record->course_video = $filename;

          }

          $record->course_title = trim($request->course_title);
          $record->lesson_type_id = trim($request->lesson_type_id);
          $record->description = trim($request->description);
          $record->lesson_per_rate = !empty($request->lesson_per_rate) ? $request->lesson_per_rate : '0';
          $record->status = 1;
          $record->is_notification = 2;
          $record->save();

          if(!empty($request->subject_name)) {
               foreach ($request->subject_name as $subject_name) {
                    $subject = new SubjectModel;
                    $subject->course_id = $record->id;
                    $subject->subject_name = !empty($subject_name) ? trim($subject_name) :null;
                    $subject->save();
               }
          }


          if(!empty($request->lesson_date)) {

               $devide_date   = explode("to", trim($request->lesson_date));
               $lesson_time   = $request->lesson_time;
               $duration      = $request->duration;

               if(!empty(trim($devide_date[0])) && !empty(trim($devide_date[1]))) {
                    $start_date = trim($devide_date[0]);
                    $end_date   = trim($devide_date[1]);

                    for ($i = $start_date; $i <= $end_date ; $i++) { 

                         if(!empty($lesson_time) && !empty($duration) && !empty($i))
                         {
                              for ($j=0; $j < count($duration); $j++) { 

                                   $GMT   = new DateTimeZone("GMT");
                                   $date  = new DateTime($i.' '.$lesson_time[$j], $GMT );
                                   $date  = $date->format('Y-m-d h:i:s A');
                              
                                   $lesson_date_database = strtotime($date);
                                   $lesson_time_database = strtotime($date);

                                   $course_lesson = new CourseLessonModel;
                                   $course_lesson->lesson_date = $lesson_date_database;
                                   $course_lesson->lesson_time = $lesson_time_database;

                                   $course_lesson->lesson_start_date = $i;
                                   $course_lesson->lesson_end_time   = $lesson_time[$j];

                                   $course_lesson->duration    = $duration[$j];
                                   $course_lesson->course_id   = $record->id;
                                   $course_lesson->save();
                              }
                         }          
                    }     
               }
          }



// notification work
        $user = UsersModel::getuser(Auth::user()->id);
        $type = 'course';
        $id = $record->id;
        $message = $user->getName(). ' created new course';
        $user->notify(new CommonNotification($type, $id, $message));
// notification work



          return redirect('tutor/course')->with('success', 'Course created successfully');
     }

    

    public function edit($id)
    {
        $record = CourseModel::find($id);
        $data['getCategory'] = CategoryModel::getCategory();
        $data['getLanguage'] = LanguageModel::getLanguge();
        $data['getRequestType'] = RequestTypeModel::getRequestType();
        $data['record'] = $record;
        $data['body'] = 'booking loggedin teacher publish';
        return view('backend.tutor.course.edit', $data);
    }


    public function update($id, Request $request) {

       
          $record = CourseModel::find($id);
          $record->category_id = trim($request->category_id);
          $record->language_id = trim($request->language_id);
       
         
          if (!empty($request->file('image'))){

              if(!empty($record->image) && file_exists('upload/course/'. $record->image)) {
                  unlink('upload/course/'. $record->image);
              }

              
              $ext       = 'jpg';
              $file      = $request->file('image');
              $randomStr = date('YmdHis').str_random(30);
              $filename  = strtolower($randomStr) . '.' . $ext;
              $file->move('upload/course/', $filename);
              $record->image = $filename;

              $thumb_img = Image::make('upload/course/'.$filename)->resize(400, 400);
              $thumb_img->save('upload/course/' . $filename, 100);
              
          }

          if (!empty($request->file('course_video'))){

              if(!empty($record->course_video) && file_exists('upload/course/'. $record->course_video)) {
                  unlink('upload/course/'. $record->course_video);
              }

              $ext        = $request->file('course_video')->extension();
              $file       = $request->file('course_video');
              $randomStr  = date('YmdHis').str_random(30);
              $filename   = strtolower($randomStr) . '.' . $ext;
              $file->move('upload/course/', $filename);
              $record->course_video = $filename;

          }

          $record->course_title = trim($request->course_title);
          $record->lesson_type_id = trim($request->lesson_type_id);
          $record->description = trim($request->description);
          $record->lesson_per_rate = !empty($request->lesson_per_rate) ? $request->lesson_per_rate : '0';
          $record->status = 1;
          $record->is_notification = 2;
          $record->save();

          if(!empty($request->subject_name)) {
               foreach ($request->subject_name as $subject_name) {
                  if(!empty($subject_name))
                  {
                      $subject = new SubjectModel;
                      $subject->course_id = $record->id;
                      $subject->subject_name = !empty($subject_name) ? trim($subject_name) :null;
                      $subject->save();
                  }                    
               }
          }


          if(!empty($request->lesson_date)) {

               $devide_date   = explode("to", trim($request->lesson_date));
               $lesson_time   = $request->lesson_time;
               $duration      = $request->duration;

               if(!empty(trim($devide_date[0])) && !empty(trim($devide_date[1]))) {
                    $start_date = trim($devide_date[0]);
                    $end_date   = trim($devide_date[1]);

                    for ($i = $start_date; $i <= $end_date ; $i++) { 

                         if(!empty($lesson_time) && !empty($duration) && !empty($i))
                         {
                              for ($j=0; $j < count($duration); $j++) { 

                                   $GMT   = new DateTimeZone("GMT");
                                   $date  = new DateTime($i.' '.$lesson_time[$j], $GMT );
                                   $date  = $date->format('Y-m-d h:i:s A');
                              
                                   $lesson_date_database = strtotime($date);
                                   $lesson_time_database = strtotime($date);

                                   $course_lesson = new CourseLessonModel;
                                   $course_lesson->lesson_date = $lesson_date_database;
                                   $course_lesson->lesson_time = $lesson_time_database;

                                   $course_lesson->lesson_start_date = $i;
                                   $course_lesson->lesson_end_time   = $lesson_time[$j];

                                   $course_lesson->duration    = $duration[$j];
                                   $course_lesson->course_id   = $record->id;
                                   $course_lesson->save();
                              }
                         }          
                    }     
               }
          }
       
          return redirect('tutor/course')->with('success', 'Course successfully update.');
    }

    public function delete_subject($id) {

        $update            = SubjectModel::find($id);
        $update->is_delete = 1;
        $update->save();

        return redirect()->back()->with('success', 'Record successfully deleted.');

    }

    public function delete_lesson($id) {

        $update            = CourseLessonModel::find($id);
        $update->is_delete = 1;
        $update->save();

        return redirect()->back()->with('success', 'Record successfully deleted.');

    }

    

    public function delete($id) {
        $this->delete_course($id);
        return redirect()->back()->with('success', 'Record successfully deleted.');
    }



    //Admin Start

    public function admin_view($id)
    {
        $record = CourseModel::find($id);

        if ($record->is_notification != '1') {
            $record_update     = CourseModel::find($id);
            $record_update->is_notification  = '0';
            $record_update->save();
        }


        $data['value'] = $record;
        $data['body'] = 'loggedin admin';
        return view('backend.admin.course.view', $data);
    }

    public function admin_delete($id)
    {
        $this->delete_course($id);
        return redirect('admin/course')->with('success', 'Record successfully deleted!');
    }



    public function change_status(Request $request) {

        $order                  = CourseModel::find($request->id);
        $order->status          = $request->status;
        $order->is_notification = '1';
        $order->save();

        $order  = CourseModel::find($request->id);
        
        $user    = UsersModel::getuser($order->user_id);
        $message = 'Your course has been '.$order->getstatus->status_name;
        $user->notify(new TeacherNotification('course', $order->id, $message));


        $json['success'] = 'Status successfully changed';
        echo json_encode($json);
        
    }

    // end admin part

    public function delete_course($id) {
        $record  = CourseModel::find($id);
        $record->is_delete  = 1;
        $record->save();

        $subject = SubjectModel::where('course_id', '=', $id)->get();
        foreach ($subject as $value) {
            $save = SubjectModel::find($value->id);
            $save->is_delete = 1;
            $save->save();  
        }

        $Lesson = CourseLessonModel::where('course_id', '=', $id)->get();
        foreach ($Lesson as $value_l) {
            $save_l = CourseLessonModel::find($value_l->id);
            $save_l->is_delete = 1;
            $save_l->save();  
        }      

    }


    // order lesson note add
    public function lesson_note_add(Request $request)
    {
        
        $note       = new OrderCourseNoteModel;
        if(!empty($request->type))
        {
            $note->offer_id = $request->offer_id;
            $note->type = 'offer';
        } 
        else
        {
            $note->order_course_id = $request->order_course_id;  
        }
        
        $note->title        = $request->title;
        $note->message      = $request->message;
        $note->user_id      = Auth::user()->id;
        $note->save();

        return redirect()->back()->with('success', "Note successfully created");
    }

    public function homework_submit(Request $request)
    { 

       $GMT   = new DateTimeZone("GMT");
       $date  = new DateTime($request->lesson_date.' '.$request->lesson_time, $GMT );
       $date  = $date->format('Y-m-d h:i:s A');
       $lesson_date = strtotime($date);


        $homework = new OrderCourseHomeWorkModel;
        if(!empty($request->type))
        {
            $homework->offer_id = $request->offer_id;
            $homework->type = 'offer';
        } 
        else
        {
            $homework->order_course_id = $request->order_course_id;  
        }
        
        $homework->title           = trim($request->title);
        $homework->description     = trim($request->description);
        $homework->lesson_start_date  = trim($request->lesson_date);
        $homework->lesson_time_date   = trim($request->lesson_time);
        $homework->lesson_date     = $lesson_date;
        $homework->lesson_time     = $lesson_date;
        
        if(!empty($request->file('attachment'))) {

             $ext           = $request->file('attachment')->extension();
             $file          = $request->file('attachment');
             $randomStr     = date('YmdHis').str_random(30);
             $filename      = strtolower($randomStr) . '.' . $ext;
             $file->move('upload/homework/', $filename);
             $homework->attachment = $filename;

        }

        $homework->save();
        return redirect()->back()->with('success', "Homework successfully created");
    }


    public function homework_submit_student(Request $request)
    {
        $homework =  OrderCourseHomeWorkModel::find($request->home_work_id);
        
        if(!empty($request->file('attachment'))) {
            $ext           = $request->file('attachment')->extension();
            $file          = $request->file('attachment');
            $randomStr     = date('YmdHis').str_random(30);
            $filename      = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/homework/', $filename);
            $homework->attachment_complete = $filename;
        }

        $homework->description_complete = trim($request->description);
        $homework->complete_date        = time();
        $homework->is_complete          = 1;
        $homework->save();

        return redirect()->back()->with('success', "Homework successfully submited");       
    }

    public function lesson_complete(Request $request) {

        if(!empty($request->type))
        {
            $order = OfferModel::find($request->offer_id);
            $order->is_complete = 2;
            $order->save();

            $review =  new UserReviewModel;
            $review->review_by = Auth::user()->id;
            $review->user_id = $order->user_id;
            $review->offer_id = $request->offer_id;
            $review->type = 'offer';
            $review->rating = $request->rating;
            $review->review = trim($request->review);
            $review->save();
        }
        else
        {
            $order = OrderCourseModel::find($request->order_course_id);
            $order->status = 2;
            $order->save();

            $review =  new UserReviewModel;
            $review->review_by = Auth::user()->id;
            $review->user_id = $order->user_id;
            $review->order_course_id = $request->order_course_id;
            $review->type = 'course';
            $review->rating = $request->rating;
            $review->review = trim($request->review);
            $review->save();
        }
        
        $release_date              = date('Y-m-d', strtotime(' + 15 days'));
        $transaction               = TransactionModel::find($order->transaction_id);
        $transaction->release_date = $release_date;
        $transaction->save();


        $user = UsersModel::find($order->user_id);
        $ratingavg  = $user->averageRating();
        $user->ratingavg = $ratingavg;
        $user->save();

        return redirect()->back()->with('success', "Course successfully completed");
    }



}

