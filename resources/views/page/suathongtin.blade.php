@extends('master')
@section('content')
@if(Session::has('thongbao'))
<script type="text/javascript">
    alert("{{Session::get('thongbao')}}");
</script>
{{Session::forget('thongbao')}}
@endif
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Thông tin</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="{{route('trang-chu')}}">Home</a> / <span>Thông tin</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content" style="padding-top: 0">

            <form action="{{route('editprofile')}}" method="post" class="beta-form-checkout">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                @if(Session::has('thanhcong'))
                    <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
                @endif
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}} <br>
                        @endforeach

                    </div>
                @endif
                <div class="row">

                    <div class="col-sm-6">
                        <h4>Thông tin tài khoản</h4>
                        <div class="space20">&nbsp;</div>


                        <div class="form-block">
                            <label for="email">Email address*</label>
                            <input type="email" name="email" value="{{Auth::user()->email}}" required>
                        </div>

                        <div class="form-block">
                            <label for="your_last_name">Fullname*</label>
                            <input type="text" name="fullname" value="{{Auth::user()->full_name}}" required>
                        </div>

                        <div class="form-block">
                            <label for="adress">Address*</label>
                            <input type="text" name="address" value="{{Auth::user()->address}}" required>
                        </div>


                        <div class="form-block">
                            <label for="phone">Phone*</label>
                            <input type="number" name="phone" value="{{Auth::user()->phone}}" required>
                        </div>
                        <div class="form-block">
                            <label for="phone">New Password</label>
                            <input type="password" name="password" >
                        </div>
                        <div class="form-block">
                            <label for="phone">Confirm New Password</label>
                            <input type="password" name="re_password" >
                        </div>
                        <div class="form-block">
                            <button type="submit" class="btn btn-primary">Change</button>
                        </div>
                    </div>
                    <div class="col-sm-6" style="padding: 0">
                        <h4>Lịch sử đặt hàng</h4>

                        @if(isset($ctdh))
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;text-align: center">
                                                <thead>
                                                <tr role="row">
                                                    <th >STT</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Ảnh</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $stt =1 ; ?>
                                                @foreach($ctdh as $item)
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{$stt}}</td>
                                                        <td>{{$item->product->name}}</td>
                                                        <td><img src="source/image/product/{{$item->product->image}}" alt="" width="100px"></td>
                                                        <td>{{$item->quantity}}</td>
                                                        <td>{{number_format($item->unit_price) }} đ</td>


                                                    </tr>
                                                    <?php $stt++; ?>
                                                @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                    <div  style="float:right;">
                                        <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;text-align: center">
                                            <thead>
                                            <tr role="row">
                                                <th >STT</th>
                                                <th>Tổng tiền</th>
                                                <th>PTTT</th>
                                                <th>Ghi chú</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $stt =1 ; ?>
                                            @foreach($bill as $item)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{$stt}}</td>
                                                    <td>{{number_format($item->total)}} đ</td>

                                                    <td>{{$item->payment}}</td>
                                                    <td>{{$item->note}}</td>
                                                    <td style="color: white">
                                                        @if($item->status == 0)
                                                            <a class="btn btn-danger">Chưa giao hàng</a>
                                                        @elseif($item->status == 1)
                                                            <a class="btn btn-info">Đang giao hàng</a>
                                                        @else
                                                            <a class="btn btn-dark">Đã giao hàng</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-success" href="{{route('chitietdonhang',$item->id)}}">Xem chi tiết</a>

                                                    </td>

                                                </tr>
                                                <?php $stt++; ?>
                                            @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                <div class="row" style="float:right;">
                                    {{$bill->links()}}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
