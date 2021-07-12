<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery_address extends Model
{
    use HasFactory;

    protected $table = 'delivery_address';
    protected $fillable = [
        'fullname',
        'email',
        'user_id',
        'address',
        'city',
        'province',
        'phone_delivery',
        'invalid'
    ];

    public static function getListAddressById($id)
    {
        return self::where(['user_id' => $id,'invalid' => 0])->orderBy('id','asc')->get();
    }

    public static function insertOrUpdateDelivery($data)
    {
        if(isset($data['id']))
        {
            return self::where(['id' => $data['id'],'invalid' => 0])->update($data);
        }
        return self::create($data);
    }

    public static function deleteDelivery($id)
    {
        return self::where(['id' => $id,'invalid' => 0])->update(['invalid' => 1]);
    }

    public static function getDeliveryById($id)
    {
        return self::where(['id' => $id,'invalid' => 0])->get();
    }

    public static function countDelivery($user_id)
    {
        return self::where(['user_id' => $user_id,'invalid' => 0])->count();
    }

    public static function getDeliveryOrder($id)
    {
        return self::where(['id' => $id,'invalid' => 0])->first();
    }
}
