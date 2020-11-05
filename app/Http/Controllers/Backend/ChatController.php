<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use App\Models\ChatModel;
use App\Models\ReportChatModel;
use App\Models\UserPermissionModel;
use App\Models\BlockChatModel;


use Auth;


class ChatController extends Controller
{
    public function chat($sender_id = '')
    {
        $id = Auth::user()->id;
        if(!empty($sender_id)) {
            $data['sender_name'] = UsersModel::find($sender_id);
        }

        $data['sender_id'] = $sender_id;

        $data['getchatuser'] = ChatModel::getChatUser($id);
      
    	if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 4)
        {   
             $p_chat_page = UserPermissionModel::getPermission('chat_page');
             if(empty($p_chat_page)) {
                 return redirect('admin/dashboard');
             }


            $data['chat_title'] = 'Admin conversations';
            $data['body'] = 'loggedin admin chat';
        }
        else if(Auth::user()->is_admin == 2)
        {
            $data['chat_title'] = 'Tutor conversations';
        	$data['body'] = 'loggedin admin chat';
        }
        else if(Auth::user()->is_admin == 3)
        {
            $data['chat_title'] = 'Student conversations';
            $data['body'] = 'loggedin admin chat';
        }


        $data['chat_history'] = false;
        return view('backend.chat.list',$data);
    }

    public function chat_history($id, Request $request) {
        $data['chat_history'] = true;
        $data['getchatuser'] = ChatModel::getChatUser($id);
        $data['chat_title'] = 'Chat History';
        $data['body'] = 'loggedin admin chat';
        return view('backend.chat.list',$data);
    }

    public function getchatdata(Request $request) {

        $getbockchat = BlockChatModel::all();
        $sender_id    = $request->sender_id;
        $chat_history = $request->chat_history;

        ChatModel::where('sender_id','=',$sender_id)->where('receiver_id','=',Auth::user()->id)->update(['status' => '1']);
                 
        $chat = ChatModel::getChat($sender_id);
        $user = UsersModel::find($sender_id);

        return response()->json([
          "status"  => true,
          "success" => view("backend.chat._all_chat", [
            "chat" => $chat,
            "user" => $user,
            "getbockchat" => $getbockchat,
            "chat_history" => $chat_history
          ])->render(),
        ], 200);

    }

    public function getappendchat(Request $request)
    {
        $sender_id    = $request->sender_id;
        $chat = ChatModel::getChatNew($sender_id);
        $user = UsersModel::find($sender_id);

        ChatModel::where('sender_id','=',$sender_id)->where('receiver_id','=',Auth::user()->id)->update(['status' => '1']);

        return response()->json([
          "status"  => true,
          "success" => view("backend.chat._append_chat", [
            "chat" => $chat,
            "user" => $user
          ])->render(),
        ], 200);

    }

    public function get_chat_user(Request $request) {
        $getchatuser = ChatModel::getChatUser(Auth::user()->id);

        return response()->json([
          "status"  => true,
          "success" => view("backend.chat._user", [
            "getchatuser" => $getchatuser
          ])->render(),
        ], 200);

    }   


    public function update_message_count(Request $request) {
        $sender_id    = $request->sender_id;
        ChatModel::where('sender_id','=',$sender_id)->where('receiver_id','=',Auth::user()->id)->update(['status' => '1']);
        $json['sucess'] = true;
        echo json_encode($json);
    }


    // public function ContactMe(Request $request){
    //     $chat = new ChatModel;
    //     $chat->receiver_id  = trim($request->receiver_id);
    //     $chat->message      = $request->message;
    //     $chat->sender_id    = Auth::user()->id;
    //     $chat->message_type = 0;
    //     $chat->save();
    //     return redirect()->back()->with('success', 'Your message successfully send.');
    // }

    // public function sendreplychat(Request $request)
    // {
    //     $chat = new ChatModel;
    //     $chat->receiver_id  = trim($request->receiver_id);
    //     $chat->message      = $request->message;
    //     $chat->sender_id    = Auth::user()->id;
    //     $chat->message_type = 0;
    //     $chat->save();
        
    //     return response()->json([
    //       "status"  => true,
    //       "success" => view("backend.chat._single_append_chat", [
    //         "chat" => $chat
    //       ])->render(),
    //     ], 200);

    // }

    public function send_mssage_admin($id, Request $request)
    {
        $chat = new ChatModel;
        $chat->receiver_id  = trim($id);
        $chat->message      = '';
        $chat->sender_id    = Auth::user()->id;
        $chat->message_type = 0;
        $chat->save();
        
        if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 4)
        {
            return redirect('admin/chat/'.$id);
        }
        else if(Auth::user()->is_admin == 2)
        {
            return redirect('tutor/chat/'.$id);
        }
        else if(Auth::user()->is_admin == 3)
        {
            return redirect('student/chat/'.$id);
        }
            
    }


    public function report_submit(Request $request) {

        $report = new ReportChatModel;
        $report->sender_id     = Auth::user()->id;
        $report->receiver_id   = $request->receiver_id;
        $report->chat_id       = $request->chat_id;
        $report->reason        = trim($request->reason);
        $report->save();

        $json['message'] = "Your report message successfully sent.";
        echo json_encode($json);
    }



     // Report Menu Start
    public function report_list(Request $request)
    {
        $p_report_page = UserPermissionModel::getPermission('report_page');
         if(empty($p_report_page)) {
            return redirect('admin/dashboard');
         }
        $getrecord = ReportChatModel::orderBy('id', 'desc');
        // Search box Start
        if (!empty($request->id)) {
            $getrecord = $getrecord->where('id', '=', $request->id);
        }
      
        if ($request->sender_id) {
            $getrecord = $getrecord->where('sender_id', '=', $request->sender_id);
        }
        // Search box End

        $getrecord  = $getrecord->paginate(50);

        $data['getrecord'] = $getrecord;
        $data['getuser']   = UsersModel::getUsers();
        return view('backend.admin.report.list', $data);
    }
    public function report_delete($id)
    {
        $record = ReportChatModel::find($id);
        $record->delete();
        return redirect('admin/report')->with('success', 'Record successfully deleted');
    }
    // Report Menu End

    


}
