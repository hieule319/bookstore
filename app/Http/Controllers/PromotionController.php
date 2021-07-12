<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\promotion;
use App\Models\User;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = promotion::getListPromotion();
        return view('admin.promotion.index')->with(compact('promotions'));
    }

    public function createPromotion(Request $request)
    {
        $this->validate($request,[
            'promotion_name' => 'required|unique:promotion',
            'promotion_code' => 'required|unique:promotion',
            'promotion_discount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ],[
            'promotion_name.required' => 'Tên không được trống',
            'promotion_name.unique' => 'Đã tồn tại',
            'promotion_code.required' => 'Mã không được trống',
            'promotion_code.unique' => 'Đã tồn tại',
            'promotion_discount.required' => 'Phải nhập chiết khấu',
            'start_date.required' => 'Phải nhập ngày bắt đầu',
            'end_date.required' => 'Phải nhập ngày kết thúc',
        ]);
        $params = $request->except('_token');
        if($params['condition'] == null)
        {
            $params['condition'] = 0;
        }
        $query = promotion::insertOrUpdatePromotion($params);
        if($query)
        {
            return back()->with('success','Thêm mới thành công');
        }else
        {
            return back()->with('fail','Đã xảy ra lỗi');
        }
    }

    public function getPromotionById($id)
    {
        $promotion = promotion::find($id);
        return response()->json($promotion);
    }

    public function updatePromotion(Request $request)
    {
        $this->validate($request,[
            'promotion_name' => 'required',
            'promotion_code' => 'required',
            'promotion_discount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ],[
            'promotion_name.required' => 'Tên không được trống',
            'promotion_code.required' => 'Mã không được trống',
            'promotion_discount.required' => 'Phải nhập chiết khấu',
            'start_date.required' => 'Phải nhập ngày bắt đầu',
            'end_date.required' => 'Phải nhập ngày kết thúc',
        ]);
        $params = $request->except('_token');
        if($params['condition'] == null)
        {
            $params['condition'] = 0;
        }
        $query = promotion::insertOrUpdatePromotion($params,$params['id']);
        if($query)
        {
            return back()->with('success','Cập nhật thành công');
        }else
        {
            return back()->with('fail','Đã xảy ra lỗi');
        }
    }

    public function deletePromotion(Request $request)
    {
        $id = $request->promotion_id;
        $query = promotion::deletePromotion($id);
        if($query)
        {
            return back()->with('success','Xóa thành công');
        }else
        {
            return back()->with('fail','Đã xảy ra lỗi');
        }
    }

    public function showPromotion()
    {
        $user_id = session('LoggedUser');
        $profile = User::getProFileById($user_id);
        $count_order = order::countOrder($user_id);
        $promotions = promotion::getListPromotion();
        $timestamp = time();
        $timestamp = date("Y-m-d", $timestamp);
        foreach ($promotions as $promo)
        {
            if(strtotime($promo['end_date']) > strtotime($timestamp))
            {
                $promotion[] = $promo;
            }
        }
        $voucher = [];
        for($i=0;$i<count($promotion);$i++)
        {
            if($promotion[$i]['condition'] <= $count_order)
            {
                $voucher[$i] = $promotion[$i];
            }
        }
        return view('user.voucher')->with(compact('voucher','profile'));
    }
}
