<?php

namespace App\Http\Controllers;

use App\Models\banner;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;

class MainController extends Controller
{
    public function index()
    {
        $headerBanner = banner::getHeaderBanner(); 
        $banner = banner::getBanner();
        $categoriesProduct = category::getPrudctByCategory();
        $product_sales = product::getListProductSale();
        $latestProducts = product::getListLatestProduct();
        return view('main')->with(compact('latestProducts','product_sales','categoriesProduct','headerBanner','banner'));
    }
}
