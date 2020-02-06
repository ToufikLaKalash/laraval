<?php

namespace App;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'firstname', 'lastname', 'bio'
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

    /**
     * Récupère les compétences de l'utilisateur
     */
    public function skills(){
    	return $this->belongsToMany('App\Skill')->withPivot('level');
    }

    public function notSkills($id){
        $ids = DB::table('skill_user')->where('user_id', $id)->pluck('skill_id');
        return Skill::whereNotIn('id', $ids)->get();
    }

    /**
     * Récupère les utilisateurs possédant cette compétence
     */
    public function users(){
    	return $this->belongsToMany('App\User')->withPivot('level');
    }
}
