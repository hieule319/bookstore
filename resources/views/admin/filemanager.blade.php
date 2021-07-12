@extends('admin.home')
@section('content')
<iframe src="{{url('public/filemanager/dialog.php')}}" style="width:100%; height:500px; overflow-y:auto; border:none;"></iframe>
@endsection