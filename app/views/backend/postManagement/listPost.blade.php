@extends('backend.layout.main')
@section('content')
<!-- phần page động -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Bài viết</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Bài viết</li>
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
                        <table id="example5" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Tiêu đề</th>
                                    <th>Thời gian</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($arrayPost as $value)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><img width="85px" src="{{ BASE_URL . $value->image_title }}" alt=""></td>
                                        <td>{{ $value->title_post }}</td>
                                        <td>Đã xuất bản <br>{{ $value->date . ' ' . $value->time }}<br>{{ $value->moment }}
                                        </td>
                                        <td>
                                            <div class="btn-act">
                                                <a
                                                    href="{{ route('admin/editPost/').$value->id_post }}">
                                                    <button type="button" class="btn btn-outline-primary"><i
                                                            class="fas fa-edit"></i></button>
                                                </a>
                                                <a href="{{ route('deletePost/').$value->id_post }}">
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