<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\contactMail;
use App\Mail\feedBackContact;

class contact extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'content',
        'status',
        'invalid'
    ];

    public static function insertContact($data)
    {
        $query = self::create($data);
        if($query)
        {
            Mail::to($data['email'])->send(new contactMail());
        }
        return $query;
    }

    public static function getListContact()
    {
        return self::where(['invalid' => 0])->orderBy('id','desc')->get();
    }

    public static function feedbackContact($data)
    {
        $query = self::where(['id' => $data['id'],'invalid' => 0])->update(['status' => 1]);
        if($query)
        {
            Mail::to($data['email'])->send(new feedBackContact($data['content']));
        }
        return $query;
    }

    public static function deleteContact($id)
    {
        $query = self::where(['id' => $id,'invalid' => 0])->update(['invalid' => 1]);
    }
}
