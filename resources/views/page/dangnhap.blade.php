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
			<h6 class="inner-title">Đăng nhập</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{{route('trang-chu')}}">Home</a> / <span>Đăng nhập</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content" style="padding-top: 0">

		<form action="{{route('loginpage')}}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{csrf_token()}}">

			<div class="row">
				<div class="col-sm-3"></div>
				
				<div class="col-sm-6" >
					@if(count($errors) > 0)
					<div class="alert alert-danger">
						@foreach($errors->all() as $item)
						{{$item}}<br>
						@endforeach
					</div>
					@endif
					@if(Session::has('flag'))
					<div class="alert alert-{{Session::get('flag')}}">{{Session::get('thongbao')}}</div>
					@endif
					@if(Session::has('thanhcong'))
					<div class="alert alert-success">{{Session::get('thanhcong')}}</div>
					@endif
					<h4>Đăng nhập</h4>
					<div class="space20">&nbsp;</div>

					
					<div class="form-block">
						<label for="email">Email address*</label>
						<input type="email" name="email" required value="{{isset($req)?$req->email:''}}">
					</div>
					<div class="form-block">
						<label for="password">Password*</label>
						<input type="password" name="password" required>
					</div>
					<div class="form-block">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection