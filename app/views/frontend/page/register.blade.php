@extends('frontend.layout.main')
@section('title')
<title>Đăng ký</title>
@endsection
@section('content')
<section class="checkout-section ptb-95">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-8 col-lg-offset-3 col-sm-offset-2">
                        <form action="{{ route('createAccountUser') }}" method="post" class="main-form full">
                            <div class="row">
                                <div class="col-xs-12 mb-20">
                                    <div class="heading-part heading-bg">
                                        <h2 class="heading">Tạo tài khoản của bạn</h2>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="input-box">
                                        <label for="f-name">Tên khách hàng</label>
                                        <input type="text" id="f-name" name="name_user" required
                                            placeholder="Tên khách hàng">
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="input-box">
                                        <label for="login-email">Địa chỉ email</label>
                                        <input id="login-email" type="email" name="email" required
                                            placeholder="Địa chỉ email">
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="input-box">
                                        <label for="login-pass">Mật khẩu</label>
                                        <input id="password" type="password" name="password" required
                                            placeholder="Mật khẩu của bạn">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="check-box" style="padding-bottom: 10px;"> <span>
                                        <input type="checkbox" name="remember_me" id="checked-show-pass" class="checkbox">
                                    </span>
                                    <label for="checked-show-pass">Xem mật khẩu</label>
                                </div>
                            </div>

                            <script>
                              $(document).ready(function(){
                                $('#checked-show-pass').on('change',function(){
                                  if($(this).is(':checked')){
                                    $('#password').attr("type", "text")
                                  }else{
                                    $('#password').attr("type", "password")
                                  }
                                })
                              })
                            </script>

                            <div class="col-sm-12">
                                @if (isset($_SESSION['errors']) && isset($_GET['msg']))
                                @foreach ($_SESSION['errors'] as $value)
                                <p class="color-red" style="color: #b20000;">
                                    <strong>{{ $value['name_input'] }}</strong>:
                                    <span>{{ $value['isError'] }}</span>
                                </p>
                                @endforeach
                                @endif
                                @if (isset($_SESSION['success']) && isset($_GET['msg']))
                                <p  style="color:#6cbc6f;">
                                    <strong>{{ $_SESSION['success'] }}</strong>:
                                </p>
                                @endif
                            </div>
                            <div class="col-xs-12">
                                <button name="btn-submit" type="submit" class="btn-color right-side">Đăng ký</button>
                            </div>
                            <div class="col-xs-12">
                                <hr>
                                <div class="new-account align-center mt-20"> <span>Đã có tài khoản với chúng tôi </span>
                                    <a class="link" title="Register with Honour" href="{{ route('login/') }}">Đăng nhập
                                        tại đây</a> </div>
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