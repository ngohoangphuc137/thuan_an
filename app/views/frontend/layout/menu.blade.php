@php
    use App\Controllers\user\MainController;

    $Home = new MainController;
    $getAllCaregory = $Home->getAllCaregory();
    $getProductCart = $Home->getProductCart();
@endphp
<div class="main">
    <header class="navbar navbar-custom" id="header">
        <div class="container">
            <div class="header-inner">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu">
                            <line x1="4" x2="20" y1="12" y2="12" />
                            <line x1="4" x2="20" y1="6" y2="6" />
                            <line x1="4" x2="20" y1="18" y2="18" />
                        </svg></button>
                    <a href="{{ route('') }}" class="navbar-brand page-scroll">
                        <img alt="ThuanAn" src="{{ BASE_URL }}public/images/logothuanan.png">
                    </a>
                </div>
                <div class="right-side float-none-sm">

                    <div class="right-side float-left-xs header-right-link">
                        <ul>
                            <li class="main-search">
                                <div class="header_search_toggle desktop-view">
                                    <form>
                                        <div class="search-box">
                                            <input class="input-text input-search" type="text"
                                                placeholder="Tìm kiếm sản phẩm...">
                                            <button class="search-btn"></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="header-search product-link desktop-search-view">
                                    <ul class="overflow list-product-search">

                            </li>
                        </ul>
                        <li class="account-icon"> <a><span></span></a>
                            <div class="header-link-dropdown account-link-dropdown">
                                <ul class="link-dropdown-list">
                                    <li>
                                        @if (isset($_SESSION['user']))
                                            <ul>
                                                <li><a href="{{ route('account/')}}">Tài khoản của tôi</a></li>
                                                <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                                            </ul>
                                        @else
                                            <ul>
                                                <li><a href="{{ route('login/')}}">Đăng nhập</a></li>
                                                <li><a href="{{ route('register/') }}">Tạo tai khoản</a></li>
                                            </ul>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="cart-icon"> <a href="{{ route('cart') }}/?chirlden-cart"> <span> <small
                                        class="cart-notification">{{ 
                                               $tong = array_reduce($_SESSION['cart'], function ($total, $quanity) {
        return $total + $quanity['quanity']; }, 0)
                                             }}</small>
                                </span> </a>
                            @if (!isset($_GET['chirlden-cart']))

                                                    <div class="cart-dropdown header-link-dropdown">
                                                        @if (!empty($_SESSION['cart']))
                                                                                    <ul class="cart-list link-dropdown-list">

                                                                                        @foreach ($getProductCart as $key => $value)

                                                                                            <li> <a class="close-cart"><i class="fa fa-times-circle"></i></a>
                                                                                                <div class="media"> <a class="pull-left"> <img alt="Minimo"
                                                                                                            src="{{ BASE_URL . $value->imageDescribe }}"></a>
                                                                                                    <div class="media-body"> <span><a>{{ $value->name_product }}</a></span>
                                                                                                        <p class="cart-price">
                                                                                                            {{ number_format($_SESSION['cart'][$value->id_product]['price'], 0, ',', '.') . 'đ' }}
                                                                                                        </p>
                                                                                                        <div class="product-qty">
                                                                                                            <label>Qty:
                                                                                                                <span>{{ $_SESSION['cart'][$value->id_product]['quanity'] }}
                                                                                                                </span></label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>

                                                                                        @endforeach

                                                                                        <!-- <style>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    .media-body span a{
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        display: block;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        display: -webkit-box;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        max-width: 100%;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        line-height: 1;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        -webkit-line-clamp: 2;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        -webkit-box-orient: vertical;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        overflow: hidden;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        text-overflow: ellipsis;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </style> -->
                                                                                    </ul>
                                                                                    <?php        $sum = 0;
                                                            foreach ($_SESSION['cart'] as $value) {
                                                                $sum += $value['quanity'] * $value['price'];
                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>
                                                                                    <p class="cart-sub-totle"> <span class="pull-left">Tổng phụ :<strong class="">
                                                                                                {{ number_format($sum, 0, ',', '.') . 'đ'}}
                                                                                            </strong></span> </p>
                                                                                    <div class="clearfix"></div>
                                                                                    <div class="mt-20"> <a href="{{ route('cart') }}" class="btn-color btn">Giỏ hàng</a>
                                                                                        <a href="{{ route('checkout') }}" class="btn-color btn right-side">Thanh toán</a>
                                                                                    </div>
                                                        @else
                                                            <p style="color:white;">Chưa có sản phẩm trong giỏ hàng</p>
                                                        @endif

                                                    </div>
                            @endif
                        </li>
                        </ul>
                    </div>
                </div>
                <div class="header_search_toggle mobile-view">
                    <form>
                        <div class="search-box">
                            <input class="input-text input-search" type="text"
                                placeholder="Tìm kiếm sản phẩm...">
                            <button type="button" class="search-btn"></button>
                        </div>
                        <div class="header-search product-link">
                            <ul class="overflow list-product-search">




                            </ul>
                        </div>
                    </form>
                </div>
                <style>
                    .header-search {
                        display: none;
                    }

                    .empty-product {
                        color: black;
                        font-weight: 500;
                    }

                    .autocomplete-suggestion:hover {
                        background-color: rgba(0, 0, 0, 0.05);
                    }
                </style>
            </div>
        </div>
    </header>
</div>
<section class="nav-bar-menu">
    <div class="main-menu-overlay"></div>
    <header class="navbar navbar-custom boxNavBar" id="header">
        <div class="container">
            <div class="header-inner">
                <div class="navbar-header">
                    <div class="left-side float-none-sm">
                        <div id="menu" class="left-side">
                            <ul class="nav navbar-nav navbar-left">
                                <li class="level"> <a href="{{ route('') }}" class="page-scroll">Trang chủ</a>
                                </li>
                                @foreach ($getAllCaregory as $value)
                                                            @if ($value->id_parent == 0)
                                                                                        <li class="level"><span class="opener plus"></span> <a
                                                                                                href="{{route('danh-muc/') . $value->slugUrl}}/"
                                                                                                class="page-scroll">{{$value->name_category}}</a>
                                                                                            @php
                                                                                                $Home->menutreeUser($getAllCaregory, $value->id_category)
                                                                                            @endphp

                                                                                        </li>
                                                            @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <button type="button" class="close close-menu" data-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-x">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </header>
</section>