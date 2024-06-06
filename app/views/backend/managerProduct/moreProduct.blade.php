@extends('backend.layout.main')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Thêm sản phẩm</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin/product') }}">Home</a></li>
                    <li class="breadcrumb-item active">Thêm sản phảm</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->

<section class="content">
    <div class="container-fluid">
        <form id="formProduct">
            <div class="row">
                <!-- left column -->
                <div class="col-md-7">
                    <!-- general form elements -->
                    <div class="card secondary">
                        <div class="card-header">
                            <h3 class="card-title">Sản phẩm</h3>
                        </div>

                        <div class="card-body row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control form-control-border" id="nameProduct"
                                    name="nameProduct" placeholder="Tên sản phẩm">
                                   
                            </div>

                            <div class="form-group col-md-12">

                                <input type="text" class="form-control form-control-border" id="price" name="price"
                                    placeholder="Giá">
                                    
                            </div>


                            <div class="form-group col-md-6">

                                <input type="number" class="form-control form-control-border" id="quanity" min="1"
                                    name="quanity" placeholder="Số lượng">
                            </div>
                            <div class="form-group col-md-6">

                                <input type="number" class="form-control form-control-border" min="1" id="sale" name="sale"
                                    placeholder="Sale">
                            </div>

                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="imageDectibe[]"
                                                id="imageDectibe" multiple="multiple">
                                            <label class="custom-file-label" for="exampleInputFile">Ảnh mô
                                                tả(Chọn được nhiều ảnh)</label>
                                        </div>
                                    </div>
                                </div>  
                            </div>


                            <div class="form-group col-md-12">
                                <select class="form-control select2 select2-danger" id="menuProduct" name="menuProduct"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="0">Danh mục</option>
                                    @foreach($menuTree as $menu)
                                    <option value="{{ $menu['value'] }}">{{ $menu['text'] }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-md-5">
                    <!-- Form Element sizes -->
                    <div class="card secondary card">
                        <div class="card-header">
                            <h3 class="card-title">Thông số kỹ thuật(Không bắt buộc)</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body row" id="accordion">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control form-control-border specifications" id="height" name="height"
                                    placeholder="Cao">
                            </div>
                            <div class="form-group col-md-6">

                                <input type="text"
                                    class="form-control form-control-border specifications border-width-2" name="horizontal"
                                    id="horizontal" placeholder="Ngang">
                            </div>
                            <div class="form-group col-md-6">

                                <input type="text" class="form-control form-control-border specifications" id="deep" name="deep"
                                    placeholder="Sâu">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text"
                                    class="form-control form-control-border specifications border-width-2" id="color" name="color"
                                    placeholder="Màu sắc">
                            </div>

                            <div class="information-body row">
                                <div class="form-group col-md-12">
                                    <input type="text"
                                        class="form-control form-control-border specifications border-width-2 information-input"
                                        id="information1" name="information1" placeholder="Bổ sung thông số">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text"
                                        class="form-control form-control-border specifications border-width-2 information-input"
                                        id="information2" name="information2" placeholder="Bổ sung thông số">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text"
                                        class="form-control form-control-border specifications border-width-2 information-input"
                                        id="information3" name="information3" placeholder="Bổ sung thông số">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text"
                                        class="form-control form-control-border specifications border-width-2 information-input"
                                        id="information4" name="information4"placeholder="Bổ sung thông số">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <div class="col-md-12">
                    <textarea id="summernote" name="editordata"></textarea>
                </div>
            </div>
            <div class="pt-3 pb-2">
                <button type="button" class="btn btn-secondary rounded ResetForm">Reset</button>
                <button type="button" id="submitProduct" class="btn btn-primary rounded">Lưu</button>
            </div>
        </form>
    </div>
</section>

@include('backend/jquery/product.php')
@endsection