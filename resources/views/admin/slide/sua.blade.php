@extends('admin.layouts.base')
@section('content')
    <div class="container-fluid">

        <!-- Page Content -->
        <h1>Sửa slide</h1>
        <hr>


    </div>
    <div class="row">

        <div class="col-md-12">

            <form action="{{route('suaslide',$slide->id)}}" method="POST" enctype="multipart/form-data" style="padding: 0 10px;">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                @if(Session::has('thatbai'))
                    <div class="alert alert-danger">{{Session::get('thatbai')}}</div>
                @endif
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
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên danh mục</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="link" name="link" value="{{isset($slide)?$slide->link:''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ảnh</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="image" accept="image/*" onchange="loadFile(event)" >
                        <img id="output" width="150px" src="source/image/slide/{{$slide->image}}"/>
                        <script>
                            var loadFile = function(event) {
                                var output = document.getElementById('output');
                                output.src = URL.createObjectURL(event.target.files[0]);
                            };
                        </script>

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
    <!-- /.container-fluid -->
@endsection