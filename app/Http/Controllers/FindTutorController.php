<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\LevelOfStudentModel;
use App\Models\RequestTypeModel;
use App\Models\LanguageModel;
use App\Models\PriceModel;
use App\Models\SubjectModel;
use App\Models\CourseModel;
use App\Models\CourseLessonModel;
use App\Models\BookingModel;
use App\Models\UserAvailabilityModel;
use App\Models\WeekModel;
use App\Models\WeekSessionModel;
use App\Models\BlockChatModel;
use App\Models\SeoModel;




class FindTutorController extends Controller
{
    public function find_tutor(Request $request)
    {
        $getrecord = UsersModel::select('users.*');
        $getrecord = $getrecord->join('category','users.category_id','=', 'category.id');

        // Search box Start

        if(!empty($request->find_by_date) || !empty($request->category)) {

            $getrecord = $getrecord->join('course','course.user_id','=', 'users.id');
            $getrecord = $getrecord->join('course_lesson','course_lesson.course_id','=', 'course.id');

            if(!empty($request->find_by_date)) {                        
                $getrecord = $getrecord->where('course_lesson.lesson_start_date', '>=' , date('Y-m-d'));
                $getrecord = $getrecord->where('course_lesson.lesson_start_date', '=' , $request->find_by_date);
            }

            if(!empty($request->category)) {
                $getrecord = $getrecord->where('course.course_title', 'like', '%' . $request->category . '%');
            }

        }

        if(!empty($request->languge_id)) {
            $getrecord = $getrecord->join('user_language','user_language.user_id','=', 'users.id');
            $getrecord = $getrecord->where('user_language.language_id','=', $request->languge_id);
        }

        if(!empty($request->category_id)) {
            $getrecord = $getrecord->where('users.category_id', '=' ,$request->category_id);
        }

        if(!empty($request->level_of_teacher)) {
            $getrecord = $getrecord->where('users.level_of_teacher','=', $request->level_of_teacher);
        }

        if(!empty($request->price_id)) {
            $getprice = PriceModel::find($request->price_id);
            $getrecord = $getrecord->where('users.hour_per_rate','>=', $getprice->min_price);
            $getrecord = $getrecord->where('users.hour_per_rate','<=', $getprice->max_price);
        }

        // Search box End

        $getrecord = $getrecord->where('users.is_admin', '=', '2');
        $getrecord = $getrecord->where('users.status', '=', '1');
        $getrecord = $getrecord->orderBy('users.id', 'desc');
        $getrecord = $getrecord->groupBy('users.id');
        $getrecord = $getrecord->paginate(50);

        $data['getrecord'] = $getrecord;
        
        $data['getprice'] = PriceModel::getprice();
        $data['getcategory'] = CategoryModel::getCategory();
        $data['getlevel'] = LevelOfStudentModel::getLevelOfStudent();
        $data['getlanguge'] = LanguageModel::getLanguge();
      	$data['body'] = 'profile archive tutor';

        $getseo = SeoModel::getseo('find-tutor');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';


      	return view('find_tutor.find_tutor', $data);
    }

    public function tutor_profile($id)
    {

        $data['getbockchat'] = BlockChatModel::all();
        $data['getWeek'] = WeekModel::get();
        $data['getWeekSession'] = WeekSessionModel::get();
        
        $data['getrecord'] = UsersModel::find($id);
        if(!empty($data['getrecord']))
        {
            $data['body'] = 'profile single tutor';

            $data['getsubject'] = SubjectModel::getcoursesubject($id);

            $data['meta_title'] = $data['getrecord']->getName().' - VISfForStudy';

            return view('find_tutor.tutor_profile', $data);            
        }
        else
        {
            return redirect(url(''));
        }

    }

    public function book_lesson($user_id)
    {

        $data['getrecord'] = UsersModel::find($user_id);
        if(!empty($data['getrecord']))
        {
            $data['getlevel']     = LevelOfStudentModel::getLevelOfStudent();
            $data['getcategory']  = CourseModel::getCourseCategory($user_id);
            $data['getrequesttype']  = RequestTypeModel::getRequestType();
            $data['getBooking']  = BookingModel::getBooking();
            
            
            $data['meta_title'] = $data['getrecord']->getName().' Book Lesson - VISfForStudy';

            $data['body']       = 'booking lesson';
            $data['user_id']    = $user_id;
            return view('find_tutor.book_lesson', $data);       
        }
        else
        {
            return redirect(url(''));
        }

    
    }


    public function getBookLessonSubjectCategory(Request $request) {

            $category_id = $request->category_id;
            $user_id     = $request->user_id;

            $getcategory  = CourseModel::getCourseCategorySingle($category_id, $user_id);
            $course_id = array();
            foreach($getcategory as $value)
            {   
                $course_id[] = $value->id;
            }

            $getsubject  = SubjectModel::getCourseCategorySubject($course_id);

            $html = '';
            $html .= '<option value="">Selct Subject</option>';
            foreach($getsubject as $subject)
            {
                $html .= '<option value="'.$subject->id.'">'.$subject->subject_name.'</option>';
            }

            $json['success'] = $html;
            echo json_encode($json);

    }


    public function getCourseDate(Request $request)
    {
        $user_id    = $request->user_id;
        $getSubject = SubjectModel::find($request->subject_id);
        $course_id  = !empty($getSubject->course_id)?$getSubject->course_id:'';
        $getcourse  = CourseModel::find($course_id);

        $lesson_per_rate = !empty($getcourse->lesson_per_rate) ? number_format($getcourse->lesson_per_rate,2) : '0.00';

        return response()->json([
          "status"  => true,
          'lesson_per_rate'   => $lesson_per_rate,
          "success" => view("find_tutor._course_date", [
            "getcourse" => $getcourse,
          ])->render(),
        ], 200);        
    }


    public function getCourseTime(Request $request)
    {
        $lesson_date_id   = $request->lesson_date_id;
        $getdate          = CourseLessonModel::find($lesson_date_id);

        $getdate          = CourseLessonModel::getCourseTime($getdate->lesson_start_date,$getdate->course_id);
        return response()->json([
          "status" => true,
          "success" => view("find_tutor._course_time", [
            "getdate" => $getdate,
          ])->render(),
        ], 200);        


    }

    


}
