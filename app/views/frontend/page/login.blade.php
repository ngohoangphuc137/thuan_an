@extends('frontend.layout.main')
@section('title')
<title>Đăng nhập</title>
@endsection
@section('content')
<section class="checkout-section ptb-95">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-8 col-lg-offset-3 col-sm-offset-2">
            <form class="main-form full" action="{{ route('userLogin') }}" method="post">
              <div class="row">
                <div class="col-xs-12 mb-20">
                  <div class="heading-part heading-bg">
                    <h2 class="heading">Đăng nhập khách hàng</h2>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="input-box">
                    <label for="login-email">Địa chỉ email</label>
                    <input id="login-email" type="email" name="email" required placeholder="Địa chỉ email">
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="input-box">
                    <label for="login-pass">Mật khẩu</label>
                    <input id="password" type="password" name="password" required placeholder="Mật khẩu">
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="check-box" style="padding-bottom: 10px;"> <span>
                      <input type="checkbox" name="remember_me" id="checked-show-pass" class="checkbox">
                    </span>
                    <label for="checked-show-pass">Xem mật khẩu</label>
                  </div>
                </div>
                <div class="col-sm-12">
                                @if (isset($_SESSION['errors']) && isset($_GET['msg']))
                                <p class="color-red" style="color: #b20000;">
                                <strong>{{ $_SESSION['errors'] }}</strong>
                                </p>
                                @endif
                            </div>
                <div class="col-xs-12">
                  <button name="btn-submit" type="submit" class="btn-color right-side">Đăng nhập</button>
                </div>
                <hr>
              </div>
              <div class="col-xs-12">
                <div class="new-account align-center mt-20"> <span>Mời tạo gia thuận an?</span> <a class="link"
                    title="Register with Honour" href="{{ route('register/') }}">Tạo tài khoản mới</a> </div>
              </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
@endsection