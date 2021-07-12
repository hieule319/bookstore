@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nhà xuất bản</h6>
        <a href="#" class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#publisherModal">Thêm mới</a>
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
                        <th>Nhà xuất bản</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Số Fax</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Nhà xuất bản</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Số Fax</th>
                        <th>Thao tác</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $stt = 1 ?>
                    @foreach($publishers as $key => $publisher)
                    <tr>
                        <td>{{ $stt }}</td>
                        <td>{{ $publisher->publisher_name }}</td>
                        <td>{{ $publisher->publisher_address }}</td>
                        <td>{{ $publisher->publisher_phone }}</td>
                        <td>{{ $publisher->publisher_email }}</td>
                        <td>{{ $publisher->publisher_fax }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-info btn-circle" onclick="editPublisher({{$publisher->id}})" data-toggle="modal" data-target="#publisherEditModal">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{URL::to('publisher-delete/'.$publisher->id)}}" class="btn btn-danger btn-circle">
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
<div class="modal fade" id="publisherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom1">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="publisherForm" action="{{ route('publisher.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="publisher_name">Tên nhà xuất bản</label>
                        <input type="text" class="form-control" id="publisher_name" name="publisher_name" />
                        @if($errors->has('publisher_name'))
                        <span class="text-danger">{{$errors->first('publisher_name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="publisher_address">Địa chỉ</label>
                        <input type="text" class="form-control" id="publisher_address" name="publisher_address" />
                    </div>
                    <div class="form-group">
                        <label for="publisher_phone">Số điện thoại</label>
                        <input type="text" class="form-control" id="publisher_phone" name="publisher_phone" />
                    </div>
                    <div class="form-group">
                        <label for="publisher_email">Email</label>
                        <input type="email" class="form-control" id="publisher_email" name="publisher_email" />
                        @if($errors->has('publisher_email'))
                        <span class="text-danger">{{$errors->first('publisher_email')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="publisher_fax">Số Fax</label>
                        <input type="text" class="form-control" id="publisher_fax" name="publisher_fax" />
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
<div class="modal fade" id="publisherEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom1">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="publisherEditForm" action="{{route('publisher.update')}}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id" />
                    <div class="form-group">
                        <label for="publisher_name">Tên nhà xuất bản</label>
                        <input type="text" class="form-control" id="publisher_name_edit" name="publisher_name" />
                        @if($errors->has('publisher_name'))
                        <span class="text-danger">{{$errors->first('publisher_name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="publisher_address">Địa chỉ</label>
                        <input type="text" class="form-control" id="publisher_address_edit" name="publisher_address" />
                    </div>
                    <div class="form-group">
                        <label for="publisher_phone">Số điện thoại</label>
                        <input type="number" class="form-control" id="publisher_phone_edit" name="publisher_phone" />
                    </div>
                    <div class="form-group">
                        <label for="publisher_email">Email</label>
                        <input type="text" class="form-control" id="publisher_email_edit" name="publisher_email" />
                    </div>
                    <div class="form-group">
                        <label for="publisher_fax">Số Fax</label>
                        <input type="text" class="form-control" id="publisher_fax_edit" name="publisher_fax" />
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
    function editPublisher(id) {
        $.get("publisher-show/" + id, function(publisher) {
            $("#id").val(publisher.id);
            $("#publisher_name_edit").val(publisher.publisher_name);
            $("#publisher_address_edit").val(publisher.publisher_address);
            $("#publisher_phone_edit").val(publisher.publisher_phone);
            $("#publisher_email_edit").val(publisher.publisher_email);
            $("#publisher_fax_edit").val(publisher.publisher_fax);
            $("#publisherEditModal").modal("toggle");
        });
    }
</script>
@endsection