<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlist';
    protected $fillable = [
        'user_id',
        'product_id',
        'invalid'
    ];

    public static function insertWishlist($data)
    {
        return self::create($data);
    }

    public static function getWishListByUser($user_id,$product_id)
    {
        return self::where(['user_id' => $user_id,'product_id' => $product_id,'invalid' => 0])->first();
    }

    public static function removeWishlist($data)
    {
        return self::where(['user_id' => $data['user_id'],'product_id' => $data['product_id'],'invalid' => 0])->update(['invalid' => 1]);
    }

    public static function getListWishList($user_id)
    {
        return self::select('wishlist.product_id','wishlist.created_at','product.thumbnail','product.slug','product.product_name')->join('product','product.id','=','wishlist.product_id')
        ->where(['wishlist.user_id' => $user_id,'wishlist.invalid' => 0])->get();
    }
}
