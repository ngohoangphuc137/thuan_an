@extends('backend.layout.main')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid border-top">
        <!-- Main row -->
        <form action="{{ route('insertPost') }}" method="post" enctype="multipart/form-data">
            <div class="row mt-3">
                <!-- Left col -->
                <section class="col-lg-9 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="input-group mb-4 title-post">
                        <input type="text" class="form-control" placeholder="Thêm tiêu đề"
                            aria-label="Recipient's username" name="title_post" aria-describedby="basic-addon2">
                    </div>

                    <textarea id="summernote-post" name="summernote-post"></textarea>

                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-3 connectedSortable">

                    <!-- solid sales graph -->
                    <div class="card" style="border-radius:0;">
                        <div class="postbox-header">
                            <p class="card-title">
                                Đăng
                            </p>

                            <div class="card-tools">
                                <button type="button" class="btn btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- CONTENT -->

                        </div>
                        <div class="footer-addPost">
                            <button type="submit" name="btn-morePost" class="btn btn-primary float-right">
                                Đăng
                            </button>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->

                    <!-- Calendar -->
                    <div class="card" style="border-radius:0;">
                        <div class="postbox-header">

                            <p class="card-title">
                                Ảnh đại diện
                            </p>
                            <!-- tools card -->
                            <div class="card-tools">
                                <!-- button with a dropdown -->
                                <button type="button" class="btn  btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn  btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                            <div class="inside">
                                <div id="image-div"><img class="" src="" alt=""></div>
                                <input type="file" name="file-image" id="file-image" style="display:none;">
                                <p class="hide-if-no-js">
                                    <a class="Avatar-post">Đặt ảnh đại diện</a>
                                </p>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- right col -->
            </div>
        </form>
    </div>
</section>
<!-- /.content -->
@include('backend/jquery/post.php')
@endsection