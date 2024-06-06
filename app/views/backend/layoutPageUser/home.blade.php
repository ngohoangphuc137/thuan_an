@extends('backend.layout.main')
@section('content')

<!-- phần page động -->
<!-- model inser -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="insertLayout" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm giao diện trang chủ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="exampleFormControlSelect1">Tên tiêu đề(theo danh mục)</label>
                            <select class="form-control" name="categoryId" id="nameTitle">
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="exampleFormControlSelect1">Số sản phẩm hiển thị</label>
                            <input type="number" class="form-control" name="numberProductShow" value="1"
                                id="numberProductShow" min="1">
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="exampleFormControlSelect1">Kiểu giao diện hiển thị</label>
                            <select class="form-control" name="interfaceType" id="interfaceType">
                                <option value="1">Thanh trượt sản phẩm</option>
                                <option value="2">Danh sách sản phẩm</option>
                                <option value="3">Danh mục và danh sách sản phẩm</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-moreLayout">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- model updata -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updataLayoutHome">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa giao diện trang chủ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-sm-12">
                        <label for="recipient-name" class="col-form-label">Tên sản phẩm: <span
                                class="titleLayout"></span></label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="recipient-name" class="col-form-label">Số sản phẩm hiển thị</label>
                        <input type="hidden" class="form-control" name="idLayout" id="idLayout">
                        <input type="number" class="form-control" name="updataNumberProduct" id="updataNumberProduct">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="exampleFormControlSelect1">Kiểu giao diện hiển thị</label>
                        <select class="form-control" name="updataInterfaceType" id="updataInterfaceType">
                            <option value="1">Thanh trượt sản phẩm</option>
                            <option value="2">Danh sách sản phẩm</option>
                            <option value="3">Danh mục và danh sách sản phẩm</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-updataLayout">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Home user</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">layout home</li>
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
                    <div class="ccontainer-fluid card-header card-category">
                        <button data-toggle="modal" data-target=".bd-example-modal-lg">
                            Thêm giao diện
                        </button>
                        <button class="ml-1 py-1" id="saveLayout">
                            Lưu thay đổi
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example3" class="tableLayout table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Số lượng hiển thị</th>
                                    <th>Bố cục sản phẩm</th>
                                    <th>Thứ tự thực hiện</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody id="sortable">


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
@include('backend/jquery/homeLayoutUser.php')
<script>
    $(function () {
        $("#sortable").sortable();
    });
</script>
@endsection