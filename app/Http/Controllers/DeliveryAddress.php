<?php

namespace App\Http\Controllers;

use App\Models\delivery_address;
use App\Models\User;
use Illuminate\Http\Request;

class DeliveryAddress extends Controller
{
    public function deliveryAddress(Request $request)
    {
        $id = session('LoggedUser');
        $profile = User::getProFileById($id);
        $deliveries = delivery_address::getListAddressById($id);
        return view('user.deliverAddress')->with(compact('deliveries', 'profile'));
    }

    public function addDelivery(Request $request)
    {
        $params = $request->except('_token');
        $params['user_id'] = session('LoggedUser');
        $count = delivery_address::countDelivery($params['user_id']);
        if($count >= 5)
        {
            return back()->with('fail','Số lượng địa chỉ đã vượt quá giới hạn!');
        }
        $query = delivery_address::insertOrUpdateDelivery($params);

        if ($query) {
            return back()->with('success', 'Thêm địa chỉ thành công');
        } else {
            return back()->with('fail', 'Đã xảy ra lỗi');
        }
    }

    public function deleteDelivery($id)
    {
        $query = delivery_address::deleteDelivery($id);

        if ($query) {
            return back()->with('success', 'Xóa địa chỉ thành công');
        } else {
            return back()->with('fail', 'Đã xảy ra lỗi');
        }
    }

    public function checkOutDelivery(Request $request)
    {
        $params = $request->except('_token');
        $params['user_id'] = session('LoggedUser');
        
        $count = delivery_address::countDelivery($params['user_id']);
        if($count >= 5)
        {
            return back()->with('fail', 'Số lượng địa chỉ vượt quá giới hạn!');
        }
        $query = delivery_address::insertOrUpdateDelivery($params);
        $result = delivery_address::getDeliveryById($query->id);
        
        if ($result) {
            $request->session()->put('result',$result);
            return back()->with('success','Thêm địa chỉ thành công');
        } else {
            return back()->with('fail', 'Đã xảy ra lỗi');
        }
    }

}
