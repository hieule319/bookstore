<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_detail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $fillable = [
        'order_id',
        'product_name',
        'product_price',
        'quantity',
        'subtotal',
        'invalid'
    ];
    

    public static function createOrderDetail($data)
    {
        return self::create($data);
    }    

    public static function getListOrderDetail($order_id)
    {
        return self::where(['order_id' => $order_id,'invalid' => 0])->get();
    }
}
