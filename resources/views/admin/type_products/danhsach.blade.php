@extends('admin.layouts.base')
@section('content')
<div class="container-fluid">


    <!-- Page Content -->
    <h1>Danh sách loại sản phẩm
        <a href="{{route('themloaisp')}}" class="btn btn-success">Thêm mới</a>
    </h1>

    <div class="clearfix"></div>
    <!-- in thong bao -->

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

    <div class="table-responsive">
        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                        <thead>
                        <tr role="row">
                            <th >STT</th>
                            <th >Tên loại sản phẩm</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $stt =1 ; ?>
                        @foreach($loaisp as $item)
                        <tr role="row" class="odd">
                            <td class="sorting_1"><?php echo $stt; ?></td>
                            <td>{{$item->name}}</td>
                            <td style="width: 400px">{{$item->description}}</td>

                            <td><img style="width: 150px" src="source/image/product/{{$item->image}}" alt=""></td>
                            <td>
                                @if($item->status == 0)
                                    <a href="{{route('xoaloaisp',$item->id)}}" class="btn btn-info">activated</a>
                                    @else
                                    <a  href="{{route('xoaloaisp',$item->id)}}" class="btn btn-danger">deactivated</a>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-info" href="{{route('sualoaisp',$item->id)}}">Sửa</a>
                            </td>

                        </tr>
                        <?php $stt++; ?>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" style="float:right;">
            {{$loaisp->links()}}
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection