@extends('index')
<link rel="stylesheet" type="text/css" href="{{ asset('public/user/assets/css/userprofile.css') }}">
@section('main')
<div class="container bootstrap snippets bootdey">
    <div class="row">
        @foreach ($profile as $pro)
        <div class="profile-nav col-md-3">
            <div class="panel">
                <div class="user-heading round">
                    <a href="#">
                        <?php if (isset($pro->google_id)) { ?>
                            <img src="{{ $pro->avatar }}" alt="">
                        <?php } ?>
                    </a>
                    <h1>{{ $pro->name }}</h1>
                    <p>{{ $pro->email }}</p>
                </div>

                <ul class="nav nav-pills nav-stacked">
                    <li><a href="profile"> <i class="fa fa-user"></i> Profile</a></li>
                    <li><a href="{{ route('promotion.showPromotion') }}"> <i class="fa fa-gift" aria-hidden="true"></i> Voucher</a></li>
                    <li><a href="{{ route('order.list') }}"> <i class="fa fa-history"></i> Lịch sử đặt hàng</a></li>
                    <li class="active"><a href="{{ route('dilivery.address') }}"> <i class="fa fa-address-card"></i> Địa chỉ giao hàng</a></li>
                    <li><a href="{{ route('wishlist.list') }}"><i class="fa fa-heart" aria-hidden="true"></i>Danh sách yêu thích</a></li>
                </ul>
            </div>
        </div>
        <div class="profile-info col-md-9">
            <div class="panel">
                <div class="bio-graph-heading">
                    Chúng ta có thể gặp nhiều thất bại nhưng chúng ta không được bị đánh bại.
                </div>
                <div class="panel-body bio-graph-info">
                    <form action="{{ route('delivery.addAddress') }}" method="POST">
                        @csrf
                        <h1>Địa chỉ giao hàng</h1>
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
                        <div class="row">
                            <div class="bio-row">
                                <strong><label for="slug">Họ và tên</label></strong>
                                <input type="text" class="form-control" name="fullname">
                            </div>
                            <div class="bio-row">
                                <strong><label for="slug">Email</label></strong>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="bio-row">
                                <strong><label for="slug">Địa chỉ</label></strong>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="bio-row">
                                <strong><label for="slug">Thành phố</label></strong>
                                <input type="text" class="form-control" name="city">
                            </div>
                            <div class="bio-row">
                                <strong><label for="slug">Tỉnh</label></strong>
                                <input type="text" class="form-control" name="province">
                            </div>
                            <div class="bio-row">
                                <strong><label for="slug">Số điện thoại</label></strong>
                                <input type="text" class="form-control" name="phone_delivery">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning pull-right">Thêm mới</button>
                    </form>
                </div>
            </div>
            <div>
                <div class="row">
                    <?php $stt = 1; ?>
                    @foreach ($deliveries as $delivery)
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="bio-chart">
                                    <div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="{{$stt}}" data-fgcolor="#e06b7d" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(224, 107, 125); padding: 0px; -webkit-appearance: none; background: none;"></div>
                                </div>
                                <div class="bio-desk"><a href="{{ route('delivery.deleteAddress',['id' => $delivery->id]) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" style="float: right; font-size:large;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                    <h4 class="red">{{ $delivery->address }}</h4>
                                    <p>Họ và tên : {{$delivery->fullname}}</p>
                                    <p>Email : {{$delivery->email}}</p>
                                    <p>Số điện thoại : 0{{$delivery->phone_delivery}}</p>
                                    <p>Thành phố : {{$delivery->city}}</p>
                                    <p>Tỉnh : {{$delivery->province}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $stt++; ?>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection