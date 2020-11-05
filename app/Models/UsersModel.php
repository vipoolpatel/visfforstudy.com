<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Cache;
use DateTime;
use DateTimeZone;


class UsersModel extends Model
{
    use Notifiable;
    
    protected $table = 'users';

    public function OnlineUser() {
        return Cache::has('OnlineUser' . $this->id);
    }


    public function getName() {
        $name = '';
        $name .= ucfirst($this->name);
        if(!empty($this->last_name))
        {
            $name .= ' '.ucfirst($this->last_name[0]);      
        }    
        return $name;
    }

    static public function getuser($id) {
        return self::find($id);
    }

    static public function getUsers() {
        return self::get();
    }

     static public function getUsersIndividual($id) {
        return self::where('is_admin','=',$id)->get();
    }

    static public function getUserOnline($is_admin) {
        return self::whereIn('users.id',explode(',', Cache::get('AvailabeOnline')))->where('is_admin','=',$is_admin)->get();
    }

    static public function getTotalEaring() {
        return self::sum('total_amount');
    }
    
    static public function getTotalNetProfit() {
        return self::sum('fee_amount');
    }


    public function PendingClearance()
    {
        $withdraw =  $this->withdrawn + $this->available_for_withdraw;
        $PendingClearance = $this->net_income - $withdraw;
        return $PendingClearance;
    }


    
    public function getProfileLink() {
         return url('student-profile/'.$this->id);
    }
    
    public function getProfileTutorLink() {
        return url('tutor-profile/'.$this->id);
    }

    public function getbooklessonlink() {
        return url('book-lesson/'.$this->id);
    }
    

    static public function getStudent() {
        return self::where('is_admin','=',3)->where('status','=',1)->get();
    }

    public function getImage() {
         if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic)) {
            return url('upload/profile/'.$this->profile_pic);
         }
         else {
            return url('upload/profile/iconprofile.png');
         }
    }


   public function getlevelofstudent() {
   	   return $this->belongsTo(LevelOfStudentModel::class, "level_of_teacher");
   }

   public function getcountry()
   {
      return $this->belongsTo(CountryModel::class, "country_id");
   }

   public function getcategory()
   {
      return $this->belongsTo(CategoryModel::class, "category_id");
   }


    public function get_langauge() {
        return $this->hasMany(UserLanguageModel::class, "user_id");
    }

    public function get_qulification() {
        return $this->hasMany(UserQualificationModel::class, "user_id")->orderBy('id','desc');
    }

    public function get_course() {
        return $this->hasMany(CourseModel::class, "user_id")->where('status','=','2')->orderBy('id','desc');
    }

    public function get_note() {
        return $this->hasMany(UserNoteModel::class, "user_id")->orderBy('id','desc')->limit(5);
    }

    public function get_review() {
        return $this->hasMany(UserReviewModel::class, "user_id")->orderBy('id','desc');
    }

    public function averageRating() {
        $review = $this->get_review()->avg('rating');
        return number_format($review, 1);
    }

    public function totalRating() {
        $review = $this->get_review()->count();
        return $review;
    }

    public function get_review_count($rating_id) {
        return $this->hasMany(UserReviewModel::class, "user_id")->where('rating','=',$rating_id)->count();
    }

    public function get_review_percentage($rating_id) {
        $total = $this->totalRating();
        $rating = $this->get_review_count($rating_id);

        if(!empty($total))
        {
            $percentage = ($rating / $total) * 100;
            return number_format($percentage, 1);    
        }
        else
        {
            return 0;       
        }
    }





    public function getHTMLRating() {
        $rating = $this->averageRating();
        if ($rating >= 1 && $rating < 2) {
            return '<span><i class="fas fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>';
        } else if ($rating >= 2 && $rating < 3) {
            return '<span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>';

        } else if ($rating >= 3 && $rating < 4) {
            return '<span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>';

        } else if ($rating >= 4 && $rating < 5) {
            return '<span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>';

        } else if ($rating >= 5 && $rating < 6) {
            return '<span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>';
        } else {
            return '<span><i class="far fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>';
        }
    }



    static public function timezone() {
        $timezone = '';
        try {
            $ip     = $_SERVER['REMOTE_ADDR'];
            $json   = file_get_contents( 'http://ip-api.com/json/' . $ip);
            $ipData = json_decode( $json, true);
            $timezone = !empty($ipData['timezone']) ? $ipData['timezone'] : ''; 
        }
        catch (\Exception $e) {
           
        }
        return $timezone;

    }

    public function gettimezonedate() {
        if(!empty($this->timezone))
        {
            $timezone = new DateTime("now", new DateTimeZone($this->timezone));
            $date = $timezone->format('Y-m-d h:i A');
        }
        else
        {
            $date = date('Y-m-d h:i A');
        }
        return $date;
    }


}
