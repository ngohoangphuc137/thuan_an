@extends('frontend.layout.main')
@section('title')
<title>Tài khoản khách hàng</title>
@endsection
@section('content')
<section class="checkout-section ptb-95">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4">
                <div class="account-sidebar account-tab mb-xs-30">
                    <div class="dark-bg tab-title-bg">
                        <div class="heading-part">
                            <div class="sub-title"><span></span>Tài khoản của tôi</div>
                        </div>
                    </div>
                    <div class="account-tab-inner">
                        <ul class="account-tab-stap">
                            <li id="step3" class="active"> <a href="javascript:void(0)">Danh sách đơn hàng của tôi<i
                                        class="fa fa-angle-right"></i> </a> </li>
                            <li id="step4"> <a href="javascript:void(0)">Đổi mật khẩu<i class="fa fa-angle-right"></i>
                                </a> </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-8">
                <div id="data-step3" class="account-content" data-temp="tabdata">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="heading-part heading-bg mb-30">
                                <h2 class="heading m-0">Đơn hàng của tôi</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 mb-xs-30">
                            <div class="commun-table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><span>Người nhận</span></th>
                                                <th><span>Địa chỉ nhận hàng</span></th>
                                                <th><span>Tổng đơn</span></th>
                                                <th><span>Trạng thái</span></th>
                                                <th><span>Tổng quan đơn</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getOrdelIdUser as $value)
                                            @if ($value->status != 5)
                                            
                                            <tr>
                                                <td>
                                                    <p>{{ $value->receiver }}</p>
                                                </td>
                                                <td>{{ $value->addrest }}</td>
                                                <td>{{ number_format($value->total,0,',','.').'đ' }}</td>
                                                <td style="text-align: left;">
                                                @if ($value->status == 1)
                                                <a href="{{ route('account/?idOrdel='.$value->id_order.'&status='. 5) }}">Hủy đơn</a>
                                                @else
                                                @foreach ($getordelconfirmation as $valueOrCf)   
                                                                                                                                                      
                                                     @if ($valueOrCf->id_ordelConfirmation == $value->status)                                           
                                                     {{ $valueOrCf->name_ordelComfirm }}
                                                    @endif 
                                                  @endforeach
                                                  @endif
                                                </td>
                                                <td><a href="{{ route('ordelComplete/'.$value->id_order) }}">Xem</a></td>
                                            </tr>
                                            @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="data-step4" class="account-content" data-temp="tabdata" style="display:none">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="heading-part heading-bg mb-30">
                                <h2 class="heading m-0">Thông tin tài khoản</h2>
                            </div>
                        </div>
                    </div>
                    <form class="main-form full" action="" method="post">
                        <div class="row">
                            <div class="col-xs-12">
                                <p>Tên tài khoản:{{ $_SESSION['user']->name_user }}</p>
                            </div>
                            <div class="col-sm-6">
                               <p>Địa chỉ email: {{ $_SESSION['user']->Email }}</p>
                            </div>
                            <!-- <div class="col-sm-6">
                                <p>Số điện thoại:</p>
                            </div> -->
                         
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection