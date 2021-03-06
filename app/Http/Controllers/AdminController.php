<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\contact;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.filemanager');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function userStaff()
    {
        $staffs = User::getListUserStaff();
        return view('admin.user.staff')->with(compact('staffs'));
    }

    public function createStaff(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'name' => 'required|unique:user',
            'email' => 'required|unique:user',
            'phone' => 'required',
            'password' => 'required',
        ], [
            'fullname.required' => 'T??n kh??ng ???????c tr???ng',
            'name.required' => 'UserName kh??ng ???????c tr???ng',
            'name.unique' => 'UserName ???? t???n t???i',
            'email.required' => 'email kh??ng ???????c tr???ng',
            'email.unique' => 'email ???? t???n t???i',
            'phone.required' => 'phone kh??ng ???????c tr???ng',
            'password.required' => 'password kh??ng ???????c tr???ng',
        ]);
        $params = $request->except('_token');
        $params['password'] = Hash::make($params['password']);
        $params['permission'] = 1;
        $query = User::insertOrUpdateUser($params);

        if ($query) {
            return back()->with('success', 'Th??m th??nh c??ng');
        }else{
            return back()->with('fail', '???? x???y ra s??? c???');
        }
    }

    public function updateStaff(Request $request)
    {
        if($request->has('image_upload'))
        {
            $file = $request->image_upload;
            $ext  = $request->image_upload->extension();
            $file_name = time().'-'.'user'.'.'.$ext;
            $file->move(public_path('uploads/user'), $file_name);
        }
        if(isset($file_name))
        {
            $request->merge(['avatar' => $file_name]);
        }
        if(isset($request->password) && $request->password != null)
        {
            $params = $request->except('_token','image_upload');
            $params['password'] = Hash::make($request->password);
        }else{
            $params = $request->except('_token','image_upload','password');
        }
        $query = User::insertOrUpdateUser($params);

        if ($query) {
            return back()->with('success', 'C???p nh???t th??nh c??ng');
        }else{
            return back()->with('fail', '???? x???y ra s??? c???');
        }
    }

    public function getUserStaffByID($id)
    {
        $staff = User::find($id);
        return response()->json($staff);
    }

    public function deleteUser(Request $request)
    {
        $id = $request->user_id;
        $query = User::deleteUser($id);

        if ($query) {
            return back()->with('success', 'X??a th??nh c??ng');
        }else{
            return back()->with('fail', '???? x???y ra s??? c???');
        }
    }

    public function userCustomer()
    {
        $customers = User::getListUserCustomer();
        return view('admin.user.customer')->with(compact('customers'));
    }

    public function getListContact()
    {
        $contacts = contact::getListContact();
        return view('admin.contact.index')->with(compact('contacts'));
    }

    public function contactShow($id)
    {
        $contact = contact::find($id);
        return response()->json($contact);
    }

    public function feedbackContact(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
        ], [
            'content.required' => 'N???i dung kh??ng ???????c tr???ng',
        ]);
        $params = $request->except('_token');
        $query = contact::feedbackContact($params);
        if ($query) {
            return back()->with('success', 'G???i th??nh c??ng');
        }else{
            return back()->with('fail', '???? x???y ra s??? c???');
        }
    }

    public function deleteContact(Request $request)
    {
        $id = $request->contact_id;
        $query = contact::deleteContact($id);
        if ($query) {
            return back()->with('success', 'X??a th??nh c??ng');
        }else{
            return back()->with('fail', '???? x???y ra s??? c???');
        }
    }

    public function profileAdmin()
    {
        $id = session('LoggedUser');
        $profile = User::getProFileById($id);
        return view('admin.adminProfile')->with(compact('profile'));
    }

    public function getListBanner()
    {
        $banners = banner::getListBanner();
        return view('admin.banner.index')->with(compact('banners'));
    }

    public function createBanner(Request $request)
    {
        $this->validate($request, [
            'image_upload' => 'required',
        ], [
            'image_upload.required' => 'Ch??a ch???n ???nh b??a',
        ]);
        if($request->has('image_upload'))
        {
            $file = $request->image_upload;
            $ext  = $request->image_upload->extension();
            $file_name = time().'-'.'banner'.'.'.$ext;
            $file->move(public_path('uploads/banner'), $file_name);
        }
        $request->merge(['thumbnail' => $file_name]);
        $params = $request->except('_token');
        if($params['location'] == "Ch???n")
        {
            $params['location'] =  "MAIN SLIDE";
        }
        $query = banner::insertOrUpdateBanner($params);
        if ($query) {
            return back()->with('success', 'Th??m th??nh c??ng');
        }else{
            return back()->with('fail', '???? x???y ra s??? c???');
        }
    }

    public function bannerShow($id)
    {
        $banner = banner::find($id);
        return response()->json($banner);
    }

    public function updateBanner(Request $request)
    {
        if($request->has('image_upload'))
        {
            $file = $request->image_upload;
            $ext  = $request->image_upload->extension();
            $file_name = time().'-'.'banner'.'.'.$ext;
            $file->move(public_path('uploads/banner'), $file_name);
        }
        if(isset($file_name))
        {
            $request->merge(['thumbnail' => $file_name]);
        }
        $params = $request->except('_token','image_upload');
        if($params['location'] == "Ch???n")
        {
            $params['location'] =  "MAIN SLIDE";
        }
        $query = banner::insertOrUpdateBanner($params);
        if ($query) {
            return back()->with('success', 'C???p nh???t th??nh c??ng');
        }else{
            return back()->with('fail', '???? x???y ra s??? c???');
        }
    }

    public function deleteBanner(Request $request)
    {
        $id = $request->banner_id;
        $query = banner::deleteBanner($id);
        if ($query) {
            return back()->with('success', 'X??a th??nh c??ng');
        }else{
            return back()->with('fail', '???? x???y ra s??? c???');
        }
    }
}
