@extends('admin.layouts.base')
@section('content')
    <div class="container-fluid">

        <!-- Page Content -->
        <h1>Thêm mới User</h1>
        <hr>


    </div>
    <div class="row">

        <div class="col-md-12">

            <form action="{{route('themuser')}}" method="POST" style="padding: 0 10px;">
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
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Họ tên </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="name" name="full_name" value="{{isset($req)?$req->full_name:''}}">
                    </div>


                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" value="{{isset($req)?$req->email:''}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="re_password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="phone" value="{{isset($req)?$req->phone:''}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Địa chỉ</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" value="{{isset($req)?$req->address:''}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">level</label>
                    <div class="col-sm-10">
                        <select class="form-group" name="level">
                            <option value="0" {{(isset($req) and $req->level == 0 )?'selected':''}}>Customer</option>
                            <option value="1" {{(isset($req) and $req->level == 1 )?'selected':''}}>Admin</option>
                        </select>

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