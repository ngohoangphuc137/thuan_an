<section class="container-oustanding">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="newsletter">
          <div class="newsletter-inner">
            <h2 class="widgettitle">Danh mục</h2>
            <ul>
              @foreach ($getCategory as $value)
              @if($value->id_parent == 0)
              <li class="liCategoryome"><a class="a-categoryHome" href="{{ route('danh-muc/').$value->slugUrl }}/">{{ $value->name_category }}</a></li>
              @endif
              @endforeach
            </ul>
            <img style="padding-top:1.3rem;" src="{{ BASE_URL}}public/images/Group1.png" alt="">
          </div>
        </div>
      </div>
      <style>
        .widgettitle {
          display: block;
          text-align: center;
          background: #cd1818;
          border-bottom: 0;
          padding: 2.5px;
          font-size: 1.2em;
          color: #fff;
        }

        .liCategoryome {
          border-bottom: 1px solid #e0e0e0
        }

        .a-categoryHome {
          display: flex;
          align-items: start;
          padding: 0.5rem 0;
          font-size: 1.54rem;
          font-weight: 500;
        }
      </style>
      <div class="col-md-9 pb-sm-30">
        <div class="heading-part heading-part-bottom mb-40 mt-10">
          <span class="main_title main_title_product">{{ $layout->title }}</span>
        </div>
        <div class="product-listing newsletter">
          <div class="row-shop row">
            @foreach ($layout->getProductCategory as $item)

        <div class="itemProduct  col-m col-xs-6 col-md-3 col-sm-4">
          <div class="product-item">
          @if ($item->sale != 0)
        <div class="sale-label "><span>{{ $item->sale }} %</span></div>
      @endif
          <div class="product-image product-shop"> <a href="{{route('san-pham/') . $item->slugUrlProduct}}/"> <img
              class="image-productShop" src="{{ BASE_URL . $item->imageDescribe }}" alt=""> </a>

          </div>
          <div class="product-item-details">
            <div class="product-item-name"> <a
              href="{{route('san-pham/') . $item->slugUrlProduct}}/">{{ $item->name_product }}</a>
            </div>
            @if ($item->sale != 0)
        <div class="price-box"> <span
          class="price">{{number_format(($item->price * (100 - $item->sale) / 100), 0, ',', '.') . '₫' }}</span>
        <del class="price old-price">{{number_format($item->price, 0, ',', '.') . '₫'}}</del></div>
      @else
    <div class="price-box">
    <span class="price">{{number_format(($item->price), 0, ',', '.') . '₫' }}</span>
    </div>
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
</section>