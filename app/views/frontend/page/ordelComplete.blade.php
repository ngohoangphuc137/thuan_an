@extends('frontend.layout.main')
@section('title')
<title>Tổng quan đơn hàng</title>
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
                                <h2 class="heading">Tổng quan về đơn hàng</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 mb-sm-30">
                            <div class="cart-item-table complete-order-table commun-table mb-30">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Chi tiết sản phẩm</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getAllOrdelId as $value)
                                            
                                            <tr>
                                                <td><a href="product-page.html">
                                                        <div class="product-image"><img alt="Honour" width="90px" src="{{ BASE_URL.$value->imageDescribe }}">
                                                        </div>
                                                    </a></td>
                                                <td>
                                                    <div class="product-title"> <a href="{{ route('detailProduct/'.$value->slugUrlProduct) }}">{{ $value->name_product }}</a>
                                                        <div class="product-info-stock-sku m-0">
                                                            <div>
                                                                <label>Price: </label>
                                                                <div class="price-box"> <span
                                                                        class="info-deta price">{{ number_format($value->price,0,',','.')}} đ</span> </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-info-stock-sku m-0">
                                                            <div>
                                                                <label>Quantity: </label>
                                                                <span class="info-deta">{{ $value->quanity }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                       
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="right-side float-none-xs"> <a class="btn btn-black" href="{{ route('') }}"><span><i
                                            class="fa fa-angle-left"></i></span>Chở về cửa hàng</a> </div>
                        </div>
                        <div class="commun-table mb-30 col-sm-4" style="margin-top:0px;">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>Ngày đặt  :</b></td>
                                            <td>{{ $getOrdelId->creadate }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Tổng đơn hàng :</b></td>
                                            <td><span class="price color-red" style="color:red;font-size:1.5rem;font-weight:600;">{{ number_format($getOrdelId->total,0,',','.') }}đ</span></td>
                                        </tr>
                                        <tr>
                                            <td><b>Phương thức thanh toán :</b></td>
                                            <td>Trả tiền mặt khi nhận hàng</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-4">

                            <div class="cart-total-table address-box commun-table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Địa chỉ thanh toán</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <ul>
                                                        <li class="inner-heading"> <b>Gửi tới :</b><span>{{ $getOrdelId->receiver }}</span></li>
                                                        <li>
                                                            <b>Địa chỉ nhận :</b><span>{{ $getOrdelId->addrest }}</span>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection