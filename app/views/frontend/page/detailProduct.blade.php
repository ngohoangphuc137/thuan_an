@extends('frontend.layout.main')
@section('title')
<title>{{ $getProductSlugUrl->name_product }}</title>
@endsection
@section('content')
<!-- Modal------------- -->

<div class="modal fade" id="exampleModal" style="padding-right: 0px;" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modalHeader">
                <h5 class="modal-title" id="exampleModalLabel">Đặt mua {{ $getProductSlugUrl->name_product }}</h5>
                <button type="button" class="close clode-model" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formBuynow">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-detail-product">
                                <img src="{{ BASE_URL . $getImageId[0]->imageDescribe }}" style="padding-right: 5px;"
                                    alt="">
                                <div class="specification-product">
                                    <h3>{{ $getProductSlugUrl->name_product }}</h3>
                                    @if ($getProductSlugUrl->sale != 0)
                                        <div class="price-box py-2"> <span
                                                class="price">{{number_format(($getProductSlugUrl->price * (100 - $getProductSlugUrl->sale) / 100), 0, ',', '.') . '₫' }}</span>
                                            <del style="font-size: 14px;font-weight: 400;color: #b9a06f;"
                                                class="price old-price">{{number_format($getProductSlugUrl->price, 0, ',', '.') . '₫'}}</del>
                                        </div>
                                    @else
                                        <div class="price-box">
                                            <span
                                                class="price">{{number_format(($getProductSlugUrl->price), 0, ',', '.') . '₫' }}</span>
                                        </div>
                                    @endif
                                    <div class="product-qty">
                                        <div class="custom-qty">
                                            <input type="number" style="width:45px;"
                                                data-totalqty="{{ $getProductSlugUrl->quanity }}" class="qty-buy-now"
                                                title="Qty" value="1" min="1" maxlength="8" id="qty" name="qty-butnow">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>Bạn vui lòng nhập đúng số điện thoại để chúng tôi sẽ gọi xác nhận đơn hàng trước khi
                                    giao
                                    hàng. Xin cảm ơn!</p>
                            </div>
                        </div>
                        <div class="col-md-6 information-user">
                            <p>Thông tin người mua</p>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="receiver" value="<?php if (isset($_SESSION['user'])) {
    echo $_SESSION['user']->name_user;
} ?>" class="form-input" id="receiver" required placeholder="Họ và tên">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-input" required name="phone_number" id="phone_number"
                                        placeholder="Số điện thoại">
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="email" class="form-input" value="<?php if (isset($_SESSION['user'])) {
    echo $_SESSION['user']->Email;
} ?>" required name="email" id="email" placeholder="email">
                                </div>
                                <div class="col-md-12 form-group pt-1">
                                    <textarea name="addrest" id="addrest" class="form-input textarea-information"
                                        required cols="20" rows="2.7" id="" placeholder="Địa chỉ"></textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <p>Tổng:
                                        @if ($getProductSlugUrl->sale != 0)
                                            <strong class="total-price"
                                                data-totalprice="{{$getProductSlugUrl->price * (100 - $getProductSlugUrl->sale) / 100}}">{{number_format(($getProductSlugUrl->price * (100 - $getProductSlugUrl->sale) / 100), 0, ',', '.')}}</strong>
                                        @else
                                            <strong class="total-price"
                                                data-totalprice="{{$getProductSlugUrl->price}}">{{number_format(($getProductSlugUrl->price), 0, ',', '.')}}</strong>
                                        @endif
                                        đ
                                    </p>
                                    <p class="form-message" style="color:red;"></p>
                                    @if (isset($_SESSION['user']))
                                        <button type="button" class="btn-buynow"
                                            data-id="{{ $getProductSlugUrl->id_product }}" id="btn-buynow">Đặt mua
                                            ngay</button>
                                    @else
                                        <button type="button" class="btn-buynow userNotLoggedIn">Đặt mua ngay</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end --------------  -->
<section class="mt-40">

    <div class="container">
        @if (isset($_SESSION['check']) || !empty($_SESSION['check']))
            <div style="">
                <p style="color: #7a9c59;font-size: 1.8rem;font-weight: 400;display: flex;align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-check">
                        <path d="M20 6 9 17l-5-5" />
                    </svg>
                    {{ $getProductSlugUrl->name_product . $_SESSION['check']}}
                </p>
                <?php    unset($_SESSION['check'])?>
            </div>
        @endif
        <div class="row">
            <div class="col-md-5 col-sm-5 mb-xs-30">
                <div class="fotorama images-show" data-nav="thumbs" data-thumbwidth="58" data-thumbheight="80"
                    data-maxheight="438">
                    @foreach ($getImageId as $item)
                        <img src="{{ BASE_URL . $item->imageDescribe}}" alt="thuanan">
                    @endforeach

                </div>
            </div>
            <div class="col-md-5 col-sm-6">
                <div class="row row-right">
                    <div class="col-xs-12">

                        <div class="product-detail-main">
                            <div class="product-item-details">
                                <a href="{{ route('') }}">Trang chủ</a>
                                @foreach ($arrayNavMenu as $item)
                                    {!! $item !!}
                                @endforeach
                                <h1 class="product-item-name">{{ $getProductSlugUrl->name_product }}</h1>

                                @if ($getProductSlugUrl->sale != 0)
                                    <div class="price-box py-2"> <span
                                            class="price">{{number_format(($getProductSlugUrl->price * (100 - $getProductSlugUrl->sale) / 100), 0, ',', '.') . '₫' }}</span>
                                        <del style="font-size: 14px;font-weight: 400;color: #b9a06f;"
                                            class="price old-price">{{number_format($getProductSlugUrl->price, 0, ',', '.') . '₫'}}</del>
                                    </div>
                                @else
                                    <div class="price-box">
                                        <span
                                            class="price">{{number_format(($getProductSlugUrl->price), 0, ',', '.') . '₫' }}</span>
                                    </div>
                                @endif
                                <div class="product-info-stock-sku">
                                    <div>
                                        <label>Danh mục: </label>
                                        <span class="info-deta">{{ $getProductSlugUrl->name_category }}</span>
                                    </div>

                                </div>

                                <div class="product-info-stock-sku">
                                    <table class="pt-5" id="tableSpes">
                                        @foreach ($arraySpes as $item)
                                            @if (!empty($item->value))
                                                <tr class="col trModel">
                                                    <td class="col-6 colborder">{{ $item->title }}</td>
                                                    <td class="col-6">
                                                        {{ $item->value }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        @foreach ($related_spes as $key => $item)
                                            @if (!empty($item))

                                                <tr class="tr-infomation trModel">
                                                    <td colspan="2">
                                                        {{$item}}
                                                    </td>
                                                </tr>
                                            @endif

                                        @endforeach                                          

                                    </table>
                                </div>
                                @if($getProductSlugUrl->quanity > 0)
                                <form id="formAddCart">
                                    <div class="mb-40">
                                        <div class="product-qty">
                                            <label for="qty">Qty:</label>
                                            <div class="custom-qty ">
                                                <button class="reduced items pre" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-minus">
                                                        <path d="M5 12h14" />
                                                    </svg>
                                                </button>
                                                <input type="text" class="input-text qty" title="Qty"
                                                    data-quanity="{{ $getProductSlugUrl->quanity }}" value="1" min="1"
                                                    maxlength="8" id="qty" name="qty">
                                                <button class="increase items next" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-plus">
                                                        <path d="M5 12h14" />
                                                        <path d="M12 5v14" />
                                                    </svg>
                                                </button>
                                            </div>

                                        </div>
                                        <div class="bottom-detail cart-button">
                                            <ul>
                                                @if (isset($_SESSION['user']))
                                                    <li class="pro-cart-icon">
                                                        <button type="button"
                                                            data-idProduct="{{ $getProductSlugUrl->id_product }}"
                                                            data-totalqty="{{ $getProductSlugUrl->quanity }}"
                                                            class="btn-black btn-addCart"><span></span>Add
                                                            to Cart</button>
                                                    </li>
                                                @else
                                                    <li class="pro-cart-icon">
                                                        <button type="button"
                                                            class="btn-black userNotLoggedIn"><span></span>Add
                                                            to Cart</button>
                                                    </li>
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                </form>

                                <div class="parent-buynow" data-toggle="modal" data-target="#exampleModal">
                                    <a class="buy-now">
                                        <strong>Mua ngày</strong>
                                    </a>
                                </div>
                                @else
                                 <p> Sản phẩm đã hết hàng </p>
                                @endif

                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ptb-95">
    <div class="container">
        <div class="product-detail-tab">
            <div class="row">
                <div class="col-md-12">
                    <div id="tabs">
                        <ul class="nav nav-tabs">
                            <li><a class="tab-Description selected" title="Description">Mô tả sản phẩm</a></li>
                            <li><a class="tab-Reviews" title="Reviews">Bình luận</a></li>
                        </ul>
                    </div>
                    <div id="items">
                        <div class="tab_content">
                            <ul>
                                <li>
                                    <div class="items-Description selected gray-bg">
                                        <div class="Description">{!! $getProductSlugUrl->describe !!}</div>
                                    </div>
                                </li>

                                <li>
                                    <div class="items-Reviews gray-bg">
                                        <div class="comments-area">

                                        </div>
                                        <div class="main-form mt-30">
                                            <h4>Để lại một bình luận</h4>
                                            <div class="row mt-30">
                                                <form id="formUserComment">
                                                    <div class="col-sm-6 mb-30">
                                                        <input type="text" placeholder="Name" name="name_user" value="<?php if(isset($_SESSION['user'])){echo $_SESSION['user']->name_user; } ?>" required>
                                                    </div>
                                                    <div class="col-sm-6 mb-30">
                                                        <input type="email" placeholder="Email" value="<?php if(isset($_SESSION['user'])){echo $_SESSION['user']->Email; } ?>" required>
                                                    </div>
                                                    <div class="col-xs-12 mb-30">
                                                        <textarea cols="30" rows="3" name="commentContent" placeholder="Message"
                                                            required></textarea>
                                                    </div>
                                                    <div class="col-xs-12 mb-30">
                                                        @if (isset($_SESSION['user']))
                                                            <button class="btn-black btn-submitComent" data-idProduct="{{ $getProductSlugUrl->id_product }}" name="submit"
                                                                type="button">Submit</button>
                                                        @else 
                                                            <button class="btn-black userNotLoggedIn" name="submit"
                                                                type="button">Submit</button>
                                                        @endif

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend/callData/detailProduct.php')
@endsection