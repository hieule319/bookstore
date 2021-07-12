@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thể loại</h6>
        <a href="#" class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#categoryDetailModal">Thêm thể loại</a>
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
                        <th>Tên Thể Loại</th>
                        <th>Tên Danh Mục</th>
                        <th>Ngày tạo</th>
                        <th>Ngày Cập nhật</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Tên Thể Loại</th>
                        <th>Tên Danh Mục</th>
                        <th>Ngày tạo</th>
                        <th>Ngày Cập nhật</th>
                        <th>Thao tác</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $stt = 1 ?>
                    @foreach($category_details as $key => $category_detail)
                    <tr>
                        <td>{{ $stt }}</td>
                        <td>{{ $category_detail->category_detail_name }}</td>
                        <td>{{ $category_detail->category_name }}</td>
                        <td>{{ $category_detail->created_at }}</td>
                        <td>{{ $category_detail->updated_at }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-info btn-circle" onclick="editCategoryDetail({{$category_detail->id}})" data-toggle="modal" data-target="#categoryDetailEditModal">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{URL::to('category-detail-delete/'.$category_detail->id)}}" class="btn btn-danger btn-circle">
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
<div class="modal fade" id="categoryDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom1">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="categoryDetaiForm" action="{{ route('category_detail.create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="categorydetailname">Tên thể loại</label>
                        <input type="text" class="form-control" onkeyup="ChangeToSlug();" name="category_detail_name" id="slug" />
                        @if($errors->has('category_detail_name'))
                        <span class="text-danger">{{$errors->first('category_detail_name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <strong><label for="slug">Slug</label></strong>
                        <input type="text" class="form-control" id="convert_slug" name="slug" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Danh mục</label>
                        <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                            <option value="">Chọn</option>
                            @foreach($categories as $key => $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('category_id'))
                        <span class="text-danger">{{$errors->first('category_id')}}</span>
                        @endif
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
<div class="modal fade" id="categoryDetailEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom1">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="categoryDetailEditForm" action="{{route('category_detail.update')}}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id" />
                    <div class="form-group">
                        <label for="categorydetailname">Thể loại</label>
                        <input type="text" class="form-control category_detail_name" onkeyup="ChangeToSlug1();" id="slug1" name="category_detail_name" />
                        @if($errors->has('category_detail_name'))
                        <span class="text-danger">{{$errors->first('category_detail_name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <strong><label for="slug">Slug</label></strong>
                        <input type="text" class="form-control slug" id="convert_slug1" name="slug" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Danh mục</label>
                        <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                            <option id="category_name"></option>
                            @foreach($categories as $key => $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


<script>
    function editCategoryDetail(id) {
        $.get("category-detail-show/" + id, function(category_detail) {
            $("#id").val(category_detail.id);
            $(".category_detail_name").val(category_detail.category_detail_name);
            $(".slug").val(category_detail.slug);
            $('#category_name').text(category_detail.category_name);
            $("#categoryDetailEditModal").modal("toggle");
        });
    }
</script>
@endsection