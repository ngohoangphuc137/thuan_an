@extends('backend.layout.main')
@section('content')

<!-- phần page động -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sản phẩm</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Sản phẩm</li>
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
                    <div class="container-fluid card-header">
                        <!-- <button data-toggle="modal" data-target="#exampleModal">
                            Thêm danh mục
                        </button> -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Seo</th>
                                    <th>Danh mục</th>
                                    <th>Số lượng</th>
                                    <th>Ngày tạo</th>
                                    <th>Hoạt động</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listProduct as $value)
                                <tr id="box{{$value->id_product}}">
                                    <td>
                                        <p>{{ $loop->index + 1 }}</p>
                                    </td>
                                    <td><img class="rounded object-fit-cover" style="width:85px;"
                                            src="{{ BASE_URL.$value->imageDescribe }}" alt="IMAGE"></td>
                                    <td>{{ $value->name_product }}</td>
                                    <td>{{ number_format($value->price, 0, ',', '.') . 'đ' }}</td>
                                    <td>{{ $value->sale == 0 ? 'Không Sale' : $value->sale .'%' }}</td>
                                    <td>{{ $value->name_category }}</td>
                                    <td>{{ $value->quanity !== 0 ? 'Còn ' . $value->quanity . ' sản phẩn' : 'Hết hàng' }}
                                    </td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>
                                        <div class="btn-act">
                                            <a href="{{ route('admin/detail-Product/'.$value->slugUrlProduct).'/' }}">
                                                <button type="button" class="btn btn-outline-primary"><i
                                                        class="fas fa-edit"></i></button>
                                            </a>
                                            <button type="button" data-product="{{$value->id_product}}" class="btn btn-outline-danger deleteProduct"><i
                                                    class="far fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@include('backend/jquery/listProduct.php')
@endsection