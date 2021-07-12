@extends('index')
@section('main')
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">Trang chủ</a></li>
                <li class="item-link"><span>Cửa hàng</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                <div class="banner-shop">
                    <a href="#" class="banner-link">
                        <figure><img src="assets/images/shop-banner.jpg" alt=""></figure>
                    </a>
                </div>

                <div class="wrap-shop-control">

                    <h1 class="shop-title">Sản Phẩm</h1>

                    <!--<div class="wrap-right">-->

                    <!--    <div class="sort-item orderby ">-->
                    <!--        <select name="orderby" class="use-chosen">-->
                    <!--            <option value="menu_order" selected="selected">Default sorting</option>-->
                    <!--            <option value="popularity">Sort by popularity</option>-->
                    <!--            <option value="rating">Sort by average rating</option>-->
                    <!--            <option value="date">Sort by newness</option>-->
                    <!--            <option value="price">Sort by price: low to high</option>-->
                    <!--            <option value="price-desc">Sort by price: high to low</option>-->
                    <!--        </select>-->
                    <!--    </div>-->

                    <!--</div>-->

                </div>
                <!--end wrap shop control-->

                <div class="row">

                    <ul class="product-list grid-products equal-container">
                        @foreach($products as $product)
                        <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                            <div class="product product-style-3 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ route('productDetail.product',['slug' => $product->slug]) }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{ asset('public/uploads/'.$product->thumbnail) }}" width="50%" height="50%"></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <form>
                                        @csrf
                                        <input type="hidden" value="{{ $product->id }}" class="cart_product_id_{{ $product->id }}" />
                                        <input type="hidden" value="{{ $product->product_name }}" class="cart_product_name_{{ $product->id }}" />
                                        <input type="hidden" value="{{ $product->thumbnail }}" class="cart_product_thumbnail_{{ $product->id }}" />
                                        <input type="hidden" value="1" class="cart_product_quantity_{{ $product->id }}" />
                                        <a href="{{ route('productDetail.product',['slug' => $product->slug]) }}" class="product-name"><span>{{ $product->product_name }}</span></a>
                                        <?php if ($product->product_sale != null) { ?>
                                            <input type="hidden" value="{{ $product->product_sale }}" class="cart_product_price_{{ $product->id }}" />
                                            <div class="wrap-price"><span class="product-price" style="text-decoration-line:line-through"><?php echo number_format($product->product_price, 0, '', ','); ?>đ</span></div>
                                            <div class="wrap-price"><span class="product-price"><?php echo number_format($product->product_sale, 0, '', ','); ?>đ</span></div>
                                        <?php } else { ?>
                                            <input type="hidden" value="{{ $product->product_sell }}" class="cart_product_price_{{ $product->id }}" />
                                            <div class="wrap-price"><span class="product-price"><?php echo number_format($product->product_sell, 0, '', ','); ?>đ</span></div>
                                        <?php } ?>
                                        <button type="button" class="btn btn-danger add-to-cart" data-id_product="{{ $product->id }}" name="add-to-cart">Thêm giỏ hàng</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                </div>

                <div class="wrap-pagination-info">
                    <ul class="page-numbers">
                        {{$products->links()}}
                    </ul>
                </div>
            </div>
            <!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget mercado-widget categories-widget">
                    <h2 class="widget-title">Danh Mục</h2>
                    <div class="widget-content">
                        <ul class="list-category">
                            @foreach($categories as $category)
                            <li class="category-item has-child-cate">
                                <a href="{{ route('category.product',['slug' => $category->slug]) }}" class="cate-link">{{ $category->category_name }}</a>
                                <?php
                                if ($category->category_detail != "[]") {
                                ?>
                                    <span class="toggle-control">+</span>
                                    <ul class="sub-cate">
                                        @foreach($category->category_detail as $category_detail)
                                        <li class="category-item"><a href="{{ route('subcategory.product',['slug' => $category_detail->slug]) }}" class="cate-link">{{ $category_detail->category_detail_name }}</a></li>
                                        @endforeach
                                    </ul>
                                <?php
                                }
                                ?>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- Categories widget-->

                <div class="widget mercado-widget filter-widget brand-widget">
                    <h2 class="widget-title">Nhà Xuất Bản</h2>
                    <div class="widget-content">
                        <ul class="list-style vertical-list list-limited" data-show="6">
                            <!-- <li class="list-item"><a class="filter-link active" href="#">Fashion Clothings</a></li> -->
                            @foreach($publishers as $publisher)
                            <li class="list-item"><a class="filter-link " href="#">{{ $publisher->publisher_name }}</a></li>
                            @endforeach
                            <li class="list-item default-hiden"><a class="filter-link " href="#">Printer & Ink</a></li>
                            <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div><!-- brand widget-->

                <div class="widget mercado-widget filter-widget price-filter">
                    <h2 class="widget-title">Giá</h2>
                    <div class="widget-content">
                        <div id="slider-range"></div>
                        <p>
                            <label for="amount">Price:</label>
                            <input type="text" id="amount" readonly>
                            <button class="filter-submit">Filter</button>
                        </p>
                    </div>
                </div><!-- Price-->

                <div class="widget mercado-widget widget-product">
                    <h2 class="widget-title">SẢN PHẨM PHỔ BIẾN</h2>
                    <div class="widget-content">
                        <ul class="products">
                            @foreach($product_new as $new)
                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="{{ route('productDetail.product',['slug' => $new->slug]) }}" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                            <figure><img src="{{ asset('public/uploads/'.$new->thumbnail) }}" alt=""></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('productDetail.product',['slug' => $new->slug]) }}" class="product-name"><span>{{ $new->product_name }}</span></a>
                                        <?php if ($new->product_sale != null) { ?>
                                            <div class="wrap-price"><span class="product-price" style="text-decoration-line:line-through">{{number_format($new->product_sell, 0, '', ',')}} đ</span></div>
                                            <div class="wrap-price"><span class="product-price">{{number_format($new->product_sale, 0, '', ',')}} đ</span></div>
                                        <?php } else { ?>
                                            <div class="wrap-price"><span class="product-price">{{number_format($new->product_sell, 0, '', ',')}} đ</span></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- brand widget-->

            </div>
            <!--end sitebar-->

        </div>
        <!--end row-->

    </div>
    <!--end container-->

</main>
@endsection