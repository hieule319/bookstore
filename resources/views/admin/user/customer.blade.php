@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tài khoản Khách Hàng</h6>
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
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $stt = 1 ?>
                    @foreach($customers as $key => $customer)
                    <tr>
                        <td>{{ $stt }}</td>
                        <td>{{ $customer->fullname }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ date("d-m-Y",strtotime($customer->birthday)) }}</td>
                        <td>0{{ $customer->phone }}</td>
                        <td>{{ $customer->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="deleteCustomer({{$customer->id}})" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteCustomerModal">
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
<!-- Delete Modal -->
<div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    function deleteCustomer(id) {
        $("#user_id").val(id);
    }
</script>
@endsection