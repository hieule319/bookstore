@extends('index')
@section('main')
<!--main area-->
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="bookstoreproject" class="link">Trang chủ</a></li>
                <li class="item-link"><span>Liên hệ</span></li>
            </ul>
        </div>
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
            <div class=" main-content-area">
                <div class="wrap-contacts ">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="contact-box contact-form">
                            <h2 class="box-title">ĐỂ LẠI LỜI NHẮN</h2>
                            <form action="{{ route('contact.send') }}" method="POST" name="frm-contact">
                            @csrf
                                <label for="fullname">Họ và Tên<span>*</span></label>
                                <input type="text" value="" id="fullname" name="fullname">
                                @if($errors->has('fullname'))
                                <span class="text-danger">{{$errors->first('fullname')}}</span><br>
                                @endif

                                <label for="email">Email<span>*</span></label>
                                <input type="text" value="" id="email" name="email">
                                @if($errors->has('email'))
                                <span class="text-danger">{{$errors->first('email')}}</span><br>
                                @endif

                                <label for="phone">Số điện thoại</label>
                                <input type="text" value="" id="phone" name="phone">
                                @if($errors->has('phone'))
                                <span class="text-danger">{{$errors->first('phone')}}</span><br>
                                @endif

                                <label for="content">Lời nhắn</label>
                                <textarea name="content" id="content"></textarea>
                                @if($errors->has('content'))
                                <span class="text-danger">{{$errors->first('content')}}</span><br>
                                @endif

                                <input type="submit" value="Gửi">

                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="contact-box contact-info">
                            <div class="wrap-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.339126130587!2d106.6484393152604!3d10.785317261977664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752eb668e8fbd5%3A0x175a5489a9eb13da!2zOTExLzEvOCBM4bqhYyBMb25nIFF1w6JuLCBQaMaw4budbmcgMTEsIFTDom4gQsOsbmgsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1621956988349!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <h2 class="box-title">Contact Detail</h2>
                            <div class="wrap-icon-box">

                                <div class="icon-box-item">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <div class="right-info">
                                        <b>Email</b>
                                        <p>hieulev319@gmail.com</p>
                                    </div>
                                </div>

                                <div class="icon-box-item">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <div class="right-info">
                                        <b>Phone</b>
                                        <p>0888-537-087</p>
                                    </div>
                                </div>

                                <div class="icon-box-item">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <div class="right-info">
                                        <b>Mail Office</b>
                                        <p>911/1/8 Lạc Long Quân<br />q.Tân Bình - Hồ Chí Minh City</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end main products area-->

        </div>
        <!--end row-->

    </div>
    <!--end container-->

</main>
<!--main area-->
@endsection