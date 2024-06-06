@extends('frontend.layout.main')
@section('title')
<title>{{ $getIdCategory->name_category }}</title>
@endsection
@section('content')
<div class="banner align-center">
    <div class="pb-1">
        <nav style="text-align:left;">
            <a href="{{ route('') }}">Trang chủ</a>
            @foreach ($arrayNavMenu as $navMenu)
                {!! $navMenu !!}
            @endforeach
        </nav>
    </div>
    <img src="https://noithatthienminh.vn/wp-content/uploads/2018/11/banner-1.jpg" alt="">
</div>
<!-- BANNER END -->


<!-- CONTAIN START -->
<!-- <section class="ptb-95"> -->


<!-- CONTAIN START -->
<section class="mtb-40">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="shorting mb-30">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="view">

                            </div>


                        </div>
                      
                    </div>
                </div>
                <div class="product-listing">
                <div class="row-shop row">
                    @foreach ($getProductCategory as $item)
                        @if ($item->id_product != null)

                            <div class="itemProduct large-columns-5  col-m col-xs-6 col-md-3 col-sm-4">
                                <div class="product-item">
                                    @if ($item->sale != 0)
                                        <div class="sale-label "><span>{{ $item->sale }} %</span></div>
                                    @endif
                                    <div class="product-image product-shop"> <a
                                            href="{{route('san-pham/') . $item->slugUrlProduct }}/"> <img
                                                class="image-productShop" src="{{ BASE_URL . $item->imageDescribe }}" alt="">
                                        </a>

                                    </div>
                                    <div class="product-item-details">
                                        <div class="product-item-name"> <a
                                                href="{{route('san-pham/') . $item->slugUrlProduct }}/}}">{{ $item->name_product }}</a>
                                        </div>
                                        @if ($item->sale != 0)
                                            <div class="price-box"> <span
                                                    class="price">{{number_format(($item->price * (100 - $item->sale) / 100), 0, ',', '.') . '₫' }}</span>
                                                <del
                                                    class="price old-price">{{number_format($item->price, 0, ',', '.') . '₫'}}</del>
                                            </div>
                                        @else
                                            <div class="price-box">
                                                <span class="price">{{number_format(($item->price), 0, ',', '.') . '₫' }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row">
                   
                </div>
            </div>
            </div>
           
        </div>
    </div>
    </div>
</section>


@endsection