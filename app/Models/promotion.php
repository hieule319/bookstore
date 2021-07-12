<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotion extends Model
{
    use HasFactory;
    protected $table = 'promotion';
    protected $fillable = [
        'promotion_name',
        'promotion_code',
        'promotion_discount',
        'condition',
        'start_date',
        'end_date',
        'invalid'
    ];

    public static function searchPromotion($promotion_code)
    {
        $timestamp = time();
        $timestamp = date("Y-m-d", $timestamp);
        $query =  self::where(['promotion_code' => $promotion_code, 'invalid' => 0])->first();
        if(strtotime($timestamp) > strtotime($query['end_date']))
        {
            return null;
        }
        return $query;
    }

    public static function getListPromotion()
    {
        return self::where(['invalid' => 0])->orderBy('id','desc')->get();
    }

    public static function insertOrUpdatePromotion($data, $id = null)
    {
        if($id != null)
        {
            return self::where(['id' => $id,'invalid' => 0])->update($data);
        }
        return self::create($data);
    }

    public static function deletePromotion($id)
    {
        return self::where(['id' => $id,'invalid' => 0])->update(['invalid' => 1]);
    }

    public static function getPromotionById($id)
    {
        return self::where(['id' => $id,'invalid' => 0])->first();
    }
}
