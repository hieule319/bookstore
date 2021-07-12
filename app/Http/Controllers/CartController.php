<?php

namespace App\Http\Controllers;

use App\Models\promotion;
use Illuminate\Support\Facades\Session;
use App\Models\category;
use App\Models\delivery_address;
use App\Models\product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function addCartAjax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = session('cart');
        if (isset($cart)) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = [
                    'session_id' => $session_id,
                    'product_id' => $data['cart_product_id'],
                    'product_name' => $data['cart_product_name'],
                    'product_thumbnail' => $data['cart_product_thumbnail'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_price' => $data['cart_product_price'],
                ];
                $request->session()->put('cart', $cart);
            }
        } else {
            $cart[] = [
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_thumbnail' => $data['cart_product_thumbnail'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_price' => $data['cart_product_price'],
            ];
        }
        $request->session()->put('cart', $cart);
        $request->session()->save();
    }

    public function showCart(Request $request)
    {
        $latestProducts = product::getListLatestProduct();
        if (session()->has('cart')) {
            return view('cart')->with(compact('latestProducts'));
        } else {
            $cart = [];
            $request->session()->put('cart', $cart);
            return view('cart')->with(compact('latestProducts'));
        }
    }

    public function updateCart(Request $request)
    {
        $data = $request->all();
        $cart = session('cart');
        $total = 0;
        if (isset($cart)) {
            for ($i = 0; $i < count($cart); $i++) {
                if ($cart[$i]['product_id'] == $data['product_id']) {
                    $cart[$i]['product_quantity'] = $data['quantity'];
                    $product_price = $cart[$i]['product_price'] * $data['quantity'];
                }
                $total += $cart[$i]['product_price'] * $cart[$i]['product_quantity'];
            }
            $request->session()->put('cart', $cart);
        }
        $format_total =  number_format($total, 0, '', ',');
        $format_subtotal = number_format($product_price, 0, '', ',');
        $datas = [
            'subtotal' => $format_subtotal,
            'total' => $format_total
        ];
        return json_encode($datas);
    }

    public function deleteCart(Request $request)
    {
        $data = $request->all();
        $cart = session('cart');
        $total = 0;
        if (isset($data['clearcart']) && $data['clearcart'] == "clearAll") {
            $request->session()->forget('cart');
            return "clear";
        }
        if (count($cart) > 1) {
            foreach ($cart as $key => $val) {
                if ($val['product_id'] != $data['product_id']) {
                    $update_cart[] = $val;
                    $subtotal = $val['product_price'] * $val['product_quantity'];
                    $total += $subtotal;
                }
            }
            $format_total =  number_format($total, 0, '', ',');
            $request->session()->put('cart', $update_cart);
            return $format_total;
        } else {
            $request->session()->forget('cart');
            return "clear";
        }
    }

    public function promoCart(Request $request)
    {
        $data = $request->all();
        $cart = session('cart');
        $promotion = promotion::searchPromotion($data['promoCode']);
        if (!isset($promotion)) {
            return "not_found";
        }
        $discount = $promotion['promotion_discount'] / 100;
        $total = 0;
        if ($cart != null) {
            foreach ($cart as $key => $val) {
                $subtotal = $val['product_price'] * $val['product_quantity'];
                $total += $subtotal;
            }
            $total = $total - ($total * $discount);
            $format_total =  number_format($total, 0, '', ',');
        }
        $request->session()->put('discount', $discount);
        $request->session()->put('promotion_id',$promotion['id']);
        return $format_total;
    }

    public function checkOut(Request $request)
    {
        $total  = 0;
        if (session()->has('cart')) {
            $cart = session('cart');
            foreach ($cart as $key => $val) {
                $subtotal = $val['product_price'] * $val['product_quantity'];
                $total += $subtotal;
            }
        }
        if (session()->has('discount')) {
            $discount = session('discount');
            $total = $total - ($total * $discount);
        }
        $total = $total + 30000;//phí ship
        $request->session()->put('total', $total);
        $id = session('LoggedUser');
        $deliveries = delivery_address::getListAddressById($id);
        $latestProducts = product::getListLatestProduct();
        return view('checkout')->with(compact('deliveries','latestProducts'));
    }

    public function chooseDelivery(Request $request)
    {
        $delivery_id = $request->delivery_id;
        $result = delivery_address::getDeliveryById($delivery_id);
        $request->session()->put('result',$result);

        return back()->with('success','Chọn thành công');
    }
}
