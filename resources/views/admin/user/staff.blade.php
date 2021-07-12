@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tài khoản Nhân viên</h6>
        <a href="{{ route('product.createProduct') }}" class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#staffModal">Thêm mới</a>
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
                        <th>Họ và Tên</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>Số điện thoại</th>
                        <th>Phân quyền</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Họ và Tên</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>Số điện thoại</th>
                        <th>Phân quyền</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $stt = 1 ?>
                    @foreach($staffs as $key => $staff)
                    <tr>
                        <td>{{ $stt }}</td>
                        <td>{{ $staff->fullname }}</td>
                        <td>{{ $staff->name }}</td>
                        <td>{{ $staff->email }}</td>
                        <td>{{ date("d-m-Y",strtotime($staff->birthday)) }}</td>
                        <td>0{{ $staff->phone }}</td>
                        <td>Nhân viên</td>
                        <td>{{ $staff->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="editStaff({{$staff->id}})" class="btn btn-info btn-circle" data-toggle="modal" data-target="#staffEditModal">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="deleteStaff({{$staff->id}})" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteStaffModal">
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
<div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom1">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.createStaff') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="fullname">Họ và tên</label>
                        <input type="text" class="form-control" name="fullname" />
                        @if($errors->has('fullname'))
                        <span class="text-danger">{{$errors->first('fullname')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name">UserName</label>
                        <input type="text" class="form-control" name="name">
                        @if($errors->has('name'))
                        <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password">
                        @if($errors->has('password'))
                        <span class="text-danger">{{$errors->first('password')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email">
                        @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" class="form-control" name="birthday">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" name="phone">
                        @if($errors->has('phone'))
                        <span class="text-danger">{{$errors->first('phone')}}</span>
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
<div class="modal fade" id="staffEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom1">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.updateStaff') }}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id"/>
                    <div class="form-group">
                        <label for="fullname">Họ và tên</label>
                        <input type="text" class="form-control" name="fullname" id="fullname" />
                        @if($errors->has('fullname'))
                        <span class="text-danger">{{$errors->first('fullname')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name">UserName</label>
                        <input type="text" class="form-control" name="name" id="name">
                        @if($errors->has('name'))
                        <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password">
                        @if($errors->has('password'))
                        <span class="text-danger">{{$errors->first('password')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email">
                        @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" class="form-control" name="birthday" id="birthday">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" name="phone" id="phone">
                        @if($errors->has('phone'))
                        <span class="text-danger">{{$errors->first('phone')}}</span>
                        @endif
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
    function editStaff(id) {
        $.get("staff-show/" + id, function(staff) {
            $("#id").val(staff.id);
            $("#fullname").val(staff.fullname);
            $("#name").val(staff.name);
            $("#email").val(staff.email);
            $("#birthday").val(staff.birthday);
            $("#phone").val(staff.phone);
            $("#staffEditModal").modal("toggle");
        });
    }
</script>
<!-- Delete Modal -->
<div class="modal fade" id="deleteStaffModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn chắc chắn muốn xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form action="{{route('user.delete')}}" method="POST">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" />
                    <button type="submit" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteStaff(id) {
        $("#user_id").val(id);
    }
</script>
@endsection