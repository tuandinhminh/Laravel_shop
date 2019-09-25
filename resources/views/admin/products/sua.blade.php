@extends('admin.layouts.base')
@section('content')
<div class="container-fluid">

    <!-- Page Content -->
    <h1>Sửa sản phẩm </h1>
    <hr>


</div>
<div class="row">

    <div class="col-md-12">

        <form action="{{route('suaproduct',$sp->id)}}" method="POST" enctype="multipart/form-data" style="padding: 0 10px;">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
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
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Tên sản phẩm</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="name" name="name" value="{{isset($sp)?$sp->name:''}}">
                </div>

            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Danh mục sản phẩm</label>
                <div class="col-sm-10">
                    <select class="form-control col-md-8" name="id_type">
                        <option value="">Mời bạn chọn danh mục sản phẩm</option>
                        @foreach($loaisp as $item)
                        <option value="{{$item->id}}" {{(isset($sp) and ($item->id == $sp->id_type) )?'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Mô tả</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="description" value="{{isset($sp)?$sp->description:''}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Giá gốc</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="unit_price" value="{{isset($sp)?$sp->unit_price:''}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Giá khuyến mại</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="promotion_price" value="{{isset($sp)?$sp->promotion_price:''}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Ảnh</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="image" accept="image/*" onchange="loadFile(event)" >
                    <img id="output" width="150px" src="source/image/product/{{$sp->image}}"/>
                    <script>
                        var loadFile = function(event) {
                            var output = document.getElementById('output');
                            output.src = URL.createObjectURL(event.target.files[0]);
                        };
                    </script>

                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Đơn vị</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="unit" value="{{isset($sp)?$sp->unit:''}}">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<h3>Danh sách bình luận:</h3>
<div class="table-responsive">
    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                    <thead>
                        <tr role="row">
                            <th >STT</th>
                            <th >ID user</th>
                            <th>User name</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt =1 ; ?>
                        @foreach($bl as $item)
                        <tr role="row" class="odd">
                            <td class="sorting_1"><?php echo $stt; ?></td>
                            <td>{{$item->id_user}}</td>
                            <td>{{$item->user->full_name}}</td>
                            <td>{{$item->content}}</td>
                            <td>
                                <a class="btn btn-xs btn-danger" href="{{route('deletecomment',$item->id)}}">Xóa</a>
                            </td>

                        </tr>
                        <?php $stt++; ?>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" style="float:right;">
            {{$bl->links()}}
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection