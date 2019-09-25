@extends('admin.layouts.base')
@section('content')
<div class="container-fluid">


    <!-- Page Content -->
    <h1>Danh sách Slide
        <a href="{{route('themslide')}}" class="btn btn-success">Thêm mới</a>
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
                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;text-align: center">
                        <thead>
                        <tr role="row">
                            <th >STT</th>
                            <th >Link</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $stt =1 ; ?>
                        @foreach($slide as $item)
                        <tr role="row" class="odd">
                            <td class="sorting_1"><?php echo $stt; ?></td>
                            <td style="width: 300px">{{$item->link}}</td>

                            <td><img style="width: 200px" src="source/image/slide/{{$item->image}}" alt=""></td>
                            <td>
                                <a class="btn btn-xs btn-info" href="{{route('suaslide',$item->id)}}">Sửa</a>
                                <a class="btn btn-xs btn-danger" href="{{route('xoaslide',$item->id)}}">Xóa</a>
                            </td>

                        </tr>
                        <?php $stt++; ?>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" style="float:right;">
            {{$slide->links()}}
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection