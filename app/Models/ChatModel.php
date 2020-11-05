<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class ChatModel extends Model
{
    protected $table = 'chat';


   public function getsender()
   {
   	   return $this->belongsTo(UsersModel::class, "sender_id");
   }

   public function getreceiver()
   {
   	   return $this->belongsTo(UsersModel::class, "receiver_id");
   }

   public function getconnectuser()
   {
   	   return $this->belongsTo(UsersModel::class, "connect_user_id");
   }


   static public function countmessage($connect_user_id)
   {
   	  return self::where('sender_id','=',$connect_user_id)->where('receiver_id','=',Auth::user()->id)->where('status','=',0)->where('message','!=','')->count();
   }

   static public function app_countmessage($connect_user_id,$user_id)
   {
      return self::where('sender_id','=',$connect_user_id)->where('receiver_id','=',$user_id)->where('status','=',0)->where('message','!=','')->count();
   }


   static public function countdashabordmessage() {
		$i = 0;
   		$getdata = ChatModel::getChatUser(Auth::user()->id);
   		foreach ($getdata as $key => $value) {
			$count = ChatModel::countmessage($value->connect_user_id);
			if(!empty($count))
			{
				$i++;
			}
   		}
   		return $i;
   }
   
   static function getChatNew($sender_id) {

	   $receiver_id = Auth::user()->id;
       $query =  self::select('chat.*')
            ->where('sender_id','=',$sender_id)
            ->where('receiver_id','=',$receiver_id)
            ->where('status','=',0)
            ->where('message','!=','')
            ->orderBy('id','asc')
            ->get();

        return $query;

    }

   static function getChat($sender_id) {

     $receiver_id = Auth::user()->id;
       $query =  self::select('chat.*')
            ->where(function($q) use ($receiver_id) {
            $q->where('receiver_id', $receiver_id)
              ->orWhere('sender_id', $receiver_id);
            })->where(function ($q) use ($sender_id) {
                $q->where('receiver_id', $sender_id)
                  ->orWhere('sender_id', $sender_id);
            })
            ->where('message','!=','')
            ->orderBy('id','asc')
            ->get();

        return $query;

    }


    static function getChatApp($receiver_id,$sender_id) {
         $query =  self::select('chat.*')
            ->where(function($q) use ($receiver_id) {
            $q->where('receiver_id', $receiver_id)
              ->orWhere('sender_id', $receiver_id);
            })->where(function ($q) use ($sender_id) {
                $q->where('receiver_id', $sender_id)
                  ->orWhere('sender_id', $sender_id);
            })
            ->where('message','!=','')
            ->orderBy('id','asc')
            ->get();

        return $query;

    }



    static function getChatUser($id) {

		// SELECT `created_at` AS `message_date`, `message_type`, (CASE WHEN `sender_id` = '2' THEN `receiver_id` ELSE `sender_id` END) AS `connect_user_id` FROM `chat` WHERE `id` IN (SELECT MAX(`id`) FROM `chat` WHERE `status` < "2" AND (`sender_id` = 2 OR (`receiver_id` = 2 AND `status` > "-1") ) GROUP BY (CASE WHEN `sender_id` = 2 THEN `receiver_id` ELSE `sender_id` END)) 
		
		$getuserchat = self::select("*",
	     \DB::raw('(CASE WHEN sender_id = "'.$id.'" THEN receiver_id ELSE sender_id END) AS connect_user_id'))    
		 ->whereIn('id', function($query) use($id) { 
		    $query->selectRaw('max(id)')->from('chat')
		    	->where('status', '<', 2)
	    		->where(function ($query)  use($id) {
				   	 $query->where('sender_id', '=', $id)
				   	 ->orWhere(function ($query) use($id) {
						   	 $query->where('receiver_id', '=', $id)
						   	  ->where('status', '>', '-1');
					 });
				 })
		    	->groupBy(\DB::raw('CASE WHEN sender_id = "'.$id.'" THEN receiver_id ELSE sender_id END'));
		})
		->orderBy('id','desc')
	    ->get();
	    // dd($getuserchat);
 		return $getuserchat;




			// LEFT JOIN ( SELECT count(`chat_id`) AS `base_count` , `sender_id` AS `connect_user_id` FROM `chat_message` WHERE `receiver_id` = ? AND `status` = 0 GROUP BY `sender_id` ) AS `bc` ON `cm`.`connect_user_id` = `bc`.`connect_user_id`

			// 'SELECT `ud`.`user_id`, `ud`.`name`, `ud`.`mobile_code`, `ud`.`mobile`,  `ud`.`language`, `ud`.`image`, IFNULL (`cm`.`message`,"") AS `message`,`cm`.`message_date`, IFNULL (`cm`.`message_type`,0) AS `message_type`,  IFNULL (`bc`.`base_count`,0) AS `base_count`, `ud`.`is_private`  FROM  `user_detail` AS `ud` ' +
   //              'INNER JOIN (' +

   //              'SELECT  `created_date` AS `message_date`, `message_type`,  (CASE WHEN `sender_id` = ? THEN `message` ELSE `message_lang` END) AS `message`, `message_lang`, (CASE WHEN `sender_id` = ? THEN `receiver_id` ELSE `sender_id` END) AS `connect_user_id` FROM `chat_message` ' +
   //              'WHERE `chat_id` IN (SELECT MAX(`chat_id`) FROM `chat_message` WHERE `status` < "2" AND (`sender_id` = ? OR (`receiver_id` = ? AND `status` > "-1") ) GROUP BY (CASE WHEN `sender_id` = ? THEN `receiver_id` ELSE `sender_id` END))' +

   //              ') AS `cm` ON `cm`.`connect_user_id` = `ud`.`user_id` ' +
   //              'LEFT JOIN ( SELECT count(`chat_id`) AS `base_count` , `sender_id` AS `connect_user_id` FROM `chat_message` WHERE `receiver_id` = ? AND `status` = 0 GROUP BY `sender_id` ) AS `bc` ON `cm`.`connect_user_id` =  `bc`.`connect_user_id`'
   //              + ' ORDER BY `cm`.`message_date` DESC', [userObj.user_id, userObj.user_id, userObj.user_id, userObj.user_id, userObj.user_id, userObj.user_id],





	 	// $user_id = Auth::user()->id;
 		// ->toSql()
		// $query =  \DB::select('SELECT created_at, message_type, message, (CASE WHEN sender_id = "'.$user_id.'" THEN receiver_id ELSE sender_id END) AS connect_user_id FROM chat  WHERE id IN (SELECT MAX(id) FROM chat WHERE status < "2" AND (sender_id = "'.$user_id.'" OR (receiver_id = "'.$user_id.'" AND status > "-1") ) GROUP BY (CASE WHEN sender_id = "'.$user_id.'" THEN receiver_id ELSE sender_id END))');



    }

}
