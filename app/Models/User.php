<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user';
    protected $fillable = [
        'name',
        'email',
        'password',
        'permission',
        'google_id',
        'avatar',
        'avatar_original',
        'provider',
        'provider_id',
        'fullname',
        'country',
        'birthday',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function insertOrUpdateUser($data)
    {
        if(isset($data['id']))
        {
            return self::where([
                'id' => $data['id'],
                'invalid' => 0
            ])->update($data);
        }
        return self::create($data);
    }
    
    public static function checkLogin($data)
    {
        if(isset($data['email']))
        {
            return  self::where([
                'email' => $data['email'],
                'invalid' => 0
            ])->first();
        }

        if(isset($data['id']))
        {
            return  self::where([
                'id' => $data['id'],
                'invalid' => 0
            ])->first();
        }else{
            return  self::where([
                'name' => $data['username'],
                'invalid' => 0
            ])->first();
        }
    }

    public static function getProFileById($id)
    {
        return self::where(['id' => $id, 'invalid' => 0])->get();
    }
    public static function getEmailById($id)
    {
        return self::where(['id' => $id, 'invalid' => 0])->first();
    }

    public static function getListUserStaff()
    {
        return self::where(['permission' => 1, 'invalid' => 0])->get();
    }

    public static function deleteUser($id)
    {
        return self::where([
            'id' => $id,
            'invalid' => 0
        ])->update(['invalid' => 1]);
    }

    public static function getListUserCustomer()
    {
        return self::where(['permission' => 2, 'invalid' => 0])->get();
    }
}
