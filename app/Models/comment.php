<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = [
        'user_id',
        'product_id',
        'comment',
        'invalid'
    ];

    public function user()
    {
        return $this->hasMany(user::class, 'user_id', 'id')->where('user.invalid', 0);
    }

    public static function getListComment($product_id)
    {
        return self::select('comment.*','user.name','user.avatar')->join('user','comment.user_id','=','user.id')
        ->where(['comment.product_id' => $product_id,'comment.invalid' => 0])
        ->orderBy('comment.id','desc')->get();
    }

    public static function insertComment($data)
    {
        return self::create($data);
    }
}
