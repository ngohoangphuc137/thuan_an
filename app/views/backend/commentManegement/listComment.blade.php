@extends('backend.layout.main')
@section('content')

<!-- phần page động -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Bình luận</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Bình luận</li>
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
                                    <th>Ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Tổng bình luận</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getproductComment as $key=>$value)
                                    <tr>
                                        <td>{{ $loop->index + 1}}</td>
                                        <td style="text-align: center;"><img class="rounded object-fit-cover"
                                                style="width:85px;" src="{{ BASE_URL . $GroupByImageProduct[$key]->imageDescribe }}"
                                                alt="IMAGE"></td>
                                        <td>{{ $value->name_product }}</td>
                                        <td>{{ $value->total }} bình luận</td>
                                        <td>
                                            <div class="btn-act">
                                                <a
                                                    href="{{ route('binh-luan-san-pham/'.$value->slugUrlProduct).'/' }}">
                                                    <button type="button" class="btn btn-outline-primary"><i
                                                            class="fas fa-edit"></i></button>
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