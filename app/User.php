<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;

class User extends Authenticatable
{
    use Notifiable;

    public function OnlineUser() {
        return Cache::has('OnlineUser' . $this->id);
    }

    public function getImage() {
         if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic)) {
            return url('upload/profile/'.$this->profile_pic);
         }
         else {
            return url('upload/profile/iconprofile.png');
         }
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


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
