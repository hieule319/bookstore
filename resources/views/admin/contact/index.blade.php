@extends('admin.home')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Mail</h6>
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
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Nội dung</th>
                        <th>Trạng thái</th>
                        <th>Ngày gửi</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Nội dung</th>
                        <th>Trạng thái</th>
                        <th>Ngày gửi</th>
                        <th>Thao tác</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $stt = 1 ?>
                    @foreach($contacts as $key => $contact)
                    <tr>
                        <td>{{ $stt }}</td>
                        <td>{{ $contact->fullname }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>0{{ $contact->phone }}</td>
                        <td>{{ $contact->content }}</td>
                        <?php if($contact->status == 0) {?>
                            <td style="color:red">Chưa đọc</td>
                        <?php } else { ?>
                            <td style="color:blue">Đã đọc</td>
                        <?php } ?>
                        <td>{{ $contact->created_at->format('d/m/Y s:i:H') }}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="sendMail({{$contact->id}})" class="btn btn-info btn-circle" data-toggle="modal" data-target="#contactModal">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="deletecontact({{$contact->id}})" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deletecontactModal">
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

<!-- Edit Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom1">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gửi phản hồi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="categoryForm" action="{{ route('contact.feedback') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id"/>
                    <div class="form-group">
                        <label for="promotion_name">Email</label>
                        <input type="text" class="form-control" name="email" id="email" />
                    </div>
                    <div class="form-group">
                        <label for="end_date">Nội dung</label>
                        <textarea class="form-control" name="content" ></textarea>
                        @if($errors->has('content'))
                        <span class="text-danger">{{$errors->first('content')}}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>
    function sendMail(id) {
        $.get("contact-show/" + id, function(conatct) {
            $("#id").val(id);
            $("#email").val(conatct.email);
            $("#contactModal").modal("toggle");
        });
    }
</script>
<!-- Delete Modal -->
<div class="modal fade" id="deletecontactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom2">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn chắc chắn muốn xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form action="{{route('contact.deleteContact')}}" method="POST">
                    @csrf
                    <input type="hidden" id="contact_id" name="contact_id" />
                    <button type="submit" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function deletecontact(id) {
        $("#contact_id").val(id);
    }
</script>
@endsection