@extends('frontend.layout.main')
@section('title')
<title>Trang chủ</title>
@endsection
@section('content')
<section class="banner-contact">
      <div class="container">
        <div class="sub-banner-block center-xs">
          <div class="row mlr_-20">
            <div class="col-sm-8 plr-20">
              <div class="banner">
                <div class="main-banner" style="display:flex;">
                  <div class="item"> <img src="{{BASE_URL}}public/images/banner-gaming.jpg" alt="Honour">
                  </div>
                  <div class="item"><img src="{{BASE_URL}}public/images/banner-vp.jpg" alt="Honour"> 
                  </div>
                  <div class="item"> <img src="{{BASE_URL}}public/images/banner-vp1.jpg" alt="Honour">
                  </div>

                </div>
              </div>
            </div>

            <div class="col-sm-4 plr-20">
              <div class="sub-banner sub-banner1">
                <img src="https://wedo.vn/wp-content/uploads/2020/06/thiet-ke-van-phong-mo-1.jpg" alt="Honour">

              </div>
              <div class="subBanner sub-banner2">
                <img src="http://uniquedecor.com.vn/wp-content/uploads/2015/02/phong-lam-viec-nhan-vien.jpg"
                  alt="Honour">
              </div>
              <div class="subBanner sub-banner3">
                <div class="row row-link-contact">
                  @foreach ($postLimit as $key=>$value)
                  @if ($key <= 4)   
                  <div class="col-sm-12 post-item">
                    <a href="{{ route('bai-viet/').$value->slugUrl_post }}/">{{ $value->title_post }}</a>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--  Featured Products Slider Block Start  -->
     <section class="pt-95">
      <div class="container">
        <div class="product-slider">
          <div class="row">
            <div class="col-xs-12">
              <div class="heading-part align-center mb-40">
                <img src="https://noithatthienminh.vn/wp-content/uploads/2019/01/title.png" alt="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="pro_cat">
              <div id="data-step1" class="product-slider-main position-r" data-temp="tabdata">
                <div class="owl-carousel pro_cat_slider Related-Products">
                  @foreach ($getProductSale as $item)
           
                  <div class="item">
                    <div class="product-item">
                      <div class="sale-label"><span>{{ $item->sale }} %</span></div>
                      <div class="product-image"> <a href="{{ route('san-pham/').$item->slugUrlProduct }}/"> <img
                            src="{{ BASE_URL.$item->imageDescribe }}"
                            alt=""> </a>

                      </div>
                      <div class="product-item-details">
                        <div class="product-item-name"> <a href="{{ route('san-pham/').$item->slugUrlProduct }}/">{{ $item->name_product }}</a>
                        </div>
                        @if ($item->sale != 0)
                        <div class="price-box"> <span class="price">{{number_format(($item->price * (100 - $item->sale) / 100),0,',','.').'₫' }}</span> <del
                            class="price old-price">{{number_format($item->price,0,',','.') . '₫'}}</del></div>
                        @else
                        <div class="price-box"> 
                          <span class="price">{{number_format(($item->price),0,',','.').'₫' }}</span></div>
                        @endif
                        
                      </div>
                    </div>
                  </div>

                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
   @foreach ($array as $layout)
    @if ($layout->layoutType == 1)
    <!-- slideProduct -->
     @include('frontend.homelayout.slideLayout',['layout'=>$layout])
     
    @elseif($layout->layoutType == 2)
    @include('frontend.homelayout.listProduct',['layout'=>$layout])
    
    @else
    <!-- category and product -->
    @include('frontend.homelayout.category_product',['layout'=>$layout,'getCategory'=>$getCategory])
    
    @endif
    @endforeach
    <!-- post -->
    <section class="ptb-95">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="heading-part heading-part-bottom mb-40">
              <span class="main_title main_title_product">Tư vấn hướng dẫn</span>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($postLimit as $key=>$value)
          @if($key <= 5)
          <div class="large-columns-5 col-m col-xs-6 col-md-3 col-sm-4 large-columns-6">
            <div class="blog-item">
              <div class="blog-media">
                <div class="images-cover">
                  <img
                    src="{{ BASE_URL.$value->image_title }}"
                    alt="Honour"> <a href="{{ route('bai-viet/').$value->slugUrl_post }}/" title="Click For Read More" class="read">&nbsp;</a>
                </div>
              </div>
              <div class="blog-detail"> <span>{{ $value->date }}</span>
                <h3><a href="{{ route('bai-viet/').$value->slugUrl_post }}/">{{ $value->title_post }}</a></h3>
                <hr>
                <!-- <div class="post-info">
                  <ul>
                    <li><span>Bời</span><a href="#">Admin</a></li>
                  </ul>
                </div> -->
              </div>
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </section>

@endsection