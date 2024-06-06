@extends('backend.layout.main')
@section('content')
<!-- Model specifications -->
<div class="modal fade" id="specifications" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-model-title">
                    <h5 class="modal-title" id="staticBackdropLabel">Thông số kỹ thuật
                    </h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 container-fluid">
                        <form id="formDataSpecifi">
                            <div class="product-detail-main">
                                <div class="product-item-details">
                                    <h1 class="product-item-name"></h1>
                                    <div class="rating-summary-block">

                                    </div>

                                    <div class="product-info-stock-sku">
                                        <table class="pt-5">
                                            <input type="hidden" class="form-control form-control-border"
                                                id="id_specificactions" name="id_specificactions">
                                            <input type="hidden" class="form-control form-control-border"
                                                id="id_product" name="id_product">
                                            <tr class="col trModel">
                                                <td class="col-6 colborder">Chiều cao</td>
                                                <td class="col-6">
                                                    <input type="text"
                                                        class="form-control form-control-border specifications"
                                                        id="height" name="height" placeholder="Trống">
                                                </td>
                                            </tr>
                                            <tr class="col trModel">
                                                <td class="col-6 colborder">Chiều ngang</td>
                                                <td class="col-6">
                                                    <input type="text"
                                                        class="form-control form-control-border specifications"
                                                        id="horizontal" name="horizontal" placeholder="Trống">
                                                </td>
                                            </tr>
                                            <tr class="col trModel">
                                                <td class="col-6 colborder">Chiều sâu</td>
                                                <td class="col-6">
                                                    <input type="text"
                                                        class="form-control form-control-border specifications"
                                                        id="deep" name="deep" placeholder="Trống">
                                                </td>
                                            </tr>
                                            <tr class="col trModel">
                                                <td class="col-6 colborder">Màu sắc</td>
                                                <td class="col-6">
                                                    <input type="text"
                                                        class="form-control form-control-border specifications"
                                                        id="color" name="color" placeholder="Trống">
                                                </td>
                                            </tr>

                                            <tr class="tr-infomation trModel">
                                                <td colspan="2">
                                                    <input type="text"
                                                        class="form-control form-control-border specifications"
                                                        id="information0" name="information1" placeholder="Trống">
                                                </td>
                                            </tr>
                                            <tr class="tr-infomation trModel">
                                                <td colspan="2">
                                                    <input type="text"
                                                        class="form-control form-control-border specifications"
                                                        id="information1" name="information2" placeholder="Trống">
                                                </td>
                                            </tr>
                                            <tr class="tr-infomation trModel">
                                                <td colspan="2">
                                                    <input type="text"
                                                        class="form-control form-control-border specifications"
                                                        id="information2" name="information3" placeholder="Trống">
                                                </td>
                                            </tr>
                                            <tr class="tr-infomation trModel">
                                                <td colspan="2">
                                                    <input type="text"
                                                        class="form-control form-control-border specifications"
                                                        id="information3" name="information4" placeholder="Trống">
                                                </td>
                                            </tr>

                                        </table>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modalfooter">
                <div class="refuse-to-act left">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                <div class="refuse-to-act right">
                    <button type="button" class="btn btn-primary updataSpes">Sửa thông số</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Model describe -->
<div class="modal fade" id="describe" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-model-title">
                    <h5 class="modal-title" id="staticBackdropLabel">Mô tả sản phẩm
                    </h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUpdataProduct">
                    <div class="card-body row">
                        <div class="form-group col-md-6">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" class="form-control form-control-border" id="nameProduct"
                                name="nameProduct">
                            <input type="hidden" class="form-control form-control-border" id="idProduct"
                                name="id_product">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">Giá</label>
                            <input type="text" class="form-control form-control-border" id="price" name="price">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">Số lượng</label>
                            <input type="number" class="form-control form-control-border" id="quanity" min="1"
                                name="quanity" placeholder="Số lượng">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">sale</label>
                            <input type="number" class="form-control form-control-border" min="1" id="sale" name="sale"
                                placeholder="Sale">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Danh mục</label>
                            <select class="form-control select2 select2-danger" id="menuProduct" name="menuProduct"
                                data-dropdown-css-class="select2-danger" style="width: 100%;">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <textarea id="editorProduct" name="editorProduct"></textarea>
                    </div>
                </form>
            </div>

            <div class="modalfooter">
                <div class="refuse-to-act left">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                <div class="refuse-to-act right">
                    <button type="button" class="btn btn-primary btn-updataDescribe">Sửa</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Model image -->
<div class="modal fade bd-example-modal-lg" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <form id="formImage">
                    <div class="container-model-title d-flex flex-wrap container">
                        <div class="d-flex">
                            <h5 class="modal-title" id="staticBackdropLabel">Kho ảnh sản phẩm |
                            </h5>
                            <h5 data-toggle="collapse" data-target="#collapseExample" aria-expanded="false">
                                Thêm ảnh</h5>
                        </div>
                        <div class="input-more-images collapse" id="collapseExample">
                            <input type="hidden" name="IdProduct" value="{{$getProductSlug->id_product}}">
                            <input type="file" name="imagesProduct[]" multiple>
                        </div>
                    </div>
                </form>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="d-flex flex-wrap justify-content-between" id="ulImages">

                </ul>
            </div>

            <div class="modalfooter">
                <div class="refuse-to-act left">
                    <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                </div>
                <div class="refuse-to-act right">
                    <button type="button" id="btn-delete" class="btn btn-primary">Xóa ảnh </button>
                    <button type="button" class="btn btn-primary" id="btn-MoreImage">Thêm ảnh</button>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Chi tiết sản phẩm</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin/product')}}">Home</a></li>
                    <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
                </ol>
            </div>
        </div>

        <div class="work">
            <!-- Single button -->
            <!-- Example single danger button -->
            <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    menu
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" data-toggle="modal" data-target="#staticBackdrop">Kho ảnh</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#specifications" href="#">Thông số kỹ
                        thuật</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#describe" href="#">Mô tả sản phẩm</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>




        </div>

    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="main">
        <!-- CONTAIN START -->
        <section class="pt-95">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-5 mb-xs-30">
                        <div class="fotoramaImage" data-nav="thumbs" data-thumbwidth="55" data-thumbheight="80"
                            data-maxheight="400">
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-6">
                        <div class="row">
                            <div class="col-xs-12 container-fluid">
                                <form action="" method="post">
                                    <div class="product-detail-main">
                                        <div class="product-item-details">
                                            <h1 class="product-item-name"></h1>
                                            <div class="price-box py-2" id="price-box">

                                                <span class="price"></span>
                                                <del class="old-price"
                                                    style="font-size: 14px;font-weight: 400;color: #b9a06f;"></del>

                                            </div>
                                            <div class="price-box d-flex" id="categoryProduct">
                                                <span>Danh mục:
                                                </span>
                                                <p></p>
                                            </div>
                                            <div class="product-info-stock-sku">
                                                <table class="pt-5" id="tableSpes">


                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="ptb-95">
            <div class="container">
                <div class="product-detail-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="tabs">
                                <ul class="nav nav-tabs" onclick="transition(event)">
                                    <li><a class="tab-item tab-Description selected" title="Description">Mô tả sản
                                            phẩm</a>
                                    </li>

                                    </li>
                                    <li><a class="tab-item tab-Reviews" title="Reviews">Bình luận</a></li>
                                </ul>
                            </div>
                            <div id="items">
                                <div class="tab_content">
                                    <ul>
                                        <li>
                                            <div class="items-Description selected gray-bg">
                                                <div class="Description">

                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="items-Reviews gray-bg">
                                                <div class="comments-area">
                                                  
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- CONTAINER END -->

        <!-- FOOTER START -->

        <!-- FOOTER END -->
    </div>
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@include('backend/jquery/detailProduct.php')
@endsection
