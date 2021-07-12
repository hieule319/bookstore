<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Helper\Util;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\progress_order;
use App\Models\order_detail;
use App\Models\delivery_address;
use App\Models\promotion;
use App\Models\User;
use App\Mail\completed_order;

class order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $fillable = [
        'order_code',
        'user_id',
        'total',
        'status',
        'payment',
        'deliveryId',
        'promotion_id',
        'estimate_date',
        'invalid'
    ];

    public function order_detail()
    {
        return $this->hasMany(order_detail::class, 'order_id', 'id')->where(['order_detail.invalid' => 0]);
    }

    public function delivery_address()
    {
        return $this->hasOne(delivery_address::class, 'id', 'deliveryId')->where(['delivery_address.invalid' => 0]);
    }

    public function promotion()
    {
        return $this->hasOne(promotion::class, 'id', 'promotion_id')->where(['promotion.invalid' => 0]);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->where(['user.invalid' => 0]);
    }

    public static function printOrder($order_code)
    {
        return self::where(['order_code' => $order_code])->first();
    }

    public static function createNewOrder($data)
    {
        DB::beginTransaction();
        try {
            $order_code = Util::generateQrCode();
            $data['order_code'] = $order_code;
            $query = self::create($data);

            for ($i = 0; $i < count($data['cart']); $i++) {
                $detail[$i]['order_id'] = $query->id;
                $detail[$i]['product_name'] = $data['cart'][$i]['product_name'];
                $detail[$i]['product_price'] = $data['cart'][$i]['product_price'];
                $detail[$i]['quantity'] = $data['cart'][$i]['product_quantity'];
                $detail[$i]['subtotal'] = $data['cart'][$i]['product_quantity'] * $data['cart'][$i]['product_price'];
                $query_detail = order_detail::create($detail[$i]);
            }
            
            if ($query && $query_detail) {
                $data_mail = [
                    'order_code' => $order_code,
                    'cart' => $data['cart'],
                    'total' => $data['total'],
                    'address' => $data['address']
                ];
                foreach ($data['address'] as $val) {
                    $email = $val['email'];
                }
                Mail::to($email)->send(new progress_order($data_mail));
            } else {
                throw new Exception('Đã xảy ra lỗi');
            }
            DB::commit();
            return "success";
        } catch (Exception $e) {
            DB::rollBack();
            return "fail";
        }
    }

    public static function progressOrder($order_code)
    {
        return self::where(['order_code' => $order_code, 'invalid' => 0])->first();
    }

    public static function cancelOrder($order_code)
    {
        $order = self::where(['order_code' => $order_code, 'invalid' => 0])->first();
        if (!isset($order)) {
            return "fail";
        }
        $order->order_detail()->update(['invalid' => 1]);
        $order->update(['invalid' => 1]);
        return "success";
    }

    public static function countOrder($user_id)
    {
        return self::where(['user_id' => $user_id, 'invalid' => 0])->count();
    }

    public static function getListOrderByUser($id)
    {
        return self::where(['user_id' => $id, 'invalid' => 0])->get();
    }

    public static function getListOrder()
    {
        return self::where(['invalid' => 0])->orderBy('id', 'desc')->get();
    }

    public static function updateStatusOrder($status, $order_code)
    {
        return self::where(['order_code' => $order_code])->update(['status' => $status]);
    }

    public static function updateEstimateDate($data)
    {
        return self::where(['id' => $data['order_id']])->update(['estimate_date' => $data['estimate_date']]);
    }

    public static function orderFilter($filter)
    {
        return self::where(['status' => $filter, 'invalid' => 0])->orderBy('id', 'desc')->get();
    }

    public static function qrCodeOrder($order_code,$return = null)
    {
        $order = self::where(['order_code' => $order_code, 'invalid' => 0])->first();
        $delivery = delivery_address::getDeliveryOrder($order['deliveryId']);
        if ($order['status'] == 0) {
            $update = $order->update(['status' => 1]);
            return 1;
        }
        if ($order['status'] == 1) {
            $update = $order->update(['status' => 2]);
            return 2;
        }
        if ($order['status'] == 2) {
            $update = $order->update(['status' => 3]);
            return 3;
        }
        if ($order['status'] == 3) {
            $update = $order->update(['status' => 4]);
            $order_detail = order_detail::where(['order_id' => $order['id'], 'invalid' => 0])->get();
            for ($i = 0; $i < count($order_detail); $i++) {
                $product = product::where(['product_name' => $order_detail[$i]['product_name'], 'invalid' => 0])->first();
                $new_qty = $product['product_quantity'] - $order_detail[$i]['quantity'];
                $update_product = $product->update(['product_quantity' => $new_qty]);
            }
            Mail::to($delivery['email'])->send(new completed_order());
            return 4;
        }

        if ($order['status'] == 4 && $return == 1) {
            $update = $order->update(['status' => 5]);
            $order_detail = order_detail::where(['order_id' => $order['id'], 'invalid' => 0])->get();
            for ($i = 0; $i < count($order_detail); $i++) {
                $product = product::where(['product_name' => $order_detail[$i]['product_name'], 'invalid' => 0])->first();
                $new_qty = $product['product_quantity'] + $order_detail[$i]['quantity'];
                $update_product = $product->update(['product_quantity' => $new_qty]);
            }
            return 5;
        }
        return 4;
    }

    public static function getListRevenueOrder($from,$to)
    {
        $total = 0;
        $query = self::where(['invalid' => 0,'status' => 4])->whereBetween('created_at', [$from, $to])->get();
        for($i=0;$i<count($query);$i++)
        {
            $total += $query[$i]['total'];
        }
        return $total;
    }
}
