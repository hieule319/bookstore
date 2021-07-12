@extends('index')
@section('main')
<main id="main">
    <div class="container">

        <!--MAIN SLIDE-->
        <div class="wrap-main-slide">
            <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
                @foreach($headerBanner as $header_banner)
                <div class="item-slide">
                    <img src="{{asset('public/uploads/banner/'.$header_banner->thumbnail)}}" alt="" class="img-slide">
                    <div class="slide-info slide-1">
                        <a href="{{$header_banner->link}}" class="btn-link">Mua ngay</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!--BANNER-->
        <div class="wrap-banner style-twin-default">
            @foreach($banner as $bannerVal)
            <div class="banner-item">
                <a href="{{$bannerVal->link}}" class="link-banner banner-effect-1">
                    <figure><img src="{{asset('public/uploads/banner/'.$bannerVal->thumbnail)}}" alt="" width="580" height="190"></figure>
                </a>
            </div>
            @endforeach
        </div>

        <!--On Sale-->
        <div class="wrap-show-advance-info-box style-1 has-countdown">
            <h3 class="title-box">On Sale</h3>
            <div class="wrap-countdown mercado-countdown" data-expire="2020/12/12 12:34:56"></div>
            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                @foreach($product_sales as $product_sale)
                <div class="product product-style-2 equal-elem ">
                    <div class="product-thumnail">
                        <a href="{{ route('productDetail.product',['slug' => $product_sale->slug]) }}" title="">
                            <figure><img src="{{asset('public/uploads/'.$product_sale->thumbnail)}}" width="800" height="800" alt=""></figure>
                        </a>
                        <div class="group-flash">
                            <span class="flash-item sale-label">Giảm giá</span>
                        </div>
                        <div class="wrap-btn">
                            <a href="{{ route('productDetail.product',['slug' => $product_sale->slug]) }}" class="function-link">Xem nhanh</a>
                        </div>
                    </div>
                    <div class="product-info">
                        <a href="{{ route('productDetail.product',['slug' => $product_sale->slug]) }}" class="product-name"><span>{{$product_sale->product_name}}</span></a>
                        <?php if($product_sale->product_sale != null) {?>
                            <div class="wrap-price"><span class="product-price" style="text-decoration-line:line-through; color:red;">{{number_format($product_sale->product_sell, 0, '', ',')}} đ</span></div>
                            <div class="wrap-price"><span class="product-price">{{number_format($product_sale->product_sale, 0, '', ',')}} đ</span></div>
                        <?php } else {?>
                        <div class="wrap-price"><span class="product-price">{{number_format($product_sale->product_sell, 0, '', ',')}} đ</span></div>
                        <?php } ?>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!--Latest Products-->
        <div class="wrap-show-advance-info-box style-1">
            <h3 class="title-box">Sản Phẩm Mới Nhất</h3>
            <div class="wrap-top-banner">
                <a href="#" class="link-banner banner-effect-2">
                    <figure><img src="{{ asset('public/uploads/banner/190943560_1150767682064464_7265558323767909579_n.jpg') }}" width="1170" height="200" alt=""></figure>
                </a>
            </div>
            <div class="wrap-products">
                <div class="wrap-product-tab tab-style-1">
                    <div class="tab-contents">
                        <div class="tab-content-item active" id="digital_1a">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                                @foreach($latestProducts as $latest)
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{ route('productDetail.product',['slug' => $latest->slug]) }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                            <figure><img src="{{ asset('public/uploads/'.$latest->thumbnail) }}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item new-label">Mới</span>
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="{{ route('productDetail.product',['slug' => $latest->slug]) }}" class="function-link">Xem nhanh</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('productDetail.product',['slug' => $latest->slug]) }}" class="product-name"><span>{{$latest->product_name}}</span></a>
                                        <?php if ($latest->product_sale != null) { ?>
                                            <div class="wrap-price"><span class="product-price" style="text-decoration-line:line-through; color:red;">{{number_format($latest->product_sell, 0, '', ',')}} đ</span></div>
                                            <div class="wrap-price"><span class="product-price">{{number_format($latest->product_sale, 0, '', ',')}} đ</span></div>
                                        <?php } else { ?>
                                            <div class="wrap-price"><span class="product-price">{{number_format($latest->product_sell, 0, '', ',')}} đ</span></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Product Categories-->
        <div class="wrap-show-advance-info-box style-1">
            <h3 class="title-box">Danh Mục Sản Phẩm</h3>
            <div class="wrap-top-banner">
                <a href="#" class="link-banner banner-effect-2">
                    <figure><img src="{{asset('public/uploads/banner/191748861_821843905121695_5220076737385652595_n.jpg')}}" width="1170" height="240" alt=""></figure>
                </a>
            </div>
            <div class="wrap-products">
                <div class="wrap-product-tab tab-style-1">
                    <div class="tab-control">
                    <?php $active = 'active'; ?>
                    @foreach($categories as $category)
                        <a href="#fashion_1a{{$category->id}}" class="tab-control-item {{$active}}">{{$category->category_name}}</a>
                        <?php $active = ''; ?>
                    @endforeach
                    </div>
                    <div class="tab-contents">
                    <?php $active = 'active'; ?>
                    @foreach($categoriesProduct as $product)       
                        <div class="tab-content-item {{$active}}" id="fashion_1a{{$product->id}}">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                                @foreach($product->product as $pro)
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{ route('productDetail.product',['slug' => $pro->slug]) }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                            <figure><img src="{{asset('public/uploads/'.$pro->thumbnail)}}" width="800" height="800" alt=""></figure>
                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item new-label">Mới</span>
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="{{ route('productDetail.product',['slug' => $pro->slug]) }}" class="function-link">Xem nhanh</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('productDetail.product',['slug' => $pro->slug]) }}" class="product-name"><span>{{$pro->product_name}}</span></a>
                                        <?php if ($pro->product_sale != null) { ?>
                                            <div class="wrap-price"><span class="product-price" style="text-decoration-line:line-through; color:red;">{{number_format($pro->product_sell, 0, '', ',')}} đ</span></div>
                                            <div class="wrap-price"><span class="product-price">{{number_format($pro->product_sale, 0, '', ',')}} đ</span></div>
                                        <?php } else { ?>
                                            <div class="wrap-price"><span class="product-price">{{number_format($pro->product_sell, 0, '', ',')}} đ</span></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                @endforeach                
                            </div>
                        </div>
                        <?php $active = ''; ?>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

</main>
@endsection