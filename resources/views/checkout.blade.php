@extends('index')
@section('main')
<!--main area-->
<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">Trang chủ</a></li>
                <li class="item-link"><span>Thanh toán</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <div class="wrap-address-billing">
                <h3 class="box-title">Địa chỉ thanh toán</h3>
                <div class="result">
                    @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                </div>

                <div class="result">
                    @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                    @endif
                </div>
                <?php if (session()->has('result')) { ?>
                    @foreach( session('result') as $res)
                    <form action="{{ route('delivery.checkOutDelivery') }}" method="POST" name="frm-billing">
                        @csrf
                        <p class="row-in-form">
                            <label for="fullname">Họ và tên<span>*</span></label>
                            <input type="text" name="fullname" value="{{ $res->fullname }}">
                        </p>
                        <p class="row-in-form">
                            <label for="email">Email<span>*</span></label>
                            <input type="email" name="email" value="{{ $res->email }}">
                        </p>
                        <p class="row-in-form">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" value="{{ $res->address }}">
                        </p>
                        <p class="row-in-form">
                            <label for="phone_delivery">Số điện thoại<span>*</span></label>
                            <input id="phone" type="number" name="phone_delivery" value="0{{ $res->phone_delivery }}">
                        </p>
                        <p class="row-in-form">
                            <label for="city">Thành phố<span>*</span></label>
                            <input type="text" name="city" value="{{ $res->city }}">
                        </p>
                        <p class="row-in-form">
                            <label for="city">Tỉnh<span>*</span></label>
                            <input type="text" name="province" value="{{ $res->province }}">
                        </p>
                        <button type="submit" class="btn btn-danger" style="float:right">Thêm địa chỉ</button>
                    </form>
                    @endforeach
                <?php } else { ?>
                    <form action="{{ route('delivery.checkOutDelivery') }}" method="POST" name="frm-billing">
                        @csrf
                        <p class="row-in-form">
                            <label for="fullname">Họ và tên<span>*</span></label>
                            <input type="text" name="fullname" value="">
                        </p>
                        <p class="row-in-form">
                            <label for="email">Email<span>*</span></label>
                            <input type="email" name="email" value="">
                        </p>
                        <p class="row-in-form">
                            <label for="email">Địa chỉ</label>
                            <input type="text" name="address" value="">
                        </p>
                        <p class="row-in-form">
                            <label for="phone">Số điện thoại<span>*</span></label>
                            <input id="phone" type="number" name="phone_delivery" value="">
                        </p>
                        <p class="row-in-form">
                            <label for="city">Thành phố<span>*</span></label>
                            <input type="text" name="city" value="">
                        </p>
                        <p class="row-in-form">
                            <label for="city">Tỉnh<span>*</span></label>
                            <input type="text" name="province" value="">
                        </p>
                        <button type="submit" class="btn btn-danger" style="float:right">Thêm mới</button>
                    </form>
                <?php } ?>
            </div>
            <div class="widget mercado-widget filter-widget brand-widget">
                <h2 class="widget-title">Hoặc</h2>
                <div class="widget-content">
                    <ul class="list-style vertical-list list-limited" data-show="6">
                        <?php $stt = 0; ?>
                        @foreach($deliveries as $delivery)
                        <li class="list-item default-hiden">
                            <form action="{{ route('choose.delivery') }}" method="POST">
                                @csrf
                                <input type="hidden" name="delivery_id" value="{{$delivery->id}}" />
                                <button type="submit" class="btn-link">{{ $delivery->address }}</button>
                            </form>
                        </li>
                        @endforeach
                        <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="#">Xem thêm<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div><!-- brand widget-->
            <div class="summary summary-checkout">
                <div class="summary-item payment-method">
                    <form action="{{ route('order.create') }}" method="POST">
                        @csrf
                        <h4 class="title-box">PHƯƠNG THỨC THANH TOÁN</h4>
                        <?php if (session()->has('result')) { ?>
                            @foreach( session('result') as $res)
                            <input type="hidden" name="deliveryId" value="{{$res->id}}" />
                            @endforeach
                        <?php } ?>
                        @if($errors->has('deliveryId'))
                        <span class="text-danger" style="float:right">{{$errors->first('deliveryId')}}</span>
                        @endif
                        <p class="summary-info"><span class="title">Tiền mặt</span></p>
                        <p class="summary-info"><span class="title">Thanh toán online</span></p>
                        <div class="choose-payment-methods">
                            <label class="payment-method">
                                <input type="radio" id="payment-method-bank" name="payment" value="cash">
                                <span>Thanh toán khi nhận hàng</span>
                                <span class="payment-desc">Khách hàng nhận hàng kiểm tra và giao tiền cho nhân viên giao hàng.</span>
                            </label>
                            <label class="payment-method">
                                <input name="payment" id="payment-method-paypal" value="paypal" type="radio">
                                <span>Paypal</span>
                                <?php 
                                    $vnd_to_usd = session('total')/23047;
                                ?>
                                <span class="payment-desc"><div id="paypal-button"></div></span>
                                <input type="hidden" id="vnd_to_usd" value="{{round($vnd_to_usd,2)}}"/>
                                <span class="payment-desc">card if you don't have a paypal account</span>
                            </label>
                        </div>
                        @if($errors->has('payment'))
                        <span class="text-danger" style="float:right">{{$errors->first('payment')}}</span>
                        @endif
                        <p class="summary-info grand-total"><span>Tổng cộng</span> <span class="grand-total-price">{{number_format(session('total'), 0, '', ',')}}</span></p>
                        <button type="submit" class="btn btn-medium">Đặt hàng ngay</button>
                    </form>
                </div>
                <div class="summary-item shipping-method">
                    <h4 class="title-box f-title">Phí Vận Chuyển</h4>
                    <p class="summary-info"><span class="title">Phí : 30,000 đ</span></p>
                </div>
            </div>

            <div class="wrap-show-advance-info-box style-1 box-in-site">
                <h3 class="title-box">Sản Phẩm Mới Nhất</h3>
                <div class="wrap-products">
                    <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>
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
                <!--End wrap-products-->
            </div>

        </div>
        <!--end main content area-->
    </div>
    <!--end container-->

</main>
<!--main area-->
@endsection