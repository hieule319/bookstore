<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use App\Models\publisher;
use Illuminate\Http\Request;
use App\Exports\exportProduct;
use App\Imports\inventoryProduct;
use App\Exports\exportListProduct;
use App\Imports\importNewProduct;
use Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::getListProduct();
        return view('admin.product.index')->with(compact('products'));
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
        $params = $request->except('_token');
        if (isset($request->id)) {
            $query = product::insertOrUpdateProduct($params, $request->id);
            if ($query == 'success') {
                return redirect()->to('product')->with('success', 'Cập nhật thành công');
            } else {
                return redirect()->to('product')->with('fail', 'Đã xảy ra sự cố');
            }
        } else {
            $this->validate($request, [
                'product_name' => 'required|unique:product',
                'slug' => 'required',
                'product_price' => 'required|numeric|not_in:0',
                'product_sell' => 'required|numeric|not_in:0',
                'product_quantity' => 'required|numeric|not_in:0',
                'product_unit' => 'required',
                'category_id' => 'required',
            ], [
                'product_name.required' => 'Tên sản phẩm không được trống',
                'product_name.unique' => 'Đã tồn tại sản phẩm',
                'slug.required' => 'Slug sản phẩm không được trống',
                'product_price.required' => 'Giá gốc sản phẩm không được trống',
                'product_price.not_in' => 'Số lượng sản phẩm không được bằng 0',
                'product_sell.required' => 'Giá bán sản phẩm không được trống',
                'product_sell.not_in' => 'Số lượng sản phẩm không được bằng 0',
                'product_quantity.required' => 'Số lượng sản phẩm không được trống',
                'product_quantity.not_in' => 'Số lượng sản phẩm không được bằng 0',
                'product_unit.required' => 'ĐVT sản phẩm không được trống',
                'category_id.required' => 'Danh mục sản phẩm không được trống',
            ]);
            if(isset($params['category_detail_id']))
            {
                $params['category_detail_id'] = null;
            }
            $query = product::insertOrUpdateProduct($params);
            if ($query == 'success') {
                return redirect()->to('product')->with('success', 'Thêm mới thành công');
            } else {
                return redirect()->to('product')->with('fail', 'Đã xảy ra sự cố');
            }
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

    public function createProduct(Request $request)
    {
        $categories = category::v2_getListCategory();
        $publishers = publisher::getListPublisher();
        return view('admin.product.createProduct')->with(compact('categories', 'publishers'));
    }

    public function updateProduct(Request $request)
    {
        $products = product::getProductById($request->id);
        $categories = category::v2_getListCategory();
        $publishers = publisher::getListPublisher();
        return view('admin.product.updateProduct')->with(compact('products', 'categories', 'publishers'));
    }

    public function updateStatusProduct($id, $status)
    {
        $param['status'] = $status;
        $query = product::insertOrUpdateProduct($param, $id);

        if ($query == 'success') {
            return back();
        }
    }

    public function deleteProduct(Request $request)
    {
        $query = product::deleteProduct($request->product_id);

        if ($query == 'success') {
            return back()->with('success', 'Xóa thành công');
        }
    }

    public function searchProduct(Request $request)
    {
        $data = $request->all();
        if($data['query'])
        {
            $product = product::searchProduct($data);
            $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
            foreach($product as $key => $val)
            {
                $output.='
                    <li><a href="'.$val->slug.'">'. $val->product_name .'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function search(Request $request)
    {
        $data = $request->all();
        if(isset($data['search']))
        { 
            $data['query'] = $data['search'];
            $products = product::searchProduct($data);
            if($products == '[]')
            {
                return back();
            }
            $product_new = product::getNewProduct();
            $publishers = publisher::getListPublisher();
            return view('shop')->with(compact('publishers','products','product_new'));
        }else{
            return back();
        }
    }

    public function createProductCode()
    {
        $query = product::createProductCode();

        if ($query == "success") {
            return back()->with('success', 'Tạo mã thành công');
        }else{
            return back()->with('fail', 'Đã xảy ra lỗi');
        }
    }

    public function exportProductCSV()
    {
        return Excel::download(new exportProduct , 'product.xlsx');
    }

    public function exportProductV2CSV()
    {
        return Excel::download(new exportListProduct , 'list-product.xlsx');
    }

    public function importProductCSV(Request $request)
    {
        $path = $request->file('file_excel');
        $query = Excel::import(new inventoryProduct, $path);
        return back()->with('success', 'Nhập kho thành công');
    }

    public function importnewProductCSV(Request $request)
    {
        $path = $request->file('excel_product');
        $query = Excel::import(new importNewProduct, $path);
        return back()->with('success', 'Nhập kho thành công');
    }
}
