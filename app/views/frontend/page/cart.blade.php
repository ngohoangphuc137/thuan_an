@extends('frontend.layout.main')
@section('title')
<title>giỏ hàng</title>
@endsection
@section('content')
<section>
    <h3 style="text-align: center;padding: 2.3rem 0;
    font-size: 2.5rem;">Shopping Cart</h3>
    @if (!empty($_SESSION['cart']))

        <div class="container">
            <div class="row">
                <div class="col-xs-12 mb-xs-30">

                    <div class="cart-item-table commun-table">
                        <div class="table-responsive">
                            <form id="form-table-cart">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Sản phẩm</th>
                                            <th></th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng phụ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-cart">
                                        <!-- <tr>
                                            <td>
                                                <div class="product-title"><img width="100px" src="" alt=""></div>
                                            </td>
                                            <td>
                                                <div class="base-price price-box"> <span class="price">20000</span> </div>
                                            </td>
                                            <td>
                                                <div class="input-box">
                                                    <div class="product-qty">
                                                        <div class="custom-qty">
                                                            <button class="reduced pre-items" type="button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20"
                                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                    stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round" class="lucide lucide-minus">
                                                                    <path d="M5 12h14" />
                                                                </svg>
                                                            </button>
                                                            <input type="text" style="max-width: 35px;" class="input-text qty"
                                                                title="Qty" data-quanity=""
                                                                value="1" min="1" maxlength="8" id="qty" name="qty">
                                                            <button class="increase nex-items" type="button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20"
                                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                    stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round" class="lucide lucide-plus">
                                                                    <path d="M5 12h14" />
                                                                    <path d="M12 5v14" />
                                                                </svg>
                                                            </button>
                                                        </div>

                                                    </div>

                                                </div>
                                            </td>

                                            <td>
                                                <div class="input-box">dsdsds</div>
                                            </td>

                                            <td><a href=""><i title="Remove Item From Cart" data-id="100"
                                                        class="fa fa-trash cart-remove-item"></i></a></td>
                                        </tr> -->


                                    </tbody>
                                    <style>
                                        .pre-items,
                                        .nex-items {
                                            padding: 4px 5px 4px;
                                            border: none;
                                        }

                                        .remove-cart-product {
                                            cursor: pointer;
                                        }

                                        .mt-1 {
                                            padding-right: 6px;
                                            margin-top: 0.5rem;
                                        }
                                    </style>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-30">
                <div class="row">
                    <div class="col-sm-6" style="display:flex; flex-wrap: wrap;">
                        <div class="mt-1"> <a href="{{ route('home') }}" class="btn-action btn-red"><span><i
                                        class="fa fa-angle-left"></i></span>Tiếp tục mua hàng</a> </div>
                        <div class="mt-1"> <a class="btn-action btn-red bgr-red updata-product-cart"><span><i
                                        class="fa fa-angle-left"></i></span>Cập nhật giỏ hàng</a> </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="mtb-30">
                <div class="row">

                    <div class="col-sm-6">
                        <div class="cart-total-table commun-table">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Tổng số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td><b >Tổng</b></td>
                                            <td>
                                                <div class="price-box"> <span class="price"><p class="total-price"></p></span> </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="mt-30" style="padding-bottom:2.5rem;">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="right-side float-none-xs"> <a href="{{ route('checkout/') }}" class="btn-action bgr-red">Tiến hành
                                thanh
                                toán<span><i class="fa fa-angle-right"></i></span></a> </div>
                    </div>
                </div>
            </div>
        </div>
    @else

        <div class="container mt-60">
            <div class="mb-30">
                <div class="row">
                    <div class="" style="text-align: center;">
                        <p style="font-size: 1.55rem;">Chưa có sản phẩm nào trong cửa hàng</p>
                        <div class="mt-1"> <a href="{{ route('') }}" class="btn-action bgr-red btn-red">Quay trở lại cửa
                                hàng</a> </div>
                    </div>
                </div>
            </div>
        </div>

    @endif
</section>
@include('frontend/callData/cartProduct.php')
@endsection