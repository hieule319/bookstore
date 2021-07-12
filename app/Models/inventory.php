<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Imports\importProduct;
use Excel;


class inventory extends Model
{
    use HasFactory;
    protected $table = 'inventory';
    protected $fillable = [
        'product_name',
        'product_qrcode',
        'product_price',
        'product_quantity',
        'total_price',
        'invalid'
    ];

    public static function getListInventory()
    {
        return self::where(['invalid' => 0])->orderBy('id','desc')->get();
    }

    public static function getListPayInventory($from,$to)
    {
        $total = 0;
        $query = self::where(['invalid' => 0])->whereBetween('created_at', [$from, $to])->get();
        for($i=0;$i<count($query);$i++)
        {
            $total += $query[$i]['total_price'];
        }
        return $total;
    }
}
