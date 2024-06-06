@extends('frontend.layout.main')
@section('content')
<section class="ptb-95">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8 pb-xs-60">
                <div class="blog-listing">
                    <h3 style="font-weight: 600;padding-bottom: 1.5rem;">{{ $getPostSlug->title_post }}</h3>
                    <div class="row">
                        <div class="col-xs-12">
                           {!! $getPostSlug->content_post !!}
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4">
                <div class="sidebar-block">
                    <div class="sidebar-box listing-box mb-40"> <span class="opener plus"></span>
                        <div class="sidebar-title">
                            <h3>Sản phẩm giảm giá</h3>
                        </div>
                        <div class="sidebar-contant">
                            <ul>
                                @foreach ($getProductSale as $value)
                                
                                <li><a href="{{ route('san-pham/').$value->slugUrlProduct }}/" style="display:flex;align-items:center;"><img width="50px" height="50px" style="object-fit:cover;" src="{{ BASE_URL.$value->imageDescribe }}" alt="">
                                  <p style="padding-left: 5px;">
                                  {{ $value->name_product }} <br>
                                  <span style="color:red;font-size: large;">{{ number_format(($value->price * (100 - $value->sale) / 100),0,',','.').'₫' }}</span>
                                </p></a></li>

                                 @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-box sidebar-item sidebar-item-wide"> <span class="opener plus"></span>
                        <div class="sidebar-title">
                            <h3>Bài đăng gần đây</h3>
                        </div>
                        <div class="sidebar-contant">
                            <ul>
                                @foreach ($postLimit as $key=>$value)
                                @if($key <= 10)
                                <li>
                                    <div class="pro-detail-info"> <a href="{{ route('bai-viet/').$value->slugUrl_post }}/">{{ $value->title_post }}</a>
                                    </div>
                                </li>
                                 @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection