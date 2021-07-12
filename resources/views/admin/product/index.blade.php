@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sản Phẩm</h6>
        <a href="{{ route('product.createProduct') }}" class="btn btn-success" style="float: right;">Thêm mới</a>
        <a href="{{ route('product.createProductCode') }}" class="btn btn-success" style="float: right;margin-right:5px">Tạo mã sản phẩm</a>
        <a href="#" class="btn btn-success" style="float: right;margin-right:5px" data-toggle="modal" data-target="#exprotProductV2">Danh sách mẫu</a>
        <a href="#" class="btn btn-success" style="float: right;margin-right:5px" data-toggle="modal" data-target="#importNewProduct">Nhập sản phẩm</a>
    </div>
    <div class="card-header py-3">
        <a href="#" class="btn btn-success" style="float: right;margin-right:5px" data-toggle="modal" data-target="#exportProduct">Xuất danh sách kho</a>
        <a href="#" class="btn btn-success" style="float: right;margin-right:5px" data-toggle="modal" data-target="#importProduct">Nhập kho</a>
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
                        <th>Tên Sản Phẩm</th>
                        <th>Trạng thái</th>
                        <th>Images</th>
                        <th>Giá gốc</th>
                        <th>Giá bán</th>
                        <th>Số lượng</th>
                        <th>Đơn vị tính</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Trạng thái</th>
                        <th>Images</th>
                        <th>Giá gốc</th>
                        <th>Giá bán</th>
                        <th>Số lượng</th>
                        <th>Đơn vị tính</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $stt = 1 ?>
                    @foreach($products as $key => $product)
                    <tr>
                        <td>{{ $stt }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>
                            <?php
                            if ($product->status == 0) {
                                $status = 1;
                            ?>
                                <a href="{{URL::to('product-status/'.$product->id.'/'.$status)}}"><strong class="text-success">Đang bán</strong></a>
                            <?php
                            } else {
                                $status = 0;

                            ?>
                                <a href="{{URL::to('product-status/'.$product->id.'/'.$status)}}"><strong class="text-danger">Ngưng bán</strong></a>
                            <?php } ?>

                        </td>
                        <td><img src="{{ asset('public/uploads/'.$product->thumbnail) }}" style="width:100px;height:100px;" /></td>
                        <td><?php echo number_format($product->product_price, 0, '', ','); ?> <strong>đ</strong></td>
                        <td><?php echo number_format($product->product_sell, 0, '', ','); ?> <strong>đ</strong></td>
                        <td>{{ $product->product_quantity }}</td>
                        <td>{{ $product->product_unit }}</td>
                        <td>{{ $product->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="editProduct({{$product->id}})" class="btn btn-info btn-circle" data-toggle="modal" data-target="#productEditModal">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="deleteProduct({{$product->id}})" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteProductModal">
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

<!-- Modal -->
<div class="modal fade" id="productEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn chỉnh sửa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form id="productEditForm" action="{{route('product.updateProduct')}}" method="POST">
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
    function editProduct(id) {
        $("#id").val(id);
    }
</script>
<!-- Delete Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn chắc chắn muốn xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form id="productEditForm" action="{{route('product.deleteProduct')}}" method="POST">
                    @csrf
                    <input type="hidden" id="product_id" name="product_id" />
                    <button type="submit" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteProduct(id) {
        $("#product_id").val(id);
    }
</script>

<!-- Export -->
<div class="modal fade" id="exportProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xuất danh sách</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form action="{{url('export-csv')}}" method="POST">
                    @csrf
                    <input type="submit" value="Export CSV" name="export_csv" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exprotProductV2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xuất danh sách</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form action="{{url('exportv2-csv')}}" method="POST">
                    @csrf
                    <input type="submit" value="Export CSV" name="export_csv" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Import -->
<div class="modal fade" id="importProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nhập hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form action="{{url('import-csv')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control-file" name="file_excel" accept=".xlsx"><br>
                    <input type="submit" value="Import CSV" name="import_csv" class="btn btn-warning">
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="importNewProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nhập hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form action="{{url('importnewProduct-csv')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control-file" name="excel_product" accept=".xlsx"><br>
                    <input type="submit" value="Import CSV" name="import_csv" class="btn btn-warning">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection