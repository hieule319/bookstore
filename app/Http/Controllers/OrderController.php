<?php

namespace App\Http\Controllers;

use App\Models\delivery_address;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;
use App\Models\order_detail;
use App\Models\promotion;
use PDF;

class OrderController extends Controller
{
    public function print_order($order_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($order_code));
        return $pdf->stream();
    }

    public function print_order_convert($order_code)
    {
        $order = order::printOrder($order_code);
        $delivery = delivery_address::getDeliveryOrder($order['deliveryId']);
        $order_detail = order_detail::getListOrderDetail($order['id']);
        $promotion = promotion::getPromotionById($order['promotion_id']);
        if($promotion == null)
        {
            $promotion['promotion_discount'] = null;
        }
        $timestamp = time();
        $timestamp = date("d-m-Y i:H", $timestamp);


        if ($order['payment'] == "cash") {
            $payment = "Tiền mặt";
        }
        if ($order['payment'] == "paypal") {
            $payment = "Paypal";
        }

        $output = '';
        $output .= '
        <style>
            body {
                font-family: DejaVu Sans;
            }
            .table-styling{
                width: 100%;
                border: 1px solid #000;
            }
            .table-styling tr td{
                width: 100%;
                text-align:center;
            }
            .table-styling tr{
                border-top: 1px solid #000;
            }
            p.footer{
                margin-left: 500px;
            }
            i.tk{
                float: right;
            }
        </style>
            <h5>Bookstore <i class="tk">' . $timestamp . '</i></h5>
            <p>-----------------------------------------------------------------------------------------------------------------------------</p>
            <center><h3>Hóa đơn thanh toán</h3></center>
            <p>Họ và tên: <strong>' . $delivery["fullname"] . '</strong></p>
            <p>Địa chỉ  : <strong>' . $delivery["address"] . ', ' . $delivery["city"] . ' ' . $delivery["province"] . '</strong></p>
            <p>Số điện thoại: <strong>0' . $delivery["phone_delivery"] . '</strong></p>
            <p>Mã hóa đơn : ' . $order["order_code"] . '</p>
            <p>-----------------------------------------------------------------------------------------------------------------------------</p>
            <table class="table-styling">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
                </thead>
                <tbody>';
        $stt = 1;
        foreach ($order_detail as $key => $val) {
            $output .= '
                <tr>
                    <td>' . $stt . '</td>
                    <td>' . $val["product_name"] . '</td>
                    <td>' . number_format($val["product_price"], 0, '', ',') . ' đ</td>
                    <td>' . $val["quantity"] . '</td>
                    <td>' . number_format($val["subtotal"], 0, '', ',') . ' đ</td>
                </tr>';
            $stt++;
        }
        $output .= '
                </tbody>
            </table>';
        $output .= '
        <p>-----------------------------------------------------------------------------------------------------------------------------</p>
        <p class="footer">Giảm giá: ' . $promotion['promotion_discount'] . ' %</p>
        <p class="footer">Hình thức: ' . $payment . '</p>
        <p class="footer"><strong>Tổng tiền:</strong> ' . number_format($order['total'], 0, '', ',') . ' đ</p>
        <p>-----------------------------------------------------------------------------------------------------------------------------</p>
        <center style="margin-top:10px;"><p><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http://bookstoreproject.online/qrcode-order/' . $order['order_code'] . '"></p></center>
        ';
        return $output;
    }

    public function createOrder(Request $request)
    {

        $this->validate($request, [
            'payment' => 'required',
            'deliveryId' => 'required',
        ], [
            'payment.required' => 'Chưa chọn hình thức thanh toán',
            'deliveryId.required' => 'Chưa chọn địa chỉ giao hàng',
        ]);
        $params = $request->except('_token');
        if (session()->has('LoggedUser')) {
            $params['user_id'] = session('LoggedUser');
            $params['cart'] = session('cart');
            $params['total'] = session('total');
            $params['promotion_id'] = session('promotion_id');
            $params['status'] = 0;
            $params['address'] = session('result');

            if ($params['payment'] == "cash" || $params['payment'] == "paypal") //tiền mặt
            {
                $query = order::createNewOrder($params);
            }
            if ($query == "success") {
                $request->session()->forget('cart');
                $request->session()->forget('promotion_id');
                $request->session()->forget('total');
                $request->session()->forget('discount');
                return view('thankyou');
            }
        } else {
            return back()->with('fail', 'Giỏ hàng rỗng không thể thanh toán!');
        }
    }

    public function progressOrder($data)
    {
        $order = order::progressOrder($data);
        if (!isset($order)) {
            $not_exists = 'Không tồn tại đơn hàng!';
            return view('user.showProgressOrder')->with(compact('not_exists'));
        }
        $estimate_date = $order['estimate_date'];
        $status = $order['status'];

        $datetime = $order['created_at']->format('Y-m-d H:i:s');
        $time = date('Y-m-d H:i:s', strtotime('+12 hour', strtotime($datetime)));
        $timestamp = time();
        $timestamp = date("Y-m-d H:i:s", $timestamp);
        if (strtotime($time) > strtotime($timestamp)) {
            $cancel = "cancel";
            return view('user.showProgressOrder')->with(compact('estimate_date', 'data', 'status', 'cancel'));
        }

        return view('user.showProgressOrder')->with(compact('estimate_date', 'data', 'status'));
    }

    public function cancelOrder($data)
    {
        $query = order::cancelOrder($data);
        if ($query == "success") {
            return back()->with('success', 'Huỷ đơn thành công !!');
        } else {
            return back()->with('fail', 'Huỷ đơn không thành công !!');
        }
    }

    public function getListOrderByUser()
    {
        $id = session('LoggedUser');
        $profile = User::getProFileById($id);
        $orders = order::getListOrder($id);
        return view('user.orderList')->with(compact('orders', 'profile'));
    }

    public function index()
    {
        $orders = order::getListOrder();
        return view('admin.order.index')->with(compact('orders'));
    }

    public function updateStatusOrder($status, $order_code)
    {
        $query = order::updateStatusOrder($status, $order_code);
        if ($query) {
            return back()->with('success', 'Chuyển đổi trạng thái thành công');
        } else {
            return back()->with('fail', 'Chuyển đổi trạng thái thất bại');
        }
    }

    public function getListOrderDetail(Request $request)
    {
        $order_id = $request->id;
        $order_details = order_detail::getListOrderDetail($order_id);
        return view('admin.order.order_detail')->with(compact('order_details'));
    }

    public function updateEstimateDate(Request $request)
    {
        $params = $request->except('_token');
        if ($params['estimate_date'] == null) {
            return back()->with('fail', 'Cập nhật thất bại');
        }
        $query = order::updateEstimateDate($params);
        if ($query) {
            return back()->with('success', 'Cập nhật thành công');
        } else {
            return back()->with('fail', 'Cập nhật thất bại');
        }
    }

    public static function orderFilter(Request $request)
    {
        $filter = $request->status_order;
        $orders =  order::orderFilter($filter);
        return view('admin.order.index')->with(compact('orders'));
    }

    public function qrCodeOrder($order_code)
    {
        $query = order::qrCodeOrder($order_code);
        if ($query == 1) {
            return view('admin.order.qrCodeOrder')->with(compact('query'));
        }
        if ($query == 2) {
            return view('admin.order.qrCodeOrder')->with(compact('query'));
        }
        if ($query == 3) {
            return view('admin.order.qrCodeOrder')->with(compact('query'));
        }
        if ($query == 4) {
            return view('admin.order.qrCodeOrder')->with(compact('query', 'order_code'));
        }
    }

    public function qrCodeOrderReturn(Request $request)
    {
        $return  = $request->return;
        $order_code = $request->order_code;
        if ($return == 1) {
            $query = order::qrCodeOrder($order_code, $return);
            if ($query == 5) {
                return view('admin.order.qrCodeOrder')->with(compact('query'));
            }
        }
        return back();
    }
}
