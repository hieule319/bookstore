@extends('index')
@section('main')
<!--main area-->
<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">Trang chủ</a></li>
                <li class="item-link"><span>Giỏ hàng</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <form id="result" action="#" method="GET">
                @csrf
                <?php if (session('cart') != null) { ?>
                    <div class="wrap-iten-in-cart cartpage">
                        <h3 class="box-title">Danh Sách Sản Phẩm</h3>
                        <ul class="products-cart danger">
                            @php
                            $total = 0;
                            @endphp
                            @foreach(session('cart') as $key => $cart)
                            @php
                            $subtotal = $cart['product_quantity'] * $cart['product_price'];
                            $total +=$subtotal;
                            @endphp
                            <input type="hidden" class="product_id" value="{{$cart['product_id']}}" />
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{ asset('public/uploads/'.$cart['product_thumbnail']) }}" alt=""></figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product" href="#">{{$cart['product_name']}}</a>
                                    <input type="hidden" name="product_name" value="{{$cart['product_name']}}" />
                                </div>
                                <div class="price-field produtc-price">
                                    <p class="price">{{ number_format($cart['product_price'], 0, '', ',') }}đ</p>
                                    <input type="hidden" class="product_price_{{$cart['product_id']}}" value="{{$cart['product_price']}}" />
                                </div>
                                <div class="quantity">
                                    <div class="quantity-input">
                                        <input type="text" class="qty-input_{{$cart['product_id']}}" name="product-quatity" value="{{ $cart['product_quantity'] }}" data-max="120" pattern="[0-9]*">
                                        <a class="btn btn-increase qtyPlus" data-product_id="{{ $cart['product_id'] }}" href="#"></a>
                                        <a class="btn btn-reduce qtyMinus" data-product_id="{{ $cart['product_id'] }}" href="#"></a>
                                    </div>
                                </div>
                                <div class="price-field sub-total_{{$cart['product_id']}}">
                                    <p class="price">{{ number_format($subtotal, 0, '', ',') }}đ</p>
                                    <input type="hidden" class="subtotal_{{$cart['product_id']}}" name="subtotal" value="{{$subtotal}}" />
                                </div>
                                <div class="delete">
                                    <a href="#" class="btn btn-delete deleteCart" data-deletecart="{{$cart['product_id']}}" title="">
                                        <span>Xóa hàng</span>
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="summary">
                        <div class="order-summary">
                            <h4 class="title-box">Đơn Hàng</h4>
                            <p class="summary-info"><span class="title">Tạm tính</span><b class="index" id="total_price">{{ number_format($total, 0, '', ',') }}đ</b></p>
                            <p class="summary-info"><span class="title">Phí ship</span><b class="index">30,000 tiền ship</b></p>
                            <p class="summary-info total-info "><span class="title">Tổng tiền</span><b class="index total_price">{{ number_format($total, 0, '', ',') }}đ</b></p>
                            <input type="hidden" class="total" name="total" value="{{$total}}" />
                        </div><br>
                        <div class="checkout-info">
                            <label class="checkbox-field">
                                <input type="text" class="form-control" name="promoCode" id="promoCode" placeholder="Mã giảm giá"><br>
                                <button type="button" class="form-control btn btn-checkout" id="applyPromoCode">Áp dụng</button>
                            </label>
                            <a class="btn btn-checkout" href="{{ route('checkout') }}">Check out</a>
                            <a class="link-to-shop" href="{{ route('shop.index') }}">Tiếp tục mua hàng<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                        </div>
                        <div class="update-clear" style="float: right;">
                            <a class="btn btn-clear clearCart" data-clearAll="clearAll" href="#">Xóa giỏ hàng</a>
                            <input type="hidden" value="clearAll" id="clearAll" />
                        </div>
                    </div>
                <?php } else { ?>
                    <center><span class="text-danger" style="font-size: 20px;">Giỏ hàng đang trống 😱😱</span></center>
                <?php } ?>
            </form>
            <div class="wrap-show-advance-info-box style-1 box-in-site">
                <h3 class="title-box">Sản phẩm mới nhất</h3>
                <div class="wrap-products">
                    <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>
                        @foreach ($latestProducts as $latestProduct)
                        <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ route('productDetail.product',['slug' => $latestProduct->slug]) }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{ asset('public/uploads/'.$latestProduct->thumbnail) }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">Mới</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="{{ route('productDetail.product',['slug' => $latestProduct->slug]) }}" class="function-link">Xem nhanh</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('productDetail.product',['slug' => $latestProduct->slug]) }}" class="product-name"><span>{{$latestProduct->product_name}}</span></a>
                                    <?php if($latestProduct->product_sale != null) {?>
                                        <div class="wrap-price"><span class="product-price" style="text-decoration-line:line-through; color:red;">{{number_format($latestProduct->product_sell, 0, '', ',')}} đ</span></div>
                                        <div class="wrap-price"><span class="product-price">{{number_format($latestProduct->product_sale, 0, '', ',')}} đ</span></div>
                                    <?php } else { ?>
                                    <div class="wrap-price"><span class="product-price">{{number_format($latestProduct->product_sell, 0, '', ',')}} đ</span></div>
                                    <?php } ?>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!--End wrap-products-->
            </div>

        </div>
        <!--end main content area-->
    </div>
    <!--end container-->

</main>
<!--main area-->
@endsection