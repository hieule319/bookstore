<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    use HasFactory;
    protected $table = 'banner';
    protected $fillable = [
        'thumbnail',
        'link',
        'location',
        'invalid'
    ];

    public static function getListBanner()
    {
        return self::where(['invalid' => 0])->orderBy('id','desc')->get();
    }

    public static function insertOrUpdateBanner($data)
    {
        if(isset($data['id']))
        {
            return self::where(['id' => $data['id']])->update($data);
        }
        return self::create($data);
    }

    public static function deleteBanner($id)
    {
        return self::where(['id' => $id])->update(['invalid' => 1]);
    }

    public static function getHeaderBanner()
    {
        return self::where(['invalid' => 0,'location' => "MAIN SLIDE"])->orderBy('id','desc')->limit(3)->get();
    }

    public static function getBanner()
    {
        return self::where(['invalid' => 0,'location' => "Banner"])->orderBy('id','desc')->limit(2)->get();
    }
}
