@extends('index')
@section('main')
<!--main area-->
<main id="main" class="main-site detail page">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">Trang chủ</a></li>
                <li class="item-link"><span>Chi tiết</span></li>
            </ul>
        </div>
        <div class="row">
            @foreach($productDetail as $product)
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                <div class="wrap-product-detail">
                    <div class="detail-media">
                        <div class="product-gallery">
                            <ul class="slides">

                                <li data-thumb="{{ asset('public/uploads/'.$product->thumbnail) }}">
                                    <img src="{{ asset('public/uploads/'.$product->thumbnail) }}" alt="product thumbnail" />
                                </li>

                                <li data-thumb="{{ asset('public/uploads/'.$product->thumbnail1) }}">
                                    <img src="{{ asset('public/uploads/'.$product->thumbnail1) }}" alt="product thumbnail" />
                                </li>

                                <li data-thumb="{{ asset('public/uploads/'.$product->thumbnail2) }}">
                                    <img src="{{ asset('public/uploads/'.$product->thumbnail2) }}" alt="product thumbnail" />
                                </li>

                                <li data-thumb="{{ asset('public/uploads/'.$product->thumbnail3) }}">
                                    <img src="{{ asset('public/uploads/'.$product->thumbnail3) }}" alt="product thumbnail" />
                                </li>

                                <li data-thumb="{{ asset('public/uploads/'.$product->thumbnail4) }}">
                                    <img src="{{ asset('public/uploads/'.$product->thumbnail4) }}" alt="product thumbnail" />
                                </li>

                                <li data-thumb="{{ asset('public/uploads/'.$product->thumbnail5) }}">
                                    <img src="{{ asset('public/uploads/'.$product->thumbnail5) }}" alt="product thumbnail" />
                                </li>

                            </ul>
                        </div>
                    </div>
                    <form>
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" class="cart_product_id_{{ $product->id }}" />
                        <input type="hidden" value="{{ $product->product_name }}" class="cart_product_name_{{ $product->id }}" />
                        <input type="hidden" value="{{ $product->thumbnail }}" class="cart_product_thumbnail_{{ $product->id }}" />
                        <input type="hidden" value="1" class="cart_product_quantity_{{ $product->id }}" />
                        <div class="detail-info">
                            <div class="product-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <a href="#" class="count-review">(05 đánh giá)</a>
                            </div>
                            <h2 class="product-name">{{$product->product_name}}</h2>
                            <div class="short-desc">
                                <ul>
                                    <li><strong>Tác giả:</strong> {{$product->author}}</li><br>
                                    <li><strong>Nhà xuất bản:</strong> {{$product->publisher_name}}</li><br>
                                    <li><strong>Năm xuất bản:</strong> {{date("d/m/Y", strtotime($product->publishing_year))}}</li>
                                </ul>
                            </div>
                            <div class="wrap-social">
                                <a class="link-socail" href="#"><img src="assets/images/social-list.png" alt=""></a>
                            </div>
                            <?php if ($product->product_sale != null) { ?>
                                <input type="hidden" value="{{ $product->product_sale }}" class="cart_product_price_{{ $product->id }}" />
                                <div class="wrap-price"><span class="product-price" style="text-decoration-line:line-through; color:red;">{{ number_format($product->product_sell, 0, '', ',') }}đ</span></div>
                                <div class="wrap-price"><span class="product-price">{{ number_format($product->product_sale, 0, '', ',') }}đ</span></div>
                            <?php } else { ?>
                                <input type="hidden" value="{{ $product->product_sell }}" class="cart_product_price_{{ $product->id }}" />
                                <div class="wrap-price"><span class="product-price">{{ number_format($product->product_sell, 0, '', ',') }}đ</span></div>
                            <?php } ?>
                            <div class="stock-info in-stock">
                                <?php if ($product->product_quantity == 0) { ?>
                                    <p class="availability">Khả dụng: <b>Hết hàng</b></p>
                                <?php } else { ?>
                                    <p class="availability">Khả dụng: <b>Còn hàng</b></p>
                                <?php } ?>
                            </div>
                            <div class="quantity">
                                <span>Số lượng:</span>
                                <div class="quantity-input">
                                    <input type="text" name="product-quatity" value="1" data-max="120" pattern="[0-9]*">

                                    <a class="btn btn-reduce" href="#"></a>
                                    <a class="btn btn-increase" href="#"></a>
                                </div>
                            </div>
                            <div class="wrap-butons">
                                <button type="button" class="btn btn-danger add-to-cart" data-id_product="{{ $product->id }}" name="add-to-cart">Thêm giỏ hàng</button>
                                <div class="wrap-btn">
                                    <a href="#" class="btn btn-compare">Thêm so sánh</a>
                                    <?php if (isset($wishlist)) { ?>
                                        <a href="{{ URL::to('remove-wishlist/'.$product->slug) }}" class="btn btn-wishlist">Bỏ yêu thích</a>
                                    <?php } else { ?>
                                        <a href="{{ URL::to('add-wishlist/'.$product->slug) }}" class="btn btn-wishlist">Thêm yêu thích</a>
                                    <?php } ?>
                                </div>
                            </div>
                                @if(Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                                @endif

                                @if(Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail') }}
                                </div>
                                @endif
                        </div>
                    </form>
                    <div class="advance-info">
                        <div class="tab-control normal">
                            <a href="#description" class="tab-control-item active">Mô tả</a>
                            <a href="#add_infomation" class="tab-control-item">Thông tin thêm</a>
                            <a href="#review" class="tab-control-item">Đánh giá</a>
                        </div>
                        <div class="tab-contents">
                            <div class="tab-content-item active" id="description">
                                {{strip_tags(html_entity_decode($product->product_description))}}
                            </div>
                            <div class="tab-content-item " id="add_infomation">
                                <table class="shop_attributes">
                                    <tbody>
                                        <tr>
                                            <th>Cân nặng</th>
                                            <td class="product_weight">{{ $product->product_weight }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kích thước</th>
                                            <td class="product_dimensions">{{ $product->product_dimensions }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ngôn ngữ</th>
                                            <td class="product_dimensions">{{ $product->product_language }}</td>
                                        </tr>
                                        <tr>
                                            <th>Số trang</th>
                                            <td>
                                                <p>{{ $product->product_pages }}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-content-item " id="review">

                                <div class="wrap-review-form">
                                    <?php if ($comments != "[]") { ?>
                                        @foreach($comments as $comment)
                                        <div id="comments">
                                            <ol class="commentlist">
                                                <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
                                                    <div id="comment-20" class="comment_container">
                                                        <?php if ($comment->avatar != null) { ?>
                                                            <img alt="" src="{{ $comment->avatar }}" height="80" width="80">
                                                        <?php } else { ?>
                                                            <img alt="" src="{{ asset('public/uploads/1620830662-product-thumbnail.jpg') }}" height="80" width="80">
                                                        <?php } ?>
                                                        <div class="comment-text">
                                                            <p class="meta">
                                                                <strong class="woocommerce-review__author">{{$comment->name}}</strong>
                                                                <span class="woocommerce-review__dash">–</span>
                                                                <time class="woocommerce-review__published-date">{{$comment->created_at->format('d/m/Y s:i:H')}}</time>
                                                            </p>
                                                            <div class="description">
                                                                <p>{{$comment->comment}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ol>
                                        </div><!-- #comments -->
                                        @endforeach
                                    <?php  } ?>
                                    <?php if (session()->has('LoggedUser')) { ?>
                                        <div id="review_form_wrapper">
                                            <div id="review_form">
                                                <div id="respond" class="comment-respond">

                                                    <form action="{{ route('user.comment') }}" method="POST" id="commentform" class="comment-form" novalidate="">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{session('LoggedUser')}}" />
                                                        <input type="hidden" name="product_id" value="{{$product->id}}" />
                                                        <p class="comment-form-comment">
                                                            <label for="comment">Bình luận<span class="required">*</span>
                                                            </label>
                                                            <textarea id="comment" name="comment" cols="45" rows="8"></textarea>
                                                            @if($errors->has('comment'))
                                                            <span class="text-danger">{{$errors->first('comment')}}</span>
                                                            @endif
                                                        </p>
                                                        <p class="form-submit">
                                                            <input name="submit" type="submit" id="submit" class="submit" value="Gửi">
                                                        </p>
                                                    </form>

                                                </div><!-- .comment-respond-->
                                            </div><!-- #review_form -->
                                        </div><!-- #review_form_wrapper -->
                                    <?php } else { ?>
                                        Đăng nhập để bình luận
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget widget-our-services ">
                    <div class="widget-content">
                        <ul class="our-services">

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-truck" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">Miễn phí vận chuyển</b>
                                        <span class="subtitle">Cho đơn hàng 500k trở lên</span>
                                        <p class="desc">Vận chuyển an toàn nhanh gọn lẹ...</p>
                                    </div>
                                </a>
                            </li>

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-gift" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">Khuyễn mãi đặc biệtr</b>
                                        <span class="subtitle">Nhận quà!</span>
                                        <p class="desc">Đôi khi mua hàng bạn sẽ nhận được quà đấy...</p>
                                    </div>
                                </a>
                            </li>

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">Trả hàng</b>
                                        <span class="subtitle">Đổi trả trong vòng 7 ngày</span>
                                        <p class="desc">Bạn sẽ được đổi trả trong vòng 7 ngày...</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div><!-- Categories widget-->

                <div class="widget mercado-widget widget-product">
                    <h2 class="widget-title">Sản Phẩm Phổ Biến</h2>
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
                                        <?php if($new->product_sale != null) {?>
                                            <div class="wrap-price"><span class="product-price" style="text-decoration-line:line-through; color:red;">{{number_format($new->product_sell, 0, '', ',')}} đ</span></div>
                                            <div class="wrap-price"><span class="product-price">{{number_format($new->product_sale, 0, '', ',')}} đ</span></div>
                                        <?php } else {?>
                                        <div class="wrap-price"><span class="product-price">{{number_format($new->product_sell, 0, '', ',')}} đ</span></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
            <!--end sitebar-->
            <?php if($similar_product != null) {?>
            <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Sản Phẩm Tương Tự</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>
                            @foreach($similar_product as $similar_pro)
                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ route('productDetail.product',['slug' => $similar_pro->slug]) }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{ asset('public/uploads/'.$similar_pro->thumbnail) }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="{{ route('productDetail.product',['slug' => $similar_pro->slug]) }}" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('productDetail.product',['slug' => $similar_pro->slug]) }}" class="product-name"><span>{{$similar_pro->product_name}}</span></a>
                                    <?php if($similar_pro->product_sale != null) {?>
                                        <div class="wrap-price"><span class="product-price" style="text-decoration-line:line-through; color:red;">{{number_format($similar_pro->product_sell, 0, '', ',')}} đ</span></div>
                                        <div class="wrap-price"><span class="product-price">{{number_format($similar_pro->product_sale, 0, '', ',')}} đ</span></div>
                                    <?php } else { ?>
                                    <div class="wrap-price"><span class="product-price">{{number_format($similar_pro->product_sell, 0, '', ',')}} đ</span></div>
                                    <?php } ?>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!--End wrap-products-->
                </div>
            </div>
            <?php } ?>
            @endforeach
        </div>
        <!--end row-->

    </div>
    <!--end container-->

</main>
<!--main area-->
@endsection