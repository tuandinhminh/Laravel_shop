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
			<h6 class="inner-title">Maps</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{route('trang-chu')}}">Home</a> / <span>Maps</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="beta-map">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.711414763824!2d105.84009468581874!3d21.00420211860537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac776a8696e3%3A0x3250acff63ffb6bd!2zTmjDoCBBMSwgNTUgR2nhuqNpIFBow7NuZywgxJDhu5NuZyBUw6JtLCBIYWkgQsOgIFRyxrBuZywgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1559201005389!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
	{{-- <div class="abs-fullwidth beta-map wow flipInX"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3678.0141923553406!2d89.551518!3d22.801938!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff8ff8ef7ea2b7%3A0x1f1e9fc1cf4bd626!2sPranon+Pvt.+Limited!5e0!3m2!1sen!2s!4v1407828576904" ></iframe></div> --}}
</div>
<div class="container">

</div> <!-- .container -->
@endsection