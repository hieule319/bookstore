<footer id="footer">
    <div class="wrap-footer-content footer-style-1">

        <div class="wrap-function-info">
            <div class="container">
                <ul>
                    <li class="fc-info-item">
                        <i class="fa fa-truck" aria-hidden="true"></i>
                        <div class="wrap-left-info">
                            <h4 class="fc-name">Miễn phí giao hàng</h4>
                            <p class="fc-desc">Cho đơn hàng từ 500k</p>
                        </div>

                    </li>
                    <li class="fc-info-item">
                        <i class="fa fa-recycle" aria-hidden="true"></i>
                        <div class="wrap-left-info">
                            <h4 class="fc-name">Bảo hành</h4>
                            <p class="fc-desc">Hoàn tiền trong 30 ngày</p>
                        </div>

                    </li>
                    <li class="fc-info-item">
                        <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                        <div class="wrap-left-info">
                            <h4 class="fc-name">Thanh toán an toàn</h4>
                            <p class="fc-desc">An toàn </p>
                        </div>

                    </li>
                    <li class="fc-info-item">
                        <i class="fa fa-life-ring" aria-hidden="true"></i>
                        <div class="wrap-left-info">
                            <h4 class="fc-name">Hỗ trợ trực tuyến</h4>
                            <p class="fc-desc">Chúng tôi có hỗ trợ 24/7</p>
                        </div>

                    </li>
                </ul>
            </div>
        </div>
        <!--End function info-->

        <div class="main-footer-content">

            <div class="container">

                <div class="row">

                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                        <div class="wrap-footer-item">
                            <h3 class="item-header">Chi Tiết Liên Hệ</h3>
                            <div class="item-content">
                                <div class="wrap-contact-detail">
                                    <ul>
                                        <li>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <p class="contact-txt">911/1/8 Lạc Long Quân, p.11, q.Tân Bình, Hồ Chí Minh, Việt Nam</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <p class="contact-txt">(+84) 888 537 087 - (+84) 666 888</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            <p class="contact-txt">hieulev319@gmail.com</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

                        <div class="wrap-footer-item">
                            <h3 class="item-header">Hot Line</h3>
                            <div class="item-content">
                                <div class="wrap-hotline-footer">
                                    <span class="desc">Gọi miễn phí</span>
                                    <b class="phone-number">(+84) 888 537 087 - (+123) 666 888</b>
                                </div>
                            </div>
                        </div>

                        <div class="wrap-footer-item footer-item-second">
                            <h3 class="item-header">Sign up for newsletter</h3>
                            <div class="item-content">
                                <div class="wrap-newletter-footer">
                                    <form action="#" class="frm-newletter" id="frm-newletter">
                                        <input type="email" class="input-email" name="email" value="" placeholder="Enter your email address">
                                        <button class="btn-submit">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 box-twin-content ">
                        <div class="row">
                            <div class="wrap-footer-item twin-item">
                                <h3 class="item-header">Tài khoản</h3>
                                <div class="item-content">
                                    <div class="wrap-vertical-nav">
                                        <ul>
                                            <li class="menu-item"><a href="/" class="link-term">Tài khoản</a></li>
                                            <li class="menu-item"><a href="/" class="link-term">Thương hiệu</a></li>
                                            <li class="menu-item"><a href="/" class="link-term">Quà tặng</a></li>
                                            <li class="menu-item"><a href="/" class="link-term">Chi nhánh</a></li>
                                            <li class="menu-item"><a href="/" class="link-term">Danh sách</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap-footer-item twin-item">
                                <h3 class="item-header">Thông tin</h3>
                                <div class="item-content">
                                    <div class="wrap-vertical-nav">
                                        <ul>
                                            <li class="menu-item"><a href="{{ route('contact') }}" class="link-term">Contact Us</a></li>
                                            <li class="menu-item"><a href="/" class="link-term">Lợi nhuận</a></li>
                                            <li class="menu-item"><a href="https://www.google.com/maps/place/911%2F1%2F8+L%E1%BA%A1c+Long+Qu%C3%A2n,+Ph%C6%B0%E1%BB%9Dng+11,+T%C3%A2n+B%C3%ACnh,+Th%C3%A0nh+ph%E1%BB%91+H%E1%BB%93+Ch%C3%AD+Minh,+Vi%E1%BB%87t+Nam/@10.785312,106.6484393,17z/data=!3m1!4b1!4m5!3m4!1s0x31752eb668e8fbd5:0x175a5489a9eb13da!8m2!3d10.785312!4d106.650628?hl=vi-VN" class="link-term">Địa chỉ map</a></li>
                                            <li class="menu-item"><a href="/" class="link-term">Specials</a></li>
                                            <?php if(session()->has('LoggedUser')) {?>
                                                <li class="menu-item"><a href="{{ route('order.list') }}" class="link-term">Order History</a></li>
                                            <?php } else{ ?>
                                            <li class="menu-item"><a href="login" class="link-term">Lịch sử đặt hàng</a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                        <div class="wrap-footer-item">
                            <h3 class="item-header">Hình thức thanh toán:</h3>
                            <div class="item-content">
                                <div class="wrap-list-item wrap-gallery">
                                    <img src="{{asset('public/uploads/brands/payment.png')}}" style="max-width: 260px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                        <div class="wrap-footer-item">
                            <h3 class="item-header">Mạng xã hội</h3>
                            <div class="item-content">
                                <div class="wrap-list-item social-network">
                                    <ul>
                                        <li><a href="/" class="link-to-item" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="https://www.facebook.com/profile.php?id=100004021754013" class="link-to-item" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="https://www.facebook.com/profile.php?id=100004021754013" class="link-to-item" title="pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                        <li><a href="https://www.facebook.com/profile.php?id=100004021754013" class="link-to-item" title="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                        <li><a href="https://www.facebook.com/profile.php?id=100004021754013" class="link-to-item" title="vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                        <div class="wrap-footer-item">
                            <h3 class="item-header">Tải App</h3>
                            <div class="item-content">
                                <div class="wrap-list-item apps-list">
                                    <ul>
                                        <li><a href="https://www.apple.com/app-store/" class="link-to-item" title="our application on apple store">
                                                <figure><img src="{{asset('public/uploads/brands/apple-store.png')}}" alt="apple store" width="128" height="36"></figure>
                                            </a></li>
                                        <li><a href="https://play.google.com/store?hl=vi&gl=US" class="link-to-item" title="our application on google play store">
                                                <figure><img src="{{asset('public/uploads/brands/google-play-store.png')}}" alt="google play store" width="128" height="36"></figure>
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="wrap-back-link">
                <div class="container">
                    <div class="back-link-box">
                        <h3 class="backlink-title">Đường dẫn nhanh</h3>
                        
                    </div>
                </div>
            </div>

        </div>

        <div class="coppy-right-box">
            <div class="container">
                <div class="coppy-right-item item-left">
                    <p class="coppy-right-text">Copyright © 2020 Surfside Media. All rights reserved</p>
                </div>
                <div class="coppy-right-item item-right">
                    <div class="wrap-nav horizontal-nav">
                        <ul>
                            <li class="menu-item"><a href="/" class="link-term">Giới thiệu</a></li>
                            <li class="menu-item"><a href="/" class="link-term">Chính sách bảo mật</a></li>
                            <li class="menu-item"><a href="/" class="link-term">Điều khoản và điều kiện</a></li>
                            <li class="menu-item"><a href="/" class="link-term">Chính sách hoàn trả</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</footer>