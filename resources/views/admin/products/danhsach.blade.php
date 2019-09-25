@extends('admin.layouts.base')
@section('content')
<div class="container-fluid">


    <!-- Page Content -->
    <h1>Danh sách sản phẩm
        <a href="{{route('themproduct')}}" class="btn btn-success">Thêm mới</a>
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
                            <th >Tên sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Mô tả</th>
                            <th>Giá gốc</th>
                            <th>Giá khuyến mãi </th>
                            <th>Ảnh</th>
                            <th>Unit</th>
                            <th>Status</th>
                            <th>Sold</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $stt =1 ; ?>
                        @foreach($product as $item)
                        <tr role="row" class="odd">
                            <td class="sorting_1"><?php echo $stt; ?></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->product_type->name}}</td>
                            <td style="width: 150px">{{$item->description}}</td>
                            <td>{{$item->unit_price}}</td>
                            <td>{{$item->promotion_price}}</td>
                            <td><img style="width: 100px" src="source/image/product/{{$item->image}}" alt=""></td>
                            <td>{{$item->unit}}</td>
                            <td>
                                @if($item->status == 0)
                                    <a href="{{route('xoaproduct',$item->id)}}" class="btn btn-info">Activated</a>
                                @else
                                    <a  href="{{route('xoaproduct',$item->id)}}" class="btn btn-danger">Deactivated</a>
                                @endif
                            </td>
                            <td>{{$item->sold}}</td>
                            <td width="110px">
                                <a class="btn btn-xs btn-info" href="{{route('suaproduct',$item->id)}}">Sửa</a>
                                <a class="btn btn-xs btn-danger" href="{{route('xoahanproduct',$item->id)}}">Xóa</a>
                            </td>

                        </tr>
                        <?php $stt++; ?>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" style="float:right;">
            {{$product->links()}}
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection