@extends('index')
@section('main')
<!--main area-->
<main id="main" class="main-site">

<div class="container">

    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="/" class="link">Trang chủ</a></li>
            <li class="item-link"><span>Cảm ơn</span></li>
        </ul>
    </div>
</div>

<div class="container pb-60">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Cảm ơn bạn đã đặt hàng</h2>
            <p>Một email xác nhận đã được gửi.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-submit btn-submitx">Tiếp tục mua hàng</a>
        </div>
    </div>
</div><!--end container-->

</main>
<!--main area-->
@endsection