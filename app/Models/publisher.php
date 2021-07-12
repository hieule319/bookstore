<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publisher extends Model
{
    use HasFactory;
    protected $table = 'publisher';
    protected $fillable = [
        'publisher_name',
        'publisher_address',
        'publisher_phone',
        'publisher_email',
        'publisher_fax',
        'invalid'
    ];

    public static function getListPublisher()
    {
        return self::where(['invalid' => 0])->orderBy('id','desc')->get();
    }

    public static function insertOrUpdatePublisher($data,$id = null)
    {
        if(is_null($id))
        {
            $result = self::create($data);
        }else{
            $result = self::where([
                'id' => $id,
                'invalid' => 0
            ])->update($data);
        }

        return 'success';
    }

    public static function checkExistsPublisher($publisher_name,$publisher_email)
    {
        return self::where([
            'publisher_name' => $publisher_name,
            'publisher_email' => $publisher_email,
            'invalid' => 0
        ])->count();
    }

    public static function deletePublisher($id)
    {
        $result = self::where(['id' => $id,'invalid' => 0])->update(['invalid' => 1]);
        if($result)
        {
            return 'success';
        }
    }
}
