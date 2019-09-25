@extends('admin.layouts.base')
@section('content')
    <div class="container-fluid">


        <!-- Page Content -->
        <h1>Danh sách chi tiết hóa đơn số {{$bill->id}} của khách hàng {{$bill->user->full_name}}
        </h1>

        <div class="clearfix"></div>
        <!-- in thong bao -->

        @if(Session::has('thanhcong'))
            <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
        @endif
        @if(Session::has('thatbai'))
            <div class="alert alert-danger">{{Session::get('thatbai')}}</div>
        @endif
        @if(count($errors)>0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}} <br>
                @endforeach

            </div>
        @endif

        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
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
                            @foreach($ctbill as $item)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$stt}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td><img src="source/image/product/{{$item->product->image}}" alt="" width="150px"></td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{number_format($item->unit_price) }} đ</td>


                                </tr>
                                <?php $stt++; ?>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="float:right;">
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection