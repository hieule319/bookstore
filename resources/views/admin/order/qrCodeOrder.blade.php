<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <title>Progress Order</title>
    <link rel="icon" href="{{ asset('public/progress/favicon.ico') }}" type="image/x-icon" />
    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="{{ asset('public/admin/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('public/progress/style.css') }}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div class="container px-1 px-md-4 py-5 mx-auto">
        <div class="card">
            <div class="row d-flex justify-content-between px-3 top">
                <div class="d-flex">
                    <?php
                    if ($query == 1) {
                        $result = "Trạng thái đơn hàng: Đóng gói";
                    }
                    if ($query == 2) {
                        $result = "Trạng thái đơn hàng: Giao Hàng";
                    }
                    if ($query == 3) {
                        $result = "Trạng thái đơn hàng: Đang Vận Chuyển";
                    }
                    if ($query == 4) {
                        $result = "Trạng thái đơn hàng: Hoàn Tất";
                    }
                    if ($query == 5) {
                        $result = "Trạng thái đơn hàng: Đơn Hàng Bị Trả";
                    }
                    ?>
                    <h6><span class="text-primary font-weight-bold">{{$result}}</span></h6>
                </div>
            </div>
            @if(isset($order_code))
            <div class="row d-flex justify-content-between px-3 top">
                <div class="row d-flex justify-content-between px-3 top">
                    <div class="d-flex">
                        <form action="{{ route('order.return') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="promotion_name">Trả hàng</label>
                                <input type="text" class="form-control" name="return" placeholder="Nhập số 1 để trả hàng" />
                                <input type="hidden" class="form-control" name="order_code" value="{{$order_code}}" />
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('public/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('public/admin/js/sb-admin-2.min.js') }}"></script>
</body>

</html>