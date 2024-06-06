<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from webcotheme.com/honour/demo2/hon001/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 Nov 2023 08:26:34 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->


<head>
  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  @yield('title')
  <!-- <title>Honour Index</title> -->
  <!-- SEO Meta
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="distribution" content="global">
  <meta name="revisit-after" content="2 Days">
  <meta name="robots" content="ALL">
  <meta name="rating" content="8 YEARS">
  <meta name="Language" content="en-us">
  <meta name="GOOGLEBOT" content="NOARCHIVE">
  <!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- CSS
  ================================================== -->
  <link rel="stylesheet" href="css/style.css">
  @include('frontend.layout.linkcss')
 
</head>
<body>
  <div id="newslater-popup" class="mfp-hide white-popup-block open align-center">
  </div>
  @include('frontend.layout.menu')

  <div class="main">


   @yield('content')

  
    <!-- Brand logo block Start  -->
    <!-- Brand logo block End  -->

    <!-- CONTAINER END -->

    <!-- FOOTER START -->
    <div class="footer dark-bg">
      <div class="container">
        <div class="footer-inner">
          <div class="footer-top">
            <div class="row">
              <div class="col-md-8">
                <div class="f-logo left-side"> <a href="index.php"><img style="max-width: 193px;" src="{{ BASE_URL }}public/images/logothuanan.png" alt="Honour">
                  </a> </div>
                <p>Thuận an nơi cung cấp các mẫu bàn ghế chất lượng và uy tín và luôn hướng tới những trải nghiệm tốt nhất tới mọi khách hàng</p>
              </div>
              <div class="col-md-4">
                <div class="footer_social right-side float-none-sm pt-sm-15 center-sm mt-sm-15">
                  <ul class="social-icon">
                    <li><a title="Facebook" class="facebook"><i class='bx bxl-facebook-circle'></i></a></li>
                    <li><a href="https://www.tiktok.com/@i.thy20" title="tiktok" class="tiktok"><i class='bx bxl-tiktok' ></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="footer-middle">
            <div class="row">
              <div class="col-md-3 f-col">
                <div class="footer-static-block"> <span class="opener plus"></span>
                  <h3 class="title">Địa chỉ</h3>
                  <ul class="footer-block-contant address-footer">
                    <li class="item"> <i class="fa fa-map-marker"> </i>
                      <p>Phú Minh - Sóc Sơn - Hà Nội</p>
                      <hr>
                    </li>
                    <li class="item"> <i class="fa fa-envelope-o"> </i>
                      <p> <a>Zalo: 0982717161</a> </p>
                      <hr>
                    </li>
                    <li class="item"> <i class="fa fa-phone"> </i>
                      <p>Điện Thoại: 0985477383</p>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-3 f-col">
                <div class="footer-static-block"> <span class="opener plus"></span>
                  <h3 class="title">Màu sắc</h3>
                  <ul class="footer-block-contant tagcloud">
                    <li><a>Đen</a></li>
                    <li><a>Đỏ</a></li>
                    <li><a>Hồng</a></li>
                    <li><a>Trắng đen</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-3 f-col">
                <div class="footer-static-block"> <span class="opener plus"></span>
                  <h3 class="title">Về thuận an</h3>
                  <ul class="footer-block-contant link">
                    <li><a><span>■</span>Giới thiệu</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-3 f-col">
                <div class="footer-static-block"> <span class="opener plus"></span>
                 
                </div>
              </div>
            </div>
          </div>
          <hr>
        </div>
      </div>
    </div>
    <div class="scroll-top">
      <div id="scrollup"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-chevron-up">
          <path d="m18 15-6-6-6 6" />
        </svg></div>
    </div>
    <!-- FOOTER END -->
  </div>
  
 @include('frontend/callData/search.php')
 @include('frontend.layout.linkjs')
</body>

<!-- Mirrored from webcotheme.com/honour/demo2/hon001/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 26 Nov 2023 08:26:49 GMT -->

</html>