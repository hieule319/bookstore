<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>
    <link rel="icon" href="{{ asset('public/admin/img/favicon.ico') }}" type="image/x-icon" />
    <!-- Custom fonts for this template-->
    <link href="{{ asset('public/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('public/admin/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('public/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Loading page -->
    <!-- <link href="{{ asset('public/admin/css/loading.css') }}" rel="stylesheet" type="text/css"> -->
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ session('UserName') }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="home">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Quản Lý
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php if (session()->has('permission') && session('permission') == 0) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Sản Phẩm - Danh Mục</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('product.index') }}">Sản Phẩm</a>
                            <a class="collapse-item" href="{{ route('category.index') }}">Danh Mục Sản Phẩm</a>
                            <a class="collapse-item" href="{{ route('category_detail.index') }}">Thể Loại</a>
                            <a class="collapse-item" href="{{ route('publisher.index') }}">Nhà xuất bản</a>
                            <a class="collapse-item" href="{{ route('unit.index') }}">Đơn vị tính</a>
                            <a class="collapse-item" href="{{ route('inventory.list') }}">Danh sách nhập kho</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span>Đơn hàng - Danh Mục</span>
                </a>
                <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('order.index') }}">Đơn hàng</a>
                        <a class="collapse-item" href="{{ route('promotion.index') }}">Voucher</a>
                    </div>
                </div>
            </li>
            <?php if (session()->has('permission') && session('permission') == 0) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>Quản lí tài khoản</span>
                    </a>
                    <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('user.staff') }}">Nhân viên</a>
                            <a class="collapse-item" href="{{ route('user.customer') }}">Khách hàng</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Cài đặt</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Cài đặt</h6>
                            <a class="collapse-item" href="{{ route('filemanager.index') }}">File Manager</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('revenue')}}">
                        <i class="fas fa-dollar-sign"></i>
                        <span>Doanh thu</span></a>
                </li>
                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact.list')}}">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span>Thư</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('banner.list')}}">
                        <i class="fa fa-file-image" aria-hidden="true"></i>
                        <span>Banner</span></a>
                </li>
            <?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session('UserName') }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('public/uploads/user/'.session('avatar')) }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('admin.profile')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                
                <!-- /.container-fluid -->
                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-custom1" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('public/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('public/admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <!-- <script src="{{ asset('public/admin/vendor/chart.js/Chart.min.js') }}"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('public/admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('public/admin/js/demo/chart-pie-demo.js') }}"></script> -->

    <!-- Page level plugins -->
    <script src="{{ asset('public/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('public/admin/js/demo/datatables-demo.js') }}"></script>

    <!-- progress custom scripts -->
    <script src="{{ asset('public/admin/js/progress.js') }}"></script>

    <!-- ckeditor custom scripts -->
    <script src="{{ asset('public/admin/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('product_description');
    </script>
    <!-- Create product custom scripts -->
    <script>
        $('#primaryImagesModal').on('hide.bs.modal', function() {
            var _link = $('input#thumbnail').val();
            var _img = "{{url('public/uploads')}}" + '/' + _link;
            $('img#show_img').attr('src', _img)
        })
    </script>
    <script>
        $('#listImagesModal').on('hide.bs.modal', function() {
            var _links = $('input#list_thumbnail').val();
            var _html = '';
            if (/^[\],:{}\s]*$/.test(_links.replace(/\\["\\\/bfnrtu]/g, '@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
                var _args = $.parseJSON(_links);
                for (let i = 0; i < _args.length; i++) {
                    let _url = "{{url('public/uploads')}}" + '/' + _args[i];
                    _html += '<div class="form-group col-md-1">';
                    _html += '<img src="' + _url + '" style="width:100%" class="rounded"/>';
                    _html += '</div>';
                }
            } else {
                let _url = "{{url('public/uploads')}}" + '/' + _links;
                _html += '<div class="form-group col-md-1">';
                _html += '<img src="' + _url + '" style="width:100%" class="rounded"/>';
                _html += '</div>';
            }
            $('#show_list_thumbnail').html(_html);
        })
    </script>
    <!-- Create product custom scripts -->
    <script>
        $('#images1Modal').on('hide.bs.modal', function() {
            var _link1 = $('input#thumbnail1').val();
            var _img1 = "{{url('public/uploads')}}" + '/' + _link1;
            $('img#show_img1').attr('src', _img1)
        })
    </script>
    <script>
        $('#images2Modal').on('hide.bs.modal', function() {
            var _link2 = $('input#thumbnail2').val();
            var _img2 = "{{url('public/uploads')}}" + '/' + _link2;
            $('img#show_img2').attr('src', _img2)
        })
    </script>
    <script>
        $('#images3Modal').on('hide.bs.modal', function() {
            var _link3 = $('input#thumbnail3').val();
            var _img3 = "{{url('public/uploads')}}" + '/' + _link3;
            $('img#show_img3').attr('src', _img3)
        })
    </script>
    <script>
        $('#images4Modal').on('hide.bs.modal', function() {
            var _link4 = $('input#thumbnail4').val();
            var _img4 = "{{url('public/uploads')}}" + '/' + _link4;
            $('img#show_img4').attr('src', _img4)
        })
    </script>
    <script>
        $('#images5Modal').on('hide.bs.modal', function() {
            var _link5 = $('input#thumbnail5').val();
            var _img5 = "{{url('public/uploads')}}" + '/' + _link5;
            $('img#show_img5').attr('src', _img5)
        })
    </script>
</body>

</html>