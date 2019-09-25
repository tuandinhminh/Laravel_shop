@extends('admin.layouts.base')
@section('content')
<div class="container-fluid">


    <!-- Page Content -->
    <h1>Danh sách đơn hàng
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
                            <th >ID Bill</th>
                            <th >ID User</th>
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
                            <td class="sorting_1">{{$item->id}}</td>
                            <td>{{$item->id_customer}}</td>
                            <td>{{number_format($item->total)}} đ</td>

                            <td>{{$item->payment}}</td>
                            <td>{{$item->note}}</td>
                            <td>
                                @if($item->status == 0)
                                    <a href="{{route('xulybill',$item->id)}}" class="btn btn-danger">Chưa xử lý</a>
                                @elseif($item->status == 1)
                                    <a  href="{{route('xulybill',$item->id)}}" class="btn btn-info">Đang xử lý</a>
                                @else
                                    <a  href="{{route('xulybill',$item->id)}}" class="btn btn-dark">Đã xử lý</a>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-success" href="{{route('chitietbill',$item->id)}}">Xem chi tiết</a>

                            </td>

                        </tr>
                        <?php $stt++; ?>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" style="float:right;">
            {{$bill->links()}}
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection