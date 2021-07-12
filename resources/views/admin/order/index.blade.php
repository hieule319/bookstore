@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh mục sản phẩm</h6><br>
        <form action="{{ route('order.filter') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-1">
                    <div class="form-group">
                        <select class="form-control" name="status_order">
                            <option>Chọn</option>
                            <option value="0">Đang xử lý</option>
                            <option value="1">Đóng gói</option>
                            <option value="2">Giao hàng</option>
                            <option value="3">Đang vận chuyển</option>
                            <option value="4">Hoàn tất</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2"><button type="submit" class="btn btn-success">Lọc</button></div>
            </div>
        </form>
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
                        <th>Mã đơn hàng</th>
                        <th>Trạng thái</th>
                        <th>Thanh toán</th>
                        <th>Tổng tiền</th>
                        <th>Ngày giao</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Trạng thái</th>
                        <th>Thanh toán</th>
                        <th>Tổng tiền</th>
                        <th>Ngày giao</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $stt = 1 ?>
                    @foreach($orders as $key => $order)
                    <tr>
                        <td>{{ $stt }}</td>
                        <td>{{ $order->order_code }}</td>
                        <?php if ($order->status == 0) { ?>
                            <td><a onclick="return confirm('Chuyển đổi trạng thái ?')" href="{{URL::to('change-status/1/'.$order->order_code)}}">Đang chờ xử lý</a></td>
                        <?php } ?>
                        <?php if ($order->status == 1) { ?>
                            <td><a onclick="return confirm('Chuyển đổi trạng thái ?')" href="{{URL::to('change-status/2/'.$order->order_code)}}">Đóng gói</a></td>
                        <?php } ?>
                        <?php if ($order->status == 2) { ?>
                            <td><a onclick="return confirm('Chuyển đổi trạng thái ?')" href="{{URL::to('change-status/3/'.$order->order_code)}}">Giao hàng</a></td>
                        <?php } ?>
                        <?php if ($order->status == 3) { ?>
                            <td><a onclick="return confirm('Chuyển đổi trạng thái ?')" href="{{URL::to('change-status/4/'.$order->order_code)}}">Đang giao</a></td>
                        <?php } ?>
                        <?php if ($order->status == 4) { ?>
                            <td><a href="#"></a>Hoàn tất</td>
                        <?php } ?>
                        <?php if ($order->status == 5) { ?>
                            <td><a href="#"></a>Hàng bị trả</td>
                        <?php } ?>
                        <?php if ($order->payment == "cash") { ?>
                            <td>Tiền mặt</td>
                        <?php } ?>
                        <?php if ($order->payment == "paypal") { ?>
                            <td>Paypal</td>
                        <?php } ?>
                        <td>{{number_format($order->total, 0, '', ',')}}đ</td>
                        <?php if ($order->estimate_date != null) { ?>
                            <td>{{ date("d/m/Y", strtotime($order->estimate_date)) }}</td>
                        <?php } else { ?>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-info btn-circle" onclick="estimate_date({{$order->id}})" data-toggle="modal" data-target="#estimate_dateModal">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                        <?php } ?>
                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-info btn-circle" onclick="orderDetail({{$order->id}})" data-toggle="modal" data-target="#orderDetailModal">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a target="_blank" href="{{URL::to('print-order/'.$order->order_code)}}" class="btn btn-info btn-circle">
                                <i class="fa fa-print" aria-hidden="true"></i>
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


<!-- Modal -->
<div class="modal fade" id="estimate_dateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xem chi tiết đơn hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('estimate_date')}}" method="POST">
                    @csrf
                    <input type="hidden" id="order_id" name="order_id" />
                    <div class="form-group">
                        <label for="estimate_date">Ngày giao</label>
                        <input type="date" class="form-control" name="estimate_date" />
                    </div>
                    <button type="submit" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<script>
    function estimate_date(id) {
        $("#order_id").val(id);
    }
</script>
<!-- Modal -->
<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xem chi tiết đơn hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form action="{{route('order_detail')}}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id" />
                    <button type="submit" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function orderDetail(id) {
        $("#id").val(id);
    }
</script>
@endsection