<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\publisher;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = publisher::getListPublisher();
        return view('admin.publisher.index')->with(compact('publishers'));
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
        $this->validate($request,[
            'publisher_name' => 'required|unique:publisher',
            'publisher_email' => 'unique:publisher',
        ],[
            'publisher_name.required' => 'Tên không được trống',
            'publisher_name.unique' => 'Đã tồn tại',
            'publisher_email.unique' => 'Đã tồn tại',
        ]);

        $params = $request->except('_token');
        $query = publisher::insertOrUpdatePublisher($params);

        if ($query == 'success') {
            return back()->with('success', 'Thêm mới thành công');
        }else{
            return back()->with('fail', 'Đã xảy ra sự cố');
        }
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

    public function getPublisherById($id)
    {
        $publisher = publisher::find($id);
        return response()->json($publisher);
    }

    public function updatePublisher(Request $request)
    {
        $id = intval($request->id);
        $this->validate($request,[
            'publisher_name' => 'required|unique:publisher',
        ],[
            'publisher_name.required' => 'Tên không được trống',
            'publisher_name.unique' => 'Đã tồn tại',
        ]);
        $check_publisher = publisher::checkExistsPublisher($request->publisher_name,$request->publisher_email);
        if($check_publisher > 0)
        {
            return back()->with('fail', 'Tên NXB hoặc email bị trùng'); 
        }

        $params = $request->except('id','_token');
        $query = publisher::insertOrUpdatePublisher($params,$id);

        if ($query == 'success') {
            return back()->with('success', 'Chỉnh sửa thành công');
        }else{
            return back()->with('fail', 'Đã xảy ra sự cố');
        }
    }

    public function deletePublisher($id)
    {
        $publisher = publisher::find($id);
        if(isset($publisher))
        {
            $query = publisher::deletePublisher($id);
            if ($query == 'success') {
                return back()->with('success', 'Xóa thành công');
            }else{
                return back()->with('fail', 'Đã xảy ra sự cố');
            }
        }
    }
}
