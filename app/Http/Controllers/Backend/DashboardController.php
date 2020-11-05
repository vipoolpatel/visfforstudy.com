<?php

namespace App\Http\Controllers\Backend;

use App\Models\UsersModel;
use App\Models\UserNoteModel;
use App\Models\CourseModel;
use App\Models\OrderCourseModel;
use App\Models\RequestModel;
use App\Models\OfferModel;
use App\Models\CategoryModel;
use App\Models\SubscribeEmailModel;
use App\Models\ChatModel;
use App\Models\WalletHistoryModel;
use App\Models\TransactionModel;
use App\Models\ReportChatModel;
use App\Models\OrderCourseHomeWorkModel;
use App\Models\UserPermissionModel;
use App\Models\ActivityModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;



class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $data['chatcount'] = ChatModel::countdashabordmessage();
        if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 4)
        {
            // permisson
            $data['p_total_earing'] = UserPermissionModel::getPermission('total_earing');
            $data['p_net_profit'] = UserPermissionModel::getPermission('net_profit');
            $data['p_withdraw_request'] = UserPermissionModel::getPermission('withdraw_request');
            $data['p_email_marketing'] = UserPermissionModel::getPermission('email_marketing');
            $data['p_pending_offers'] = UserPermissionModel::getPermission('pending_offers');
            $data['p_pending_courses'] = UserPermissionModel::getPermission('pending_courses');
            $data['p_pending_requests'] = UserPermissionModel::getPermission('pending_requests');
            $data['p_total_tutor'] = UserPermissionModel::getPermission('total_tutor');
            $data['p_total_student'] = UserPermissionModel::getPermission('total_student');
            $data['p_total_category'] = UserPermissionModel::getPermission('total_category');
            $data['p_total_offer'] = UserPermissionModel::getPermission('total_offer');
            $data['p_total_admin'] = UserPermissionModel::getPermission('total_admin');
            $data['p_total_booked_lesson'] = UserPermissionModel::getPermission('total_booked_lesson');
            $data['p_new_report'] = UserPermissionModel::getPermission('new_report');
            $data['p_notification_page'] = UserPermissionModel::getPermission('notification_page');
            $data['p_staff_report_page'] = UserPermissionModel::getPermission('staff_report_page');
            
            


      


            // permisson

            //Count start in dashboard
            $data['countOfferPending'] = OfferModel::where('status', '=' ,'1')->count();
            $data['countCoursePending'] = CourseModel::where('status', '=', '1')->count();
            $data['countRequestPending'] = RequestModel::where('status', '=', '1')->count();
            $data['countStudentTotal'] = UsersModel::where('is_admin', '=', '3')->count();
            $data['countTeacherTotal'] = UsersModel::where('is_admin', '=', '2')->count();
            $data['countCategoryTotal'] = CategoryModel::count();
            $data['countOfferTotal'] =    OfferModel::count();
            
            $data['countAdminTotal'] = UsersModel::where('is_admin', '=', '1')->where('status', '=', '1')->count();

            $data['countEmailTotal'] = SubscribeEmailModel::count();


            $data['TotalEaring']    = UsersModel::getTotalEaring();
            $data['TotalNetProfit'] = UsersModel::getTotalNetProfit();

            $data['TotalBookedLesson']    = OrderCourseModel::getTotalBookedLesson();

            $data['getAdminBookedLesson'] = OrderCourseModel::getAdminBookedLesson();


            $data['TotalNewReport'] = ReportChatModel::getTotalNewReport();

            $data['getReportDashboard'] = ReportChatModel::getReportDashboard();

            $data['getActivity'] = ActivityModel::getActivityDashboard();
            
            $data['getAdminOnline'] = UsersModel::getUserOnline(1);            
            $data['getTutorOnline'] = UsersModel::getUserOnline(2);       
            $data['getStudentOnline'] = UsersModel::getUserOnline(3);            


            //Count end in dashboard
            $data['getcourse'] = CourseModel::get_admin_dashboard();
            $data['getrequest'] = RequestModel::get_admin_dashboard_request();
            $data['getoffer'] = OfferModel::get_admin_dashboard_offer();

            $data['withdraw_request'] = WalletHistoryModel::get_history_wallet_count(1);

            $getrecord = UsersModel::where('id', '=', Auth::user()->id)->first();
            $data['getrecord'] = $getrecord;

            $data['body'] = 'loggedin admin dashboard';
            return view('backend.admin.dashboard', $data);
        }
        else if(Auth::user()->is_admin == 2)
        {

            $data['getHomework'] = OrderCourseModel::getSubmitedHomeworkTeacherDashbaord(Auth::user()->id);      

            $data['countLessonsTotal'] = OrderCourseModel::where('user_id','=',Auth::user()->id)->where('is_payment','=','1')->count();

            $getrecord = UsersModel::where('id', '=', Auth::user()->id)->first();
            $data['getrecord'] = $getrecord;

            //Count Start in dashboard
            $data['countOfferTotal'] = OfferModel::where('user_id','=',Auth::user()->id)->where('is_delete','=','0')->count();
            //Count End in dashboard
            $data['countRequestTotal'] = RequestModel::where('is_delete','=','0')->count();

            $data['getLesson'] = OrderCourseModel::getTutorOrderDashboard(Auth::user()->id);

            
            $data['getrequest'] = RequestModel::get_tutor_dashboard_request();

            $data['body'] = 'loggedin teacher dashboard';
            return view('backend.tutor.dashboard', $data);
        }
        else if(Auth::user()->is_admin == 3)
        {
            $getrecord = UsersModel::where('id', '=', Auth::user()->id)->first();
            $data['getrecord'] = $getrecord;
            
            //Count Start in dashboard
            $data['countRequestTotal'] = RequestModel::where('user_id','=',Auth::user()->id)->where('is_delete','=','0')->count();
            $data['countCourseTotal'] = OrderCourseModel::where('student_id','=',Auth::user()->id)->where('is_payment','=','1')->count();


            $data['Newoffer'] = OfferModel::where('student_id','=',Auth::user()->id)->where('status','=','2')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),"=",date('Y-m-d'))->count();


            $data['RequestCount'] = RequestModel::where('user_id','=',Auth::user()->id)->where('is_delete','=','0')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),"=",date('Y-m-d'))->count();


            $data['getLesson'] = OrderCourseModel::getStudentOrderDashboard(Auth::user()->id);

            $data['getHomework'] = OrderCourseModel::getSubmitedHomeworkStudentDashbaord(Auth::user()->id);      
            
            $data['getTeacher'] = UsersModel::orderBy('id','desc')->where('is_admin', '=', '2')->limit(4)->get();    
            //Count End in dashboard

            $data['body'] = 'loggedin student dashboard';
            return view('backend.student.dashboard', $data);
        }

    }

    public function user_note_add(Request $request)
    {
        $note = new UserNoteModel;
        $note->user_id = Auth::user()->id;
        $note->title = $request->title;
        $note->message = $request->message;
        $note->note_date = $request->note_date;
        $note->save();


        return redirect()->back()->with('success',"Note successfully created.");

    }

    public function notes(Request $request)
    {
        $getnote = UserNoteModel::where('user_id','=',Auth::user()->id)->paginate(50);
        $data['getrecord'] = $getnote;
        return view('backend.common.notes.list', $data);
    }

    public function notes_delete($id)
    {
        $record = UserNoteModel::find($id);
        $record->delete();
        return redirect()->back()->with('success',"Record successfully deleted");
    }
    
}
