@extends('frontend.layout.main')
@section('title')
<title>Thông tin đặt hàng</title>
@endsection
@section('content')
<section class="checkout-section ptb-95">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="checkout-content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="heading-part align-center">
                                <h2 class="heading">Thông tin đặt hàng</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <form action="{{ route('insertOrder') }}" id="paymentForm" method="post" class="main-form full">
                            <div class="mb-20">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 style="padding-left: 15px; padding-top: 15px;">Thông tin người nhận</h3>

                                        <input type="hidden" name="id_user" value="">
                                        <div class="col-sm-6">
                                            <div class="input-box">
                                                <label for="name">Người nhận</label>
                                                <input type="text" required placeholder="Tên người nhận" name="receiver"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-box">
                                                <label for="name">Số điện thoại</label>
                                                <input type="text" required placeholder="Số điện thoại" name="phone_number"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="input-box">
                                                <label for="name">Email</label>
                                                <input type="email" required placeholder="Email" name="email" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="input-box">
                                                <label for="name">Địa chỉ</label>
                                                <textarea type="text" required placeholder="Địa chỉ người nhận"
                                                    name="addrest" value=""></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            @if (isset($_SESSION['errors']) && isset($_GET['msg']))
                                              @foreach ($_SESSION['errors'] as $value)
                                               <p class="color-red" style="color: #b20000;"><strong>{{ $value['name_input'] }}</strong>: <span>{{ $value['isError'] }}</span></p>
                                              @endforeach
                                            @endif
                                        </div>



                                    </div>
                                    <div class="col-md-6" style="border: 1px solid #cfcfcf;">
                                        <div class="checkout-sidebar">
                                            <h3>Đơn hàng của bản</h3>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Sản Phẩm</th>
                                                        <th class="text-right">Tổng</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($productCart))
                                                    @foreach ($productCart as $value)
                                                    <tr class="cart_item">
                                                        <td>{{ $value->name_product }} <strong>×
                                                                {{ $_SESSION['cart'][$value->id_product]['quanity'] }}</strong>
                                                        </td>
                                                        <td class="text-right color-red">
                                                            {{number_format($_SESSION['cart'][$value->id_product]['quanity']*$_SESSION['cart'][$value->id_product]['price'],0,',','.') }}₫
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>

                                                <tfoot>
                                                    <tr class="order-total">
                                                        <th>Tổng Đơn Hàng</th>
                                                        <td colspan="2" class="text-right color-red"><span
                                                                class="order-total-ammount">
                                                                <span> {{ number_format(array_reduce($_SESSION['cart'],function($total,$price){
                                                                return $total + ($price['price']*$price['quanity']);
                                                            },0),0,',','.') }}₫ </span></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class="payment_method">
                                                <strong id="messageLogin">Trả tiền mặt khi nhận hàng</strong>
                                                <p>Trả tiền mặt khi giao hàng.</p>
                                            </div>

                                            <div class="btn-submitBuy"> <button type="submit" name="btn-submit"
                                                    class="btn btn-color">Đặt hàng</button> </div>
                                        </div>
                                    </div>

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