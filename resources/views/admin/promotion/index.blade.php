@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Voucher</h6>
        <a href="#" class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#promotionModal">Thêm mới</a>
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
                        <th>Tên Voucher</th>
                        <th>Mã giảm gía</th>
                        <th>Chiết khấu</th>
                        <th>Áp dụng Cho</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Tên Voucher</th>
                        <th>Mã giảm gía</th>
                        <th>Chiết khấu</th>
                        <th>Áp dụng Cho</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Thao tác</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $stt = 1 ?>
                    @foreach($promotions as $key => $promotion)
                    <tr>
                        <td>{{ $stt }}</td>
                        <td>{{ $promotion->promotion_name }}</td>
                        <td>{{ $promotion->promotion_code }}</td>
                        <td>{{ $promotion->promotion_discount }} <strong>%</strong></td>
                        <td>{{ $promotion->condition }} <strong>đơn</strong></td>
                        <td>{{ date("d-m-Y",strtotime($promotion->start_date)) }}</td>
                        <td>{{ date("d-m-Y",strtotime($promotion->end_date)) }}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="editPromotion({{$promotion->id}})" class="btn btn-info btn-circle" data-toggle="modal" data-target="#promotionEditModal">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="deletePromotion({{$promotion->id}})" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deletePromotionModal">
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
<div class="modal fade" id="promotionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom1">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="categoryForm" action="{{ route('promotion.createPromotion') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="promotion_name">Tên Voucher</label>
                        <input type="text" class="form-control" name="promotion_name"/>
                        @if($errors->has('promotion_name'))
                        <span class="text-danger">{{$errors->first('promotion_name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="promotion_code">Mã giảm giá</label>
                        <input type="text" class="form-control" name="promotion_code">
                        @if($errors->has('promotion_code'))
                        <span class="text-danger">{{$errors->first('promotion_code')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="promotion_discount">Chiết khấu</label>
                        <input type="text" class="form-control" name="promotion_discount" placeholder="%">
                        @if($errors->has('promotion_discount'))
                        <span class="text-danger">{{$errors->first('promotion_discount')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="condition">Yêu cầu áp dụng</label>
                        <input type="text" class="form-control" name="condition" placeholder="đơn"> 
                    </div>
                    <div class="form-group">
                        <label for="start_date">Ngày bắt đầu</label>
                        <input type="date" class="form-control" name="start_date">
                        @if($errors->has('start_date'))
                        <span class="text-danger">{{$errors->first('start_date')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="end_date">Ngày kết thúc</label>
                        <input type="date" class="form-control" name="end_date">
                        @if($errors->has('end_date'))
                        <span class="text-danger">{{$errors->first('end_date')}}</span>
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
<div class="modal fade" id="promotionEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom1">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="categoryForm" action="{{ route('promotion.updatePromotion') }}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id"/>
                    <div class="form-group">
                        <label for="promotion_name">Tên Voucher</label>
                        <input type="text" class="form-control" name="promotion_name" id="promotion_name"/>
                        @if($errors->has('promotion_name'))
                        <span class="text-danger">{{$errors->first('promotion_name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="promotion_code">Mã giảm giá</label>
                        <input type="text" class="form-control" name="promotion_code" id="promotion_code">
                        @if($errors->has('promotion_code'))
                        <span class="text-danger">{{$errors->first('promotion_code')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="promotion_discount">Chiết khấu</label>
                        <input type="text" class="form-control" name="promotion_discount" id="promotion_discount" placeholder="%">
                        @if($errors->has('promotion_discount'))
                        <span class="text-danger">{{$errors->first('promotion_discount')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="condition">Yêu cầu áp dụng</label>
                        <input type="text" class="form-control" name="condition" id="condition" placeholder="đơn"> 
                    </div>
                    <div class="form-group">
                        <label for="start_date">Ngày bắt đầu</label>
                        <input type="date" class="form-control" name="start_date" id="start_date">
                        @if($errors->has('start_date'))
                        <span class="text-danger">{{$errors->first('start_date')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="end_date">Ngày kết thúc</label>
                        <input type="date" class="form-control" name="end_date" id="end_date">
                        @if($errors->has('end_date'))
                        <span class="text-danger">{{$errors->first('end_date')}}</span>
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
    function editPromotion(id) {
        $.get("promotion-show/" + id, function(promotion) {
            $("#id").val(promotion.id);
            $("#promotion_name").val(promotion.promotion_name);
            $("#promotion_code").val(promotion.promotion_code);
            $("#promotion_discount").val(promotion.promotion_discount);
            $("#condition").val(promotion.condition);
            $("#start_date").val(promotion.start_date);
            $("#end_date").val(promotion.end_date);
            $("#promotionEditModal").modal("toggle");
        });
    }
</script>
<!-- Delete Modal -->
<div class="modal fade" id="deletePromotionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn chắc chắn muốn xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form id="productEditForm" action="{{route('promotion.deletePromotion')}}" method="POST">
                    @csrf
                    <input type="hidden" id="promotion_id" name="promotion_id" />
                    <button type="submit" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function deletePromotion(id) {
        $("#promotion_id").val(id);
    }
</script>
@endsection