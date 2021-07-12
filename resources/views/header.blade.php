<header id="header" class="header header-style-1">
    <div class="container-fluid">
        <div class="row">
            <div class="topbar-menu-area">
                <div class="container">
                    <div class="topbar-menu left-menu">
                        <ul>
                            <li class="menu-item">
                                <a title="Hotline: (+123) 456 789" href="#"><span class="icon label-before fa fa-mobile"></span>Hotline: (+84) 999 999</a>
                            </li>
                        </ul>
                    </div>
                    <div class="topbar-menu right-menu">
                        <ul>
                            <?php if (session('LoggedUser') != null) { ?>
                                <li class="menu-item"><a title="Register or Login" href="profile">{{session('UserName')}}</a></li>
                                <li class="menu-item"><a title="Register or Login" href="logout">Đăng xuất</a></li>
                            <?php } else { ?>
                                <li class="menu-item"><a title="Register or Login" href="login">Đăng nhập</a></li>
                                <li class="menu-item"><a title="Register or Login" href="register">Đăng ký</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="mid-section main-info-area">

                    <div class="wrap-logo-top left-section">
                        <a href="/" class="link-to-home"><img src="{{ asset('public/user/assets/images/logo.png') }}" width="50%" alt="mercado"></a>
                    </div>

                    <div class="wrap-search center-section">
                        <div class="wrap-search-form">
                            <form action="{{ route('product.search') }}" id="form-search-top" name="form-search-top" method="POST">
                                @csrf
                                <input type="text" name="search" id="keywords" placeholder="Tìm kiếm..." autocomplete="off">
                                <div id="resultSearch"></div>
                                <button form="form-search-top" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                <div class="wrap-list-cate">
                                    <input type="hidden" name="product-cate" value="0" id="product-cate">
                                    <a href="#" class="link-control">Danh mục</a>
                                    <ul class="list-cate">
                                        <li class="level-0">Danh mục</li>
                                        @foreach($categories as $category)
                                        <li class="level-1"><a href="{{ route('category.product',['slug' => $category->slug]) }}" class="cate-link">-{{$category->category_name}}</a></li>
                                        <?php
                                        if ($category->category_detail != "[]") {
                                        ?>
                                            @foreach($category->category_detail as $category_detail)
                                            <li class="level-2"><a href="{{ route('subcategory.product',['slug' => $category_detail->slug]) }}" class="cate-link">{{$category_detail->category_detail_name}}</a></li>
                                            @endforeach
                                        <?php } ?>
                                        @endforeach
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="wrap-icon right-section">
                        <div class="wrap-icon-section wishlist">
                            <a href="{{ route('wishlist.list') }}" class="link-direction">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                <div class="left-info">
                                    <?php if(session()->has('wishlist') && session('wishlist') != null) {?>
                                        <span class="index">{{session('wishlist')}} item</span>
                                    <?php } else { ?>
                                        <span class="index">0 item</span>
                                    <?php  } ?>
                                    <span class="title">Yêu thích</span>
                                </div>
                            </a>
                        </div>
                        <div class="wrap-icon-section minicart">
                            <a href="{{ route('showCart') }}" class="link-direction">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                <div class="left-info">
                                    <?php
                                    $count_cart = 0;
                                    if (session('cart') != null) {
                                        $count_cart = count(session('cart'));
                                    }
                                    ?>
                                    <span class="index">{{$count_cart}} items</span>
                                    <span class="title">Giỏ hàng</span>
                                </div>
                            </a>
                        </div>
                        <div class="wrap-icon-section show-up-after-1024">
                            <a href="#" class="mobile-navigation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="nav-section header-sticky">
                <div class="header-nav-section">
                    <div class="container">
                        <ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info">
                            <li class="menu-item"><a href="https://bookstoreproject.online/tham-tu-conan-hoat-hinh-mau-cuoc-dieu-tra-giua-bien-khoi-tap-2-tai-ban-2020" class="link-term">Nổi bật hàng tuần</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="https://bookstoreproject.online/doraemon-chu-meo-may-den-tu-tuong-lai-tap-1" class="link-term">Hàng giảm giá</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="https://bookstoreproject.online/bo-sach-giao-khoa-lop-1" class="link-term">Sản phẩm mới</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="https://bookstoreproject.online/tiem-cam-do-thoi-gian-3-ngoai-truyen-nam-thang-voi-va-toi-van-cho-em" class="link-term">Bán chạy nhất</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="https://bookstoreproject.online/tiem-cam-do-thoi-gian-3-ngoai-truyen-nam-thang-voi-va-toi-van-cho-em" class="link-term">Xếp hạng cao</a><span class="nav-label hot-label">hot</span></li>
                        </ul>
                    </div>
                </div>

                <div class="primary-nav-section">
                    <div class="container">
                        <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu">
                            <li class="menu-item home-icon">
                                <a href="/" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
                            </li>
                            <li class="menu-item">
                                <a href="/" class="link-term mercado-item-title">Giới thiệu</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('shop.index') }}" class="link-term mercado-item-title">Cửa hàng</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('showCart') }}" class="link-term mercado-item-title">Giỏ hàng</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('contact') }}" class="link-term mercado-item-title">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>