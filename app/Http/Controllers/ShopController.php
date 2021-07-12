<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\category_detail;
use App\Models\comment;
use App\Models\contact;
use App\Models\publisher;
use App\Models\product;
use App\Models\User;
use App\Models\wishlist;

class ShopController extends Controller
{
    public function index()
    {
        $product_new = product::getNewProduct();
        $publishers = publisher::getListPublisher();
        $products = product::getAllProduct();
        return view('shop')->with(compact('publishers','products','product_new'));
    }

    public function categoryProduct($slug)
    {
        $categoryProduct = category::getListProductBySlug($slug);
        $publishers = publisher::getListPublisher();
        $product_new = product::getNewProduct();
        return view('categoryShop')->with(compact('categoryProduct','publishers','product_new'));
    }

    public function subCategoryProduct($slug)
    {
        $subCategoryProduct = category_detail::getListProductBySlug($slug);
        $publishers = publisher::getListPublisher();
        $product_new = product::getNewProduct();
        return view('subCategoryShop')->with(compact('subCategoryProduct','publishers','product_new'));
    }

    public function productDetail($slug)
    {
        $productDetail = product::getProductBySlug($slug);
        $product_new = product::getNewProduct();
        foreach($productDetail as $product)
        {
            $product_id = $product['id'];
            $subCategory_id = $product['category_detail_id'];
        }
        $similar_product = null;
        if(isset($subCategory_id))
        {
            $similar_product = product::getListSimilarProduct($subCategory_id);
        }
        $comments = comment::getListComment($product_id);
        if(session()->has('LoggedUser'))
        {
            $user_id = session('LoggedUser');
            $wishlist = wishlist::getWishListByUser($user_id,$product_id);
            if($wishlist != '[]')
            {
                return view('productDetail')->with(compact('productDetail','comments','wishlist','similar_product','product_new'));
            }
        }
        return view('productDetail')->with(compact('productDetail','comments','similar_product','product_new'));
    }

    //contact
    public function contact()
    {
        return view('contact');
    }

    public function insertContact(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'content' => 'required',
        ], [
            'fullname.required' => 'Họ tên không được trống',
            'email.required' => 'Email không được trống',
            'phone.required' => 'Số điện thoại không được trống',
            'content.required' => 'Chưa để lại lời nhắn',
        ]);
        $params = $request->except('_token');
        $query = contact::insertContact($params);
        if($query)
        {
            return back()->with('success','Gửi thành công');
        }else
        {
            return back()->with('fail','Đã xảy ra lỗi');
        }
    }
}
