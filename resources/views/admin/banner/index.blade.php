@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Banner</h6>
        <a href="{{ route('product.createProduct') }}" class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#bannerModal">Thêm mới</a>
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
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh bìa</th>
                        <th>Đường link</th>
                        <th>Vị trí đặt</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh bìa</th>
                        <th>Đường link</th>
                        <th>Vị trí đặt</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $stt = 1 ?>
                    @foreach($banners as $key => $banner)
                    <tr>
                        <td>{{ $stt }}</td>
                        <td><img src="{{asset('public/uploads/banner/'.$banner->thumbnail)}}" width="150px" height="150px"/></td>
                        <td>{{ $banner->link }}</td>
                        <td>{{ $banner->location }}</td>
                        <td>{{ $banner->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="editbanner({{$banner->id}})" class="btn btn-info btn-circle" data-toggle="modal" data-target="#bannerEditModal">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="deletebanner({{$banner->id}})" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deletebannerModal">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php $stt++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Add Modal -->
<div class="modal fade" id="bannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom1">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('banner.createBanner') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image_upload">Ảnh bìa</label>
                        <input type="file" class="form-control" name="image_upload" />
                        @if($errors->has('image_upload'))
                        <span class="text-danger">{{$errors->first('image_upload')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" name="link" value="http://bookstoreproject.online/">
                    </div>
                    <div class="form-group">
                        <label for="location">Vị trí</label>
                        <select id="inputState" class="form-control" name="location">
                            <option selected>Chọn</option>
                            <option value="MAIN SLIDE">MAIN SLIDE</option>
                            <option value="Banner">Banner</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="bannerEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom1">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="categoryForm" action="{{ route('banner.updateBanner') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id" />
                    <div class="form-group">
                        <label for="image_upload">Ảnh bìa</label>
                        <input type="file" class="form-control" name="image_upload" />
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" name="link" id="link">
                    </div>
                    <div class="form-group">
                        <label for="location">Vị trí</label>
                        <select id="inputState" class="form-control" name="location">
                            <option selected>Chọn</option>
                            <option value="MAIN SLIDE">MAIN SLIDE</option>
                            <option value="Banner">Banner</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>
    function editbanner(id) {
        $.get("banner-show/" + id, function(banner) {
            $("#id").val(banner.id);
            $("#link").val(banner.link);
            $("#bannerEditModal").modal("toggle");
        });
    }
</script>
<!-- Delete Modal -->
<div class="modal fade" id="deletebannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn chắc chắn muốn xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form id="productEditForm" action="{{route('banner.deleteBanner')}}" method="POST">
                    @csrf
                    <input type="hidden" id="banner_id" name="banner_id" />
                    <button type="submit" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function deletebanner(id) {
        $("#banner_id").val(id);
    }
</script>
@endsection