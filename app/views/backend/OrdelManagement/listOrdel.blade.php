@extends('backend.layout.main')
@section('content')

<!-- phần page động -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Đơn hàng</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Đơn hàng</li>
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
                                    <th>Người nhận</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ nhận</th>
                                    <th>Tổng số tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getallOrdel as $value)

                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $value->receiver }}</td>
                                        <td>{{ $value->phone_number }}</td>
                                        <td>{{ $value->addrest }}</td>
                                        <td>{{ number_format($value->total, 0, ',', '.') . 'đ' }}</td>
                                        <td>
                                            @if ($value->status == 1)
                                                Chờ xác nhận
                                            @elseif($value->status == 2)
                                                Đã xác nhận
                                            @elseif($value->status == 3)
                                               Đang giao
                                            @elseif($value->status == 4)
                                               Giao thành công                                       
                                            @else
                                                Đơn hàng đã hủy
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-act">
                                                <a
                                                    href="{{ route('admin/hoa-don/'.$value->id_order) }}">
                                                    <button type="button" class="btn btn-outline-primary"><i
                                                            class="fas fa-edit"></i></button>
                                                </a>
                                                <a href="{{ route('delete-invoice/'.$value->id_order) }}">
                                                <button type="button" data-product="2"
                                                    class="btn btn-outline-danger deleteProduct"><i
                                                        class="far fa-trash-alt"></i></button>
                                                        </a>
                                            </div>
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
@endsection