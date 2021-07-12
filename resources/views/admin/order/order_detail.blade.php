@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Chi tiết hóa đơn</h6>
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
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Ngày tạo</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $stt = 1 ?>
                    @foreach($order_details as $key => $order_detail)
                    <tr>
                        <td>{{ $stt }}</td>
                        <td>{{ $order_detail->product_name }}</td>
                        <td>{{number_format($order_detail->product_price, 0, '', ',')}}đ</td>
                        <td>{{ $order_detail->quantity }}</td>
                        <td>{{number_format($order_detail->subtotal, 0, '', ',')}}đ</td>
                        <td>{{ $order_detail->created_at->format('d/m/Y') }}</td>
                    </tr>
                    <?php $stt++ ?>
                    @endforeach
                </tbody>
            </table><br>
            <a href="{{route('order.index')}}" class="btn btn-success">Trở về</a>
        </div>
    </div>
</div>
@endsection