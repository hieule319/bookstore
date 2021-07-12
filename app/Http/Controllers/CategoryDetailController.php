<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category_detail;
use App\Models\category;
use Validator;

class CategoryDetailController extends Controller
{
    public function index()
    {
        $categories = category::getListCategory();
        $category_details = category_detail::getListCategoryDetail();
        return view('admin.category.category_detail')->with(compact('categories','category_details'));
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'category_detail_name' => 'required|unique:category_detail',
            'category_id' => 'required'
        ],[
            'category_detail_name.required' => 'Tên không được trống',
            'category_detail_name.unique' => 'Đã tồn tại',
            'category_id.required' => 'Chưa chọn danh mục',
        ]);
        $params = $request->except('_token');
        $query = category_detail::insertOrUpdateCategoryDetail($params);

        if ($query == 'success') {
            return back()->with('success', 'Thêm mới thành công');
        }else{
            return back()->with('fail', 'Đã xảy ra sự cố');
        }
    }

    public function getCategoryDetailById($id)
    {
        $category_detail = category_detail::find($id);
        $category = category::find($category_detail['category_id']);
        $res = [
            'id' => $category_detail['id'],
            'category_detail_name' => $category_detail['category_detail_name'],
            'category_name' => $category['category_name'],
            'slug' => $category_detail['slug']
        ];
        return response()->json($res);
    }

    public function update(Request $request)
    {
        $id = intval($request->id);
        $this->validate($request,[
            'category_detail_name' => 'required|unique:category_detail',
        ],[
            'category_detail_name.required' => 'Tên không được trống',
            'category_detail_name.unique' => 'Đã tồn tại',
        ]);
        if(intval($request->category_id) == 0)
        {
            $params = [
                'category_detail_name' => $request->category_detail_name,
                'slug' => $request->slug,
            ];
        }else{
            $params = [
                'category_detail_name' => $request->category_detail_name,
                'category_id' => $request->category_id,
                'slug' => $request->slug,
            ];
        }
        $query = category_detail::insertOrUpdateCategoryDetail($params,$id);

        if ($query == 'success') {
            return back()->with('success', 'Chỉnh sửa thành công');
        }else{
            return back()->with('fail', 'Đã xảy ra sự cố');
        }
    }

    public function destroy($id)
    {
        $category_detail = category_detail::find($id);
        if(isset($category_detail))
        {
            $query = category_detail::deleteCategoryDetail($id);
            if ($query == 'success') {
                return back()->with('success', 'Xóa thể loại thành công');
            }else{
                return back()->with('fail', 'Đã xảy ra sự cố');
            }
        }
    }
}
