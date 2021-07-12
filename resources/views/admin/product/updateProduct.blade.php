@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cập Nhật Sản Phẩm</h6>
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
    <div class="card-body">
        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            @foreach($products as $key => $product)
            <input type="hidden" name="id" value="{{ $product->id }}" />
            <div class="form-row">
                <div class="form-group col-md-5">
                    <strong><label for="product_name">Tên sản phẩm</label></strong>
                    <div class="input-group">
                        <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="product_name" value="{{ $product->product_name }}" placeholder="">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fab fa-product-hunt"></i></span>
                        </div>
                    </div>
                    @if($errors->has('product_name'))
                    <span class="text-danger">{{$errors->first('product_name')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <strong><label for="product_price">Giá gốc</label></strong>
                    <div class="input-group">
                        <input type="text" class="form-control" name="product_price" id="product_price" value="{{ $product->product_price }}" placeholder="">
                        <div class="input-group-append">
                            <span class="input-group-text">VNĐ</span>
                        </div>
                    </div>
                    @if($errors->has('product_price'))
                    <span class="text-danger">{{$errors->first('product_price')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <strong><label for="category">Danh mục - Thể loại</label></strong>
                    <ul style="list-style-type: none;">
                        @foreach($categories as $category)
                        <li>
                            <div>
                                <?php if ($category->id == $product->category_id) { ?>
                                    <input type='radio' name="category_id" value="{{$category->id}}" data-toggle='collapse' data-target='#collapsediv{{$category->id}}' checked>
                                    {{ $category->category_name }}</input>
                                <?php } else { ?>
                                    <input type='radio' name="category_id" value="{{$category->id}}" data-toggle='collapse' data-target='#collapsediv{{$category->id}}'>
                                    {{ $category->category_name }}</input>
                                <?php  } ?>
                            </div>
                            <div id='collapsediv{{$category->id}}' class='collapse div1'>
                                <ul style="list-style-type: none;">
                                    @foreach($category->category_detail as $category_detail)
                                    <li>
                                        <div>
                                            <?php if ($category_detail->id == $product->category_detail_id) { ?>
                                                <input type='checkbox' name="category_detail_id" value="{{$category_detail->id}}" checked> {{ $category_detail->category_detail_name }}</input>
                                            <?php } else { ?>
                                                <input type='checkbox' name="category_detail_id" value="{{$category_detail->id}}"> {{ $category_detail->category_detail_name }}</input>
                                            <?php } ?>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @if($errors->has('category_id'))
                    <span class="text-danger">{{$errors->first('category_id')}}</span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <strong><label for="slug">Slug</label></strong>
                    <div class="input-group">
                        <input type="text" class="form-control" id="convert_slug" name="slug" value="{{ $product->slug }}" placeholder="">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-globe" aria-hidden="true"></i></span>
                        </div>
                    </div>
                    @if($errors->has('slug'))
                    <span class="text-danger">{{$errors->first('slug')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <strong><label for="product_sell">Giá bán</label></strong>
                    <div class="input-group">
                        <input type="text" class="form-control" name="product_sell" id="product_sell" value="{{ $product->product_sell }}" placeholder="">
                        <div class="input-group-append">
                            <span class="input-group-text">VNĐ</span>
                        </div>
                    </div>
                    @if($errors->has('product_sell'))
                    <span class="text-danger">{{$errors->first('product_sell')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <strong><label for="status">Trạng thái</label></strong>
                    <ul style="list-style-type: none;">
                        <?php if ($product->status == 0) { ?>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="0" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Bán
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Ngưng
                                    </label>
                                </div>
                            </li>
                        <?php  } else { ?>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="0">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Bán
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Ngưng
                                    </label>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <strong><label for="product_qrcode">QR Code</label></strong>
                    <div class="input-group">
                        <input type="text" class="form-control" id="product_qrcode" name="product_qrcode" value="{{ $product->product_qrcode }}" placeholder="">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <strong><label for="product_sale">Giá khuyến mãi</label></strong>
                    <div class="input-group">
                        <input type="text" class="form-control" name="product_sale" id="product_sale" value="{{ $product->product_sale }}" placeholder="">
                        <div class="input-group-append">
                            <span class="input-group-text">VNĐ</span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <strong><label for="author">Tác giả</label></strong>
                    <div class="input-group">
                        <input type="text" class="form-control" name="author" id="author" value="{{ $product->author }}" placeholder="">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <strong><label for="product_quantity">Số lượng</label></strong>
                    <div class="input-group">
                        <input type="text" class="form-control" name="product_quantity" id="product_quantity" value="{{ $product->product_quantity }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-sort-amount-up"></i></span>
                        </div>
                    </div>
                    @if($errors->has('product_quantity'))
                    <span class="text-danger">{{$errors->first('product_quantity')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <strong><label for="product_unit">Đơn vị tính</label></strong>
                    <div class="input-group">
                        <input type="text" class="form-control" name="product_unit" id="product_unit" value="{{ $product->product_unit }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-balance-scale" aria-hidden="true"></i></span>
                        </div>
                    </div>
                    @if($errors->has('product_unit'))
                    <span class="text-danger">{{$errors->first('product_unit')}}</span>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <strong><label for="publisher_id">Nhà xuất bản</label></strong>
                    <select class="form-control" id="searchPublisher" name="publisher_id" value="{{ $product->publisher_id }}">
                        <option value="0">Chọn</option>
                        @foreach($publishers as $publisher)
                        <?php if ($publisher->id == $product->publisher_id) { ?>
                            <option value="{{ $publisher->id }}" selected>{{ $publisher->publisher_name }}</option>
                        <?php } else { ?>
                            <option value="{{ $publisher->id }}">{{ $publisher->publisher_name }}</option>
                        <?php } ?>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <strong><label for="publishing_year">Năm xuất bản</label></strong>
                    <input type="date" class="form-control" name="publishing_year" id="publishing_year" value="{{ $product->publishing_year }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <strong><label for="product_weight">Cân nặng</label></strong>
                    <div class="input-group">
                        <input type="text" class="form-control" name="product_weight" value="{{ $product->product_weight }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-weight"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <strong><label for="product_dimensions">Kích thước</label></strong>
                    <div class="input-group">
                        <input type="text" class="form-control" name="product_dimensions" value="{{ $product->product_dimensions }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-camera"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <strong><label for="product_pages">Số trang</label></strong>
                    <div class="input-group">
                        <input type="text" class="form-control" name="product_pages" value="{{ $product->product_pages }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-palette"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <strong><label for="product_language">Ngôn ngữ</label></strong>
                    <div class="input-group">
                        <input type="text" class="form-control" name="product_language" value="{{ $product->product_language }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-language" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <strong><label for="product_description">Mô tả</label></strong>
                <textarea class="form-control" name="product_description" id="product_description" rows="3">
                {{ $product->product_description }}
                </textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <input type="hidden" class="form-control" name="thumbnail" id="thumbnail" value="{{ $product->thumbnail }}">
                </div>
                <div class="form-group col-md-1">
                    <input type="hidden" class="form-control" name="thumbnail1" id="thumbnail1" value="{{ $product->thumbnail1 }}">
                </div>
                <div class="form-group col-md-1">
                    <input type="hidden" class="form-control" name="thumbnail2" id="thumbnail2" value="{{ $product->thumbnail2 }}">
                </div>
                <div class="form-group col-md-1">
                    <input type="hidden" class="form-control" name="thumbnail3" id="thumbnail3" value="{{ $product->thumbnail3 }}">
                </div>
                <div class="form-group col-md-1">
                    <input type="hidden" class="form-control" name="thumbnail4" id="thumbnail4" value="{{ $product->thumbnail4 }}">
                </div>
                <div class="form-group col-md-1">
                    <input type="hidden" class="form-control" name="thumbnail5" id="thumbnail5" value="{{ $product->thumbnail5 }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-1">
                    <strong><label for="product_thumbnail">Ảnh đại diện</label></strong>
                    <img src="{{ asset('public/uploads/'.$product->thumbnail) }}" id="show_img" style="width:90%" class="rounded" />
                </div>
                <div class="form-group col-md-11">
                    <strong><label for="list_thumbnail">Bộ sưu tập</label></strong>
                    <div class="form-row">
                        <div class="form-group col-md-1">
                            <img src="{{ asset('public/uploads/'.$product->thumbnail1 ) }}" id="show_img1" style="width:100%" class="rounded" />
                        </div>
                        <div class="form-group col-md-1">
                            <img src="{{ asset('public/uploads/'.$product->thumbnail2 ) }}" id="show_img2" style="width:100%" class="rounded" />
                        </div>
                        <div class="form-group col-md-1">
                            <img src="{{ asset('public/uploads/'.$product->thumbnail3 ) }}" id="show_img3" style="width:100%" class="rounded" />
                        </div>
                        <div class="form-group col-md-1">
                            <img src="{{ asset('public/uploads/'.$product->thumbnail4 ) }}" id="show_img4" style="width:100%" class="rounded" />
                        </div>
                        <div class="form-group col-md-1">
                            <img src="{{ asset('public/uploads/'.$product->thumbnail5 ) }}" id="show_img5" style="width:100%" class="rounded" />
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#primaryImagesModal">
                        Ảnh đại diện
                    </button>
                    <button type="button" class="btn btn-warning" data-toggle="collapse" href="#imageCollapse">
                        Bộ sưu tập
                    </button>
                </div>
            </div>
            @endforeach
            <!-- Image Collapse -->
            <div class="form-row collapse" id="imageCollapse">
                <div class="form-group col-md-1">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#images1Modal">Ảnh 1</button>
                </div>
                <div class="form-group col-md-1">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#images2Modal">Ảnh 2</button>
                </div>
                <div class="form-group col-md-1">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#images3Modal">Ảnh 3</button>
                </div>
                <div class="form-group col-md-1">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#images4Modal">Ảnh 4</button>
                </div>
                <div class="form-group col-md-1">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#images5Modal">Ảnh 5</button>
                </div>
            </div>
            <button type="submit" class="btn btn-success" style="float:right">Cập nhật</button>
        </form>
    </div>
</div>


<!-- Upload Modal -->
<div class="modal fade" id="primaryImagesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Images</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="{{url('public/filemanager/dialog.php?field_id=thumbnail')}}" style="width:100%; height:500px; overflow-y:auto; border:none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<!-- Upload 1 Modal -->
<div class="modal fade" id="images1Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Images</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="{{url('public/filemanager/dialog.php?field_id=thumbnail1')}}" style="width:100%; height:500px; overflow-y:auto; border:none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<!-- Upload 2 Modal -->
<div class="modal fade" id="images2Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Images</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="{{url('public/filemanager/dialog.php?field_id=thumbnail2')}}" style="width:100%; height:500px; overflow-y:auto; border:none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<!-- Upload 3 Modal -->
<div class="modal fade" id="images3Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Images</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="{{url('public/filemanager/dialog.php?field_id=thumbnail3')}}" style="width:100%; height:500px; overflow-y:auto; border:none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<!-- Upload 4 Modal -->
<div class="modal fade" id="images4Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Images</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="{{url('public/filemanager/dialog.php?field_id=thumbnail4')}}" style="width:100%; height:500px; overflow-y:auto; border:none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<!-- Upload 5 Modal -->
<div class="modal fade" id="images5Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Images</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="{{url('public/filemanager/dialog.php?field_id=thumbnail5')}}" style="width:100%; height:500px; overflow-y:auto; border:none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@endsection