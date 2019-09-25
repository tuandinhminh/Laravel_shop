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
			<h6 class="inner-title">{{$loai_sp->name}}</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{route('trang-chu')}}">Home</a> / <span>Loại Sản phẩm</span> / <span>{{$loai_sp->name}}</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-3">
					<ul class="aside-menu">
						@foreach($loai as $item)
						<li><a href="{{route('loaisanpham',$item->id)}}">{{$item->name}}</a></li>
						@endforeach
					</ul>
				</div>
				<div class="col-sm-9">
					<div class="beta-products-list">
						<h4>{{$loai_sp->name}}</h4>
						<br>

						<div class="row">
							@foreach($sp_theoloai as $item)
							<div class="col-sm-4">
								<div class="single-item">
									@if($item->promotion_price != 0)
									<div class="ribbon-wrapper"><div class="ribbon sale">sale</div></div>
									@endif
									<div class="single-item-header">
										<a href="{{route('chitietsanpham',$item->id)}}"><img src="source/image/product/{{$item->image}}" alt="" height="250px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$item->name}}</p>
										<p class="single-item-price">
											@if($item->promotion_price != 0)
											<span class="flash-del">${{number_format($item->unit_price)}}</span>
											<span class="flash-sale">${{number_format($item->promotion_price)}}</span>
											@else
											<span class="flash-sale">${{number_format($item->unit_price)}}</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="{{route('themgiohang',[$item->id,1])}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('chitietsanpham',$item->id)}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<div class="row">{{$sp_theoloai->links()}}</div>
					</div> <!-- .beta-products-list -->

					<div class="space50">&nbsp;</div>

					<div class="beta-products-list">
						<h4>Sản phẩm khác</h4>
						<br>
						<div class="row">
							@foreach($sp_khac as $item)
							<div class="col-sm-4">
								<div class="single-item">
									@if($item->promotion_price != 0)
									<div class="ribbon-wrapper"><div class="ribbon sale">sale</div></div>
									@endif
									<div class="single-item-header">
										<a href="{{route('chitietsanpham',$item->id)}}"><img src="source/image/product/{{$item->image}}" alt="" height="250px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$item->name}}</p>
										<p class="single-item-price">
											@if($item->promotion_price != 0)
											<span class="flash-del">${{number_format($item->unit_price)}}</span>
											<span class="flash-sale">${{number_format($item->promotion_price)}}</span>
											@else
											<span class="flash-sale">${{number_format($item->unit_price)}}</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="{{route('themgiohang',[$item->id,1])}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('chitietsanpham',$item->id)}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<div class="row">{{$sp_khac->links()}}</div>
						<div class="space40">&nbsp;</div>

					</div> <!-- .beta-products-list -->
				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection