@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Doanh thu</h6><br>
        <form action="{{ route('revenue.profit') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="date" class="form-control" name="start_date"/> 
                        @if($errors->has('start_date'))
                        <span class="text-danger">{{$errors->first('start_date')}}</span>
                        @endif
                        đến 
                        <input type="date" class="form-control" name="end_date"/>
                        @if($errors->has('end_date'))
                        <span class="text-danger">{{$errors->first('end_date')}}</span>
                        @endif
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
        <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Thu</th>
                        <th>Chi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection