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
                    <li class="active"><a href="profile"> <i class="fa fa-user"></i> Profile</a></li>
                    <li><a href="{{ route('promotion.showPromotion') }}"> <i class="fa fa-gift" aria-hidden="true"></i> Voucher</a></li>
                    <li><a href="{{ route('order.list') }}"> <i class="fa fa-history"></i> Lịch sử đặt hàng</a></li>
                    <li><a href="{{ route('dilivery.address') }}"> <i class="fa fa-address-card"></i> Địa chỉ giao hàng</a></li>
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
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $pro->id }}" />
                        <h1>Bio Graph</h1>
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
                                <input type="text" class="form-control" name="fullname" value="{{ $pro->fullname }}">
                            </div>
                            <div class="bio-row">
                                <strong><label for="slug">Quốc gia</label></strong>
                                <input type="text" class="form-control" name="country" value="{{ $pro->country }}">
                            </div>
                            <div class="bio-row">
                                <strong><label for="slug">Ngày sinh</label></strong>
                                <input type="date" class="form-control" name="birthday" value="{{ $pro->birthday }}">
                            </div>
                            <div class="bio-row">
                                <strong><label for="slug">Số điện thoại</label></strong>
                                <input type="text" class="form-control" name="phone" value="0{{ $pro->phone }}">
                            </div>
                            <?php if ($pro->password != null) { ?>
                                <div class="bio-row">
                                    <strong><label for="password">Mật khẩu</label></strong>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            <?php } ?>
                        </div>
                        <button type="submit" class="btn btn-warning pull-right">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection