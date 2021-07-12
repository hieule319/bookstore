@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách nhập kho</h6>
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
                        <th>Tên sản phẩm</th>
                        <th>Mã sản phẩm</th>
                        <th>Giá gốc</th>
                        <th>Số lượng</th>
                        <th>Tổng giá nhập</th>
                        <th>Ngày nhập</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Mã sản phẩm</th>
                        <th>Giá gốc</th>
                        <th>Số lượng</th>
                        <th>Tổng giá nhập</th>
                        <th>Ngày nhập</th>
                        <th>Thao tác</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $stt = 1 ?>
                    @foreach($inventories as $inventory)
                    <tr>
                        <td>{{ $stt }}</td>
                        <td>{{ $inventory->product_name }}</td>
                        <td>{{ $inventory->product_qrcode }}</td>
                        <td>{{ $inventory->product_price }}</td>
                        <td>{{ $inventory->product_quantity }}</td>
                        <td>{{ $inventory->total_price }}</td>
                        <td>{{ $inventory->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="deleteinventory({{$inventory->id}})" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteinventoryModal">
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
@endsection