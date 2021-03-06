@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ "Homepage" }}@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<style>
.has-error .form-control {
    border-color: #EF6F6C;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
}
.info-wallet{
    font-size: 16px;
}
.deposit{
    font-size: 18px;
    color: red;
}
</style>
@if($agent->isMobile())
<style>
    .pay-course .container::before {
        display: none !important;
    }
    .btn-buying{
        margin-bottom: 20px !important;
    }
</style>
@endif
@stop

{{-- Page content --}}
@section('content')   
<main class="main">
        @if(!$agent->isMobile())
    <nav class="c-breadcrumb">
        <div class="container">
            <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{route('vne.pay.buyCourse', ['course_id' => $order['course_id']])}}">Mua khóa học</a></li>
            <li class="breadcrumb-item active">Thông tin thanh toán</li>
            </ol>
        </div>
    </nav> <!-- / breadcrumb -->
    @endif

    <section class="pay-pay js-pay">
    <div class="container">
        <div class="pay-inner">
        <h2 class="pay-headline">Hình thức thanh toán</h2>
        <div class="row species">
            @if(!empty($payMethods))
                @foreach($payMethods as $i => $method)
                <div class="item {{$i == 0 ? 'species-active' : ''}} " data-pay="#method_{{$method['payment_id']}}">
                    <div class="wrapper">
                        <div class="inner">
                        <div class="icon">
                            <img src="{{$method['img']}}" alt="">
                            <img class="hover" src="{{$method['img_hover']}}" alt="">
                        </div>
                        <div class="title">{{$method['name']}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif                        
        </div>
        @if(!empty($payMethods))
            @foreach($payMethods as $i => $method)
                
                @php
                    $detail  = !empty($method['detail']) ?  json_decode($method['detail'], true) : [];
                @endphp
                @if($method['type'] == 'cod')
                    <div class="cod  {{ $i == 0 ? 'pay-active' : ''}}" id="method_{{$method['payment_id']}}">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputCodName">Họ và tên</label>
                                <input type="name" class="form-control" id="codName" placeholder="Họ và tên">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCodPassword">Số điện thoại</label>
                                <input type="text" class="form-control" id="codPhone" placeholder="Nhập số điện thoại">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlCodTextarea">Địa chỉ</label>
                                <textarea class="form-control" id="codAddress" rows="4" placeholder="Ví dụ: Số 52, đường Nguyễn Thị Minh Khai"></textarea>
                            </div>
                            <div class="form-group select-list">
                                <div class="item">
                                <select class="form-control city" id="exampleFormControlCodSelect1">
                                    <option selected="true" disabled="disabled">Tỉnh / Thành phố</option>
                                    @if(!empty($city))
                                        @foreach($city as $item)
                                        <option value="{{ $item->matp }}">{{$item->name}}</option>
                                        @endforeach
                                    @endif                                                                       
                                </select>
                                </div>
                                <div class="item">
                                <select class="form-control district" id="exampleFormControlCodSelect2">
                                    <option selected="true" disabled="disabled">Quận / Huyện</option>
                                    
                                </select>
                                </div>
                                <div class="item">
                                <select class="form-control" id="exampleFormControlCodSelect3">
                                    <option selected="true" disabled="disabled">Phường / Xã</option>
                                    
                                </select>
                                </div>
                            </div>
                            <button type="button" class="btn btn-buying pay-code">Mua khóa học</button>
                        </form>
                    </div>
                @elseif($method['type'] == 'ebanking')
                <div class="visa {{ $i == 0 ? 'pay-active' : ''}}" id="method_{{$method['payment_id']}}">
                    <div class="inner">{{isset($detail['content']) ? $detail['content'] : ''}}</div>
                    <a href="javascript:void(0,0)" class="btn btn-buying pay-vnpay">Mua khóa học</a>
                </div>
                @elseif($method['type'] == 'card')   
                <div class="bank-card {{ $i == 0 ? 'pay-active' : ''}}" id="method_{{$method['payment_id']}}">
                    <div class="tabs">
                        @if(isset($detail['info']))
                            @foreach($detail['info'] as $i => $info)
                            <div class="tabs-inner">
                                <div class="tabs-item {{$i == 0 ? 'tabs-active' : ''}}" data-tab="#hocplus-card">
                                    <div class="wrapper">
                                        <div class="inner">
                                            <img src="{{asset($info['img'])}}" alt="">
                                        </div>
                                    </div>
                                </div>                        
                            </div>
                            @endforeach
                        @endif
                        
                    </div>
                    <form class="form-horizontal form bank-card-active" id="hocplus-card">
                        <div class="form-group">
                            <label for="exampleInputCodHocPlusCardNumber">Mã thẻ cào Học Plus</label>
                            <input type="text" class="form-control" name="card_code" id="card_code" placeholder="Nhập mã số thẻ cào">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCodHocPlusCardSeri">Số Seri</label>
                            <input type="text" class="form-control" name="card_seri" id="card_seri" placeholder="Nhập Serial">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCodHocPlusCardSeriConfirm">Mã xác nhận</label>
                            <input type="text" class="form-control" id="captcha" placeholder="Nhập mã xác nhận">                            
                        </div>
                        <div class="form-group">
                            <label></label>
                            <span class="help-block" style="padding-right: 20px; color:red;">
                                <strong id="error_captcah"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <div class="form-control form-control-img">
                            <span id="img_captcha">{!! captcha_img() !!}</span>
                            <button type="button" class="btn btn-success btn-refresh"><i class="fas fa-sync-alt"></i></button>                            
                            </div>
                        </div>
                        <button type="button" class="btn btn-buying pay-card">Mua khóa học</button>
                    </form>
                    <form class="form" id="phone-card">
                        <div class="form-group form-select">
                            <label for="exampleFormControlCodCardPhoneSelect">Lựa chọn nhà mạng</label>
                            <select class="form-control" id="exampleFormControlCodCardPhoneSelect">
                            <option selected="true" disabled="disabled">Thẻ cào Viettel</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCodPhoneCardNumber">Mã thẻ cào Học Plus</label>
                            <input type="text" class="form-control" id="exampleInputCodPhoneCardNumber" placeholder="Nhập mã số thẻ cào">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCodPhoneCardSeri">Số Seri</label>
                            <input class="form-control" id="exampleInputCodPhoneCardSeri" rows="4" placeholder="Nhập Serial">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCodPhoneCardSeriConfirm">Mã xác nhận</label>
                            <input type="password" class="form-control" id="exampleInputCodPhoneCardSeriConfirm" placeholder="Nhập mã xác nhận">
                        </div>
                        <div class="form-group">
                            <label></label>
                            <div class="form-control form-control-img">
                            <img src="images/code.png" alt="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-buying">Mua khóa học</button>
                    </form>
                </div>
                @elseif($method['type'] == 'transfer')
                <div class="bank {{ $i == 0 ? 'pay-active' : ''}}" id="method_{{$method['payment_id']}}">
                    <div class="inner">
                        <div class="headline">
                            <div class="grid title"><span class="grid-1">Nội dung</span>Thanh toán đơn hàng #{{$order->order_code}}</div>
                            <div class="content">{{isset($detail['content']) ? $detail['content'] : '' }}</div>
                        </div>
                        
                        <div class="grid title">
                            <div class="grid-1"><b>Ngân hàng</b></div>
                            <div class="grid-2"><b>Công ty cổ phần Dịch vụ Giáo dục Á Châu</b></div>
                            <div class="grid-3"><b>Số tài khoản</b></div>
                        </div>
                        <ul class="list">
                            @if(isset($detail['info']))
                                @if(!empty($detail['info']))
                                    @foreach($detail['info'] as $i => $info)
                                    <li class="grid item">
                                        <div class="grid-1">
                                            <div class="icon">
                                            <img src="{{asset($info['img'])}}" alt="">
                                            </div>
                                        </div>
                                        <div class="grid-2">
                                            <div class="name">{{$info['name']}}</div>
                                        </div>
                                        <div class="grid-3">
                                            <div class="number">{{$info['account']}}</div>
                                        </div>
                                    </li>
                                    @endforeach
                                @endif
                            @endif                                                    
                        </ul>
                    </div>
                    <a href="javascript:void(0,0)" class="btn btn-buying buy-tranfer">Mua khóa học</a>
                </div>
                @elseif($method['type'] == 'wallet')
                <div class="bank {{ $i == 0 ? 'pay-active' : ''}}" id="method_{{$method['payment_id']}}">
                    <div class="inner">
                        <div class="info-wallet">Ví của bạn đang có <span class="deposit">{{number_format($deposit->deposit, 0, ',', '.')}}</span>đ</div>
                        <div class="nap-tien"><a href="{{route('vne.wallet.recharge')}}">Nạp tiền</a></div>
                    </div>
                    <a href="javascript:void(0,0)" class="btn btn-buying pay-wallet">Mua khóa học</a>
                </div>
                @endif
            @endforeach
        @endif        
                                        
        </div> <!-- / inner -->
    </div> <!-- / container -->
    </section> <!-- / pay course -->
</main>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript">
        var resetToken = '{{ $resetToken }}';        
        var routeApigetCourse = '{{ route('hocplus.frontend.api.getCourse') }}';
        var routeApigetCourseRun = '{{ route('hocplus.frontend.api.getCourseRun') }}';
    </script>
    <script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/script/homepage.js' }}"></script>
    <script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrapvalidator/js/bootstrapValidator.min.js' }}" type="text/javascript"></script>
    <script>
        $('body').on('change', '.city', function(){
            let matp = $(this).val();
            $.ajax({
                url: '/pay-course/load-district',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').prop('content')
                },
                type: 'POST',
                cache: false,
                data: {
                    matp: matp,                
                },
                success: function (response) {
                    if (response.status == true) {
                        $('#exampleFormControlCodSelect2').html(response.html);                   
                    } else{
                        alert(response.msg);
                    }
                    
                }
            }, 'json');
        });

        $('body').on('change', '.district', function(){
            let maqh = $(this).val();
            $.ajax({
                url: '/pay-course/load-wards',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').prop('content')
                },
                type: 'POST',
                cache: false,
                data: {
                    maqh: maqh,                
                },
                success: function (response) {
                    if (response.status == true) {
                        $('#exampleFormControlCodSelect3').html(response.html);                   
                    } else{
                        alert(response.msg);
                    }
                    
                }
            }, 'json');
        });

        $('body').on('click', '.pay-code', function(){
            let name = $("#codName").val();
            let phone = $("#codPhone").val();
            let address = $("#codAddress").val();
            let order_code = '{{request()->get('order_code')}}';
            let secret_key = '{{request()->get('secret_key')}}';
            $.ajax({
                url: '/pay-course/cod',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').prop('content')
                },
                type: 'POST',
                cache: false,
                data: {
                    name, phone, address, order_code, secret_key                
                },
                success: function (response) {
                   
                    if (response.status == true) {
                        window.location.href = response.redirect;                    
                    } else{
                        alert(response.msg);
                    }
                    
                }
            }, 'json');
        });


        $('body').on('click', '.pay-card', function(){
            
            let card_code = $("#card_code").val();
            let card_seri = $("#card_seri").val();
            let captcha = $("#captcha").val();            
            let order_code = '{{request()->get('order_code')}}';
            let secret_key = '{{request()->get('secret_key')}}';
            $.ajax({
                url: '/pay-course/card',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').prop('content')
                },
                type: 'POST',
                cache: false,
                data: {
                    card_code, card_seri, order_code, secret_key, captcha                
                },
                success: function (response) {
                    alert(response.msg);
                    if (response.status == true) {
                        window.location.href = response.redirect;                    
                    } else{
                        $("#img_captcha").html(response.captcha);
                        if(response.errors.captcha){
                            $("#error_captcah").text(response.errors.captcha[0]);
                        }
                        
                        $('#hocplus-card').bootstrapValidator('validate');                        
                    }
                    
                }
            }, 'json');
        });
        $(".btn-refresh").click(function(){
            $.ajax({
                type:'GET',
                url:'/refresh_captcha',
                success:function(data){
                    $("#img_captcha").html(data.captcha);
                }
            });
        });

        $('body').on('click', '.pay-vnpay', function(){           
            let order_code = '{{request()->get('order_code')}}';
            let secret_key = '{{request()->get('secret_key')}}';
            $.ajax({
                url: '/pay-course/pay-vnpay',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').prop('content')
                },
                type: 'POST',
                cache: false,
                data: {
                    order_code, secret_key
                },
                success: function (response) {
                    if(response.status == true){
                        window.location.href = response.link; 
                    } else{
                        alert(response.msg);
                    }
                    
                    
                }
            }, 'json');
        });

        $('body').on('click', '.pay-wallet', function(){
            var result = confirm("Bạn có chắc chắn muốn mua khóa học này?");
            if (result) {
                let order_code = '{{request()->get('order_code')}}';
                let secret_key = '{{request()->get('secret_key')}}';
                $.ajax({
                    url: '/pay-course/pay-wallet',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').prop('content')
                    },
                    type: 'POST',
                    cache: false,
                    data: {
                        order_code, secret_key
                    },
                    success: function (response) {
                        if(response.status == true){
                            window.location.href = response.redirect; 
                        } else{
                            alert(response.msg);
                        }                                        
                    }
                }, 'json');
            } else {
                return false;
            }
            
        });

        $('body').on('click', '.buy-tranfer', function(){
            
            let order_code = '{{request()->get('order_code')}}';
            let secret_key = '{{request()->get('secret_key')}}';
            $.ajax({
                url: '/pay-course/pay-tranfer',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').prop('content')
                },
                type: 'POST',
                cache: false,
                data: {
                    order_code, secret_key
                },
                success: function (response) {
                    if (response.status == true) {
                        window.location.href = response.redirect;                    
                    } else{
                        alert(response.msg);
                    }                    
                }
            }, 'json');
        });

        $('#hocplus-card').bootstrapValidator({
            excluded: ':disabled',
            trigger: 'blur',
            fields: {
                card_code: {
                    validators: {
                        notEmpty: {
                            message: ' '
                        }
                    }
                },
                card_seri: {
                    validators: {
                        notEmpty: {
                            message: ' '
                        }
                    }
                }                
            }
        });

    </script>
@stop
