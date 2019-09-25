@extends('admin.layouts.base')
@section('content')
<div class="container-fluid">


    <!-- Page Content -->
    <h1>Danh sách User
        <a href="{{route('themuser')}}" class="btn btn-success">Thêm mới</a>
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
                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                        <thead>
                        <tr role="row">
                            <th >STT</th>
                            <th >Tên User</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Quyền</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $stt =1 ; ?>
                        @foreach($user as $item)
                        <tr role="row" class="odd">
                            <td class="sorting_1"><?php echo $stt; ?></td>
                            <td>{{$item->full_name}}</td>
                            <td>{{$item->email}}</td>

                            <td>{{$item->phone}}</td>
                            <td>{{$item->address}}</td>
                            <td>
                                @if($item->level == 1)
                                    <a href="{{route('thayquyenuser',$item->id)}}" class="btn btn-success">Admin</a>
                                @else
                                    <a  href="{{route('thayquyenuser',$item->id)}}" class="btn btn-dark">Customer</a>
                                @endif
                            </td>
                            <td>
                                @if($item->status == 0)
                                    <a href="{{route('xoauser',$item->id)}}" class="btn btn-primary">Activated</a>
                                    @else
                                    <a  href="{{route('xoauser',$item->id)}}" class="btn btn-secondary">Deactivated</a>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-info" href="{{route('suauser',$item->id)}}">Sửa</a>
                                <a class="btn btn-xs btn-danger" href="{{route('xoahanuser',$item->id)}}">Xóa</a>

                            </td>

                        </tr>
                        <?php $stt++; ?>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" style="float:right;">
            {{$user->links()}}
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection