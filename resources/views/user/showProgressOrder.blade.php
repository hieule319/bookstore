<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

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
    <div class="container px-1 px-md-4 py-5 mx-auto">
        <?php if (isset($not_exists)) { ?>
            <div class="alert alert-danger">
                {{ $not_exists }}
            </div>
        <?php } else { ?>
            <div class="card">
                <div class="row d-flex justify-content-between px-3 top">
                    <div class="d-flex">
                        <h5>Mã đơn hàng<span class="text-primary font-weight-bold">: {{ $data }}</span></h5>
                    </div>
                    <div class="d-flex flex-column text-sm-right">
                        <p class="mb-0">Ngày giao dự kiến<span>: {{$estimate_date}}</span></p>
                    </div>
                </div> <!-- Add class 'active' to progress -->
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <ul id="progressbar" class="text-center">
                            <?php if ($status == 0) { ?>
                                <li class="active step0"></li>
                                <li class="step0"></li>
                                <li class="step0"></li>
                                <li class="step0"></li>
                                <li class="step0"></li>
                            <?php } ?>
                            <?php if ($status == 1) { ?>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="step0"></li>
                                <li class="step0"></li>
                                <li class="step0"></li>
                            <?php } ?>
                            <?php if ($status == 2) { ?>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="step0"></li>
                                <li class="step0"></li>
                            <?php } ?>
                            <?php if ($status == 3) { ?>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="step0"></li>
                            <?php } ?>
                            <?php if ($status == 4) { ?>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                                <li class="active step0"></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="row justify-content-between top">
                    <div class="row d-flex icon-content"> <img class="icon" src="{{ asset('public/progress/9nnc9Et.png') }}">
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Order<br>Đang xử lý</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content"> <img class="icon" src="{{ asset('public/progress/GiWFtVu.png') }}">
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Order<br>Đóng gói</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content"> <img class="icon" src="{{ asset('public/progress/u1AzR7w.png') }}">
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Order<br>Giao hàng</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content"> <img class="icon" src="{{ asset('public/progress/TkPm63y.png') }}">
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Order<br>Trên đường giao</p>
                        </div>
                    </div>
                    <div class="row d-flex icon-content"> <img class="icon" src="{{ asset('public/progress/HdsziHP.png') }}">
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold">Order<br>Đã đến</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (isset($cancel) && $cancel == "cancel") { ?>
            <div class="card">
                <div class="row d-flex justify-content-between px-3 top">
                    <div class="d-flex">
                        <h6><span class="text-primary font-weight-bold">Quét hoặc nhấn vào hình để hủy đơn:</span></h6>
                    </div>
                    <div class="row d-flex justify-content-between px-3 top">
                        <div class="d-flex">
                            <a onclick="return confirm('Bạn có chắc chắn muốn hủy?')" href="http://bookstoreproject.online/cancel-order/{{ $data }}" style="float: left;"><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http://bookstoreproject.online/cancel-order/{{ $data }}" alt="qr-code"></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
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