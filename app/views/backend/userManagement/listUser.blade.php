@extends('backend.layout.main')
@section('content')

<!-- phần page động -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Người dùng</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Người dùng</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example4" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên người dùng</th>
                                    <th>Địa chỉ email</th>
                                    <th>Vai trò</th>
                                    <th>Hoạt động</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listUser as $value)                          
                                    <tr id="box{{$value->id_user}}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $value->name_user }}</td>
                                        <td>{{ $value->Email }}</td>
                                        <td>
                                            @if ($value->role == 0)
                                                Khách hàng
                                            @else
                                                Admin
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" data-product="{{ $value->id_user }}"
                                                class="btn btn-outline-danger deleteUser"><i
                                                    class="far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>

</section>
<script>
    $(document).ready(function () {
        $('.deleteUser').on('click', function () {
            const idUser = $(this).attr('data-product')
            confirm("Bạn có chắc muốn xóa không !(Nếu xóa các mục liên quan tới người dùng này dùng này cũng bị xóa theo)")
                ? $.ajax({
                    url: `{{ route('deleteuser/') }}${idUser}`, 
                    method: 'post',
                    success: function () {
                        $(`#box${idUser}`).remove()
                    }
                })
                : ""

        })

    })
</script>
@endsection