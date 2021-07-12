<?php

namespace App\Http\Controllers;

use App\Models\inventory;
use App\Models\order;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index()
    {
        return view('admin.revenue.index');
    }

    public function profit(Request $request)
    {
        $this->validate($request,[
            'start_date' => 'required',
            'end_date' => 'required',
        ],[
            'start_date.required' => 'Chưa nhập ngày bắt đầu',
            'end_date.unique' => 'Chưa nhập ngày kết thúc',
        ]);
        $pay = inventory::getListPayInventory($request->start_date,$request->end_date);
        $revenue = order::getListRevenueOrder($request->start_date,$request->end_date);
        $profit = $revenue - $pay;
        return view('admin.revenue.profit')->with(compact('pay','revenue','profit'));
    }
}
