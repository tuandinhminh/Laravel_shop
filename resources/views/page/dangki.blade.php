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
			<h6 class="inner-title">Đăng kí</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{{route('trang-chu')}}">Home</a> / <span>Đăng kí</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content" style="padding-top: 0">
		
		<form action="{{route('signup')}}" method="post" class="beta-form-checkout">
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
				
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h4>Thông tin tài khoản</h4>
					<div class="space20">&nbsp;</div>

					
					<div class="form-block">
						<label for="email">Email address*</label>
						<input type="email" name="email" value="{{isset($req->email)?$req->email:''}}" required>
					</div>

					<div class="form-block">
						<label for="your_last_name">Fullname*</label>
						<input type="text" name="fullname" value="{{isset($req->fullname)?$req->fullname:''}}" required>
					</div>

					<div class="form-block">
						<label for="adress">Address*</label>
						<input type="text" name="address" value="{{isset($req->address)?$req->address:''}}" required>
					</div>


					<div class="form-block">
						<label for="phone">Phone*</label>
						<input type="number" name="phone" value="{{isset($req->phone)?$req->phone:''}}" required>
					</div>
					<div class="form-block">
						<label for="phone">Password*</label>
						<input type="password" name="password" required>
					</div>
					<div class="form-block">
						<label for="phone">Re password*</label>
						<input type="password" name="re_password" required>
					</div>
					<div class="form-block">
						<button type="submit" class="btn btn-primary">Register</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection