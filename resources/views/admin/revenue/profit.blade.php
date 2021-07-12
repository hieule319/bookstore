@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Doanh thu</h6><br>
        <a href="{{route('revenue')}}" class="btn btn-success" style="float: left;">Trở về</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Chi</th>
                        <th>Thu</th>
                        <th>Lợi nhuận trước thuế</th>
                        <th>Lợi nhuận sau thuế</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{number_format($pay, 0, '', ',')}} đ</td>
                        <td>{{number_format($revenue, 0, '', ',')}} đ</td>
                        <td>{{number_format($profit, 0, '', ',')}} đ</td>
                        <?php $profit_v2 = ($profit * 10)/100 ?>
                        <td>{{number_format($profit_v2, 0, '', ',')}} đ</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection