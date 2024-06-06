<section class="pt-95">
      <div class="container">
      <div class="product-slider">
        <div class="row">
          <div class="col-md-12 col-sm-12 mt-30">
            <div class="heading-part heading-part-bottom mb-40">
              <span class="main_title main_title_product">{{ $layout->title }}</span>
            </div>
            <div class="product-listing">
              <div class="row-shop row">
             @foreach ($layout->getProductCategory as $item)
            
                <div class="itemProduct large-columns-5  col-m col-xs-6 col-md-3 col-sm-4">
                  <div class="product-item">
                    @if ($item->sale != 0)               
                    <div class="sale-label "><span>{{ $item->sale }} %</span></div> 
                    @endif
                    <div class="product-image product-shop"> <a href="{{route('san-pham/').$item->slugUrlProduct}}/"> <img class="image-productShop"
                          src="{{ BASE_URL.$item->imageDescribe }}" alt=""> </a>

                    </div>
                    <div class="product-item-details">
                      <div class="product-item-name"> <a href="{{route('san-pham/').$item->slugUrlProduct}}/">{{ $item->name_product }}</a>
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