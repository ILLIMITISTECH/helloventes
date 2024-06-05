<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cache;

class User extends Authenticatable
{
    use Notifiable;
    
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [  
        'prenom','nom','email','password','nom_role', 'role_id','photo'
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
        "last_online_at" => "datetime",
        
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }
    
    public function agents(){
        return $this->hasMany(Agent::class);  
    }
    
    public function isOnline(){
        return Cache::has('users-is-online-' . $this->id);
    }
}
