@extends('backend.layout.main')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h3>Bình luận sản phẩm:{{ $getProductSlugUrl->name_product }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin/comment') }}">Home</a></li>
                    <li class="breadcrumb-item active">Bình luận</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="ptb-95">
    <div class="container">
        <div class="product-detail-tab">
            <div class="row">
                <div class="col-md-12">
                    
                    <div id="items" style="border: 1px solid #e1e1e1">
                        <div class="tab_content">
                            <ul>
                                <li>
                                    <div class="">
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
@include('backend/jquery/comment.php')
@endsection