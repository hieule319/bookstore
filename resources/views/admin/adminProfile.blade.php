@extends('admin.home')
<link href="{{ asset('public/admin/css/profile.css') }}" rel="stylesheet">
@section('content')
<div class="container bootstrap snippets bootdeys">
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
    @foreach($profile as $pro)
    <div class="row">
        <div class="col-xs-12 col-sm-9">
            <form class="form-horizontal" action="{{route('user.updateStaff')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <img src="{{ asset('public/uploads/user/'.$pro->avatar) }}" class="img-circle profile-avatar" alt="User avatar">
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Thông tin</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Ví trị</label>
                            <div class="col-sm-10">
                                <?php if ($pro->permission == 0) { ?>
                                    <input type="text" class="form-control" value="Admin">
                                <?php } else { ?>
                                    <input type="text" class="form-control" value="Nhân viên">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Thông tin liên lạc</h4>
                    </div>
                    <input type="hidden" name="id" value="{{$pro->id}}"/>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$pro->name}}" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Fullname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$pro->fullname}}" name="fullname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" value="{{ $pro->phone }}" name="phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" value="{{ $pro->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Avatar</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image_upload">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mật khẩu mới</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection