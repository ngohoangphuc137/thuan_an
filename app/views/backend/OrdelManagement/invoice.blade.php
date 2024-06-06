@extends('backend.layout.main')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Hóa đơn</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin/ordel') }}">Home</a></li>
                    <li class="breadcrumb-item active">Hóa đơn</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i>Thuận an.

                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            Từ
                            <address>
                                <strong>Admin.</strong><br>
                                Từ công ty cổ phần thương mại và sản xuất <br>
                                nội thất thuận an<br>
                                Email: info@almasaeedstudio.com
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Đến
                            <address>
                                <strong>{{ $getOrdelId->receiver }}</strong><br>
                                {{ $getOrdelId->addrest }}<br>
                                Điện thoại: {{ $getOrdelId->phone_number }}<br>
                                Email: {{ $getOrdelId->email }}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>ID đơn hàng:</b> #{{ $getOrdelId->id_order }}<br>
                            <b>Ngày mua:</b> {{ $getOrdelId->creadate }} <br>
                            <b>Trạng thái</b>    
                                 @foreach ($getordelconfirmation as $value)     
                                    @if ($value->id_ordelConfirmation == $getOrdelId->status)                                                      
                                      {{ $value->name_ordelComfirm }}
                                      @endif    
                                @endforeach
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Sản phẩm</th>
                                        <th></th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getAllOrdelId as $value)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><img width="80px" src="{{ BASE_URL . $value->imageDescribe }}"
                                                    alt="thuanan"></td>
                                            <td>{{ $value->name_product }}</td>
                                            <td>{{ $value->quanity }} sản phẩm</td>
                                            <td>{{ number_format($value->price, 0, ',', '.') . 'đ' }}</td>
                                            <td>{{ number_format(($value->quanity * $value->price), 0, ',', '.') . 'đ' }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">
                            <p class="lead">Phương thức thanh toán:</p>

                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                Giao hàng bằng tiền mặt
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-6">

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Tổng phụ:</th>
                                        <td>{{number_format($getOrdelId->total, 0, ',', '.') . 'đ' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Vận chuyển:</th>
                                        <td>0đ</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng đơn:</th>
                                        <td>{{number_format($getOrdelId->total, 0, ',', '.') . 'đ' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                           
                            <div class="btn-group float-right" role="group">
                                <button type="button" id="btnGroupDrop1"
                                    class="btn btn-success dropdown-toggle " data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="far fa-credit-card"></i>
                                    @foreach ($getordelconfirmation as $value)     
                                    @if ($value->id_ordelConfirmation ==$getOrdelId->status)                                                      
                                      {{ $value->name_ordelComfirm }}
                                      @endif    
                                    @endforeach
                                </button>

                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    @foreach ($getordelconfirmation as $value)
                                    @if ($value->id_ordelConfirmation !==$getOrdelId->status)   
                                      @if($getOrdelId->status < $value->id_ordelConfirmation)                      
                                    <a class="dropdown-item" href="{{ route('admin/hoa-don/'.$getOrdelId->id_order.'&ordel-confirm='.$value->id_ordelConfirmation) }}">{{ $value->name_ordelComfirm }}</a>
                                     @endif                           
                                    @endif                           
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection