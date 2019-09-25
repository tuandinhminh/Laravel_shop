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
			<h6 class="inner-title">Sản phẩm {{$sanpham->name}}</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Chi tiết sản phẩm</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		@if(Session::has('thongbao'))
			<div class="alert alert-info">{{Session::get('thongbao')}}</div>
		@endif
		<div class="row">
			<div class="col-sm-9">

				<div class="row">
					<div class="col-sm-4">
						<img src="source/image/product/{{$sanpham->image}}" alt="">
					</div>
					<div class="col-sm-8">
						<div class="single-item-body">
							<p class="single-item-title">{{$sanpham->name}}</p>
							<p class="single-item-price">
								@if($sanpham->promotion_price != 0)
								<span class="flash-del">${{number_format($sanpham->unit_price)}}</span>
								<span class="flash-sale">${{number_format($sanpham->promotion_price)}}</span>
								@else
								<span class="flash-sale">${{number_format($sanpham->unit_price)}}</span>
								@endif
							</p>
						</div>

						<div class="clearfix"></div>
						<div class="space20">&nbsp;</div>

						<div class="single-item-desc">
							<p>{{$sanpham->description}}</p>
						</div>
						<div class="space20">&nbsp;</div>

						<p>Số Lượng: {{$sanpham->unit}}</p>
						<div class="single-item-options">
							
							<select class="wc-select" name="soluong" onchange="getsl(this)">
								
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
							<script type="text/javascript">
								function getsl(obj){
									var options = obj.children;
									var html = '';
									for (var i = 0; i < options.length; i++) {
										if (options[i].selected) {
											html += options[i].value;
											
										}

									}
									if (html == '1') {

										document.getElementById('result').href = "{{route('themgiohang',[$sanpham->id,1])}}";
									}
									if (html == '2') {

										document.getElementById('result').href = "{{route('themgiohang',[$sanpham->id,2])}}";
									}
									if (html == '3') {

										document.getElementById('result').href = "{{route('themgiohang',[$sanpham->id,3])}}";
									}
									if (html == '4') {

										document.getElementById('result').href = "{{route('themgiohang',[$sanpham->id,4])}}";
									}
									if (html == '5') {

										document.getElementById('result').href = "{{route('themgiohang',[$sanpham->id,5])}}";
									}
									 
								}
							</script>
							
							<a class="add-to-cart" id="result" href="{{route('themgiohang',[$sanpham->id,1])}}"><i class="fa fa-shopping-cart"></i></a>
							
							
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="space40">&nbsp;</div>

				<div class="woocommerce-tabs">
					<ul class="tabs">
						<li><a href="#tab-description">Bình luận</a></li>
						
					</ul>
					<div class="row" >
						<div class="panel" id="tab-description" style="width:100% ">
						
						@foreach($binhluan as $item)
							<div style="border-bottom: 1px #7c7c7c dashed">

								<div><span style="font-weight: bold;font-size: 18px">{{$item->user->full_name}}</span> - {{$item->created_at}}</div>
								<div style="margin-bottom: 10px;font-size: 17px">{{$item->content}}</div>
								@if(Auth::check())
									@if(Auth::user()->id == $item->id_user)
										<a href="{{route('deletecomment',$item->id)}}" class="btn btn-danger" style="float: right;top: -40px;position: relative">Xóa</a>
									@endif
								@endif
							</div>

						@endforeach
					</div>
					</div>
					
					<div class="row">{{$binhluan->links()}}</div>

					<form action="{{route('comment',$sanpham->id)}}" method="POST">
						<input type="hidden" name="_token" value="{{csrf_token()}}">

						<textarea name="contentComment" style="height: 100px"></textarea>
						<input type="submit" name="" value="Bình luận">
					</form>
				</div>
				<div class="space50">&nbsp;</div>
				<div class="beta-products-list">
					<h4>Sản phẩm tương tự</h4>

					<div class="row">
						@foreach($sp_tuongtu as $item)
						<div class="col-sm-4">
							<div class="single-item">
								@if($item->promotion_price != 0)
								<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
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
					<div class="row">{{$sp_tuongtu->links()}}</div>
				</div> <!-- .beta-products-list -->
			</div>
			<div class="col-sm-3 aside">
				<div class="widget">
					<h3 class="widget-title">Best Sellers</h3>
					<div class="widget-body">
						@foreach($bestseller as $item)
						<div class="beta-sales beta-lists">
							<div class="media beta-sales-item">
								<a class="pull-left" href="{{route('chitietsanpham',$item->id)}}"><img src="source/image/product/{{$item->image}}" alt=""></a>
								<div class="media-body">
									{{$item->name}}
									<span class="beta-sales-price">
										@if($item->promotion_price != 0)
											<span class="flash-sale">${{number_format($item->promotion_price)}}</span>
										@else
											<span class="flash-sale">${{number_format($item->unit_price)}}</span>
										@endif
									</span>
									<div> Đã bán: {{$item->sold}} {{$item->unit}} </div>
								</div>
							</div>

						</div>
						@endforeach
					</div>
				</div> <!-- best sellers widget -->
				<div class="widget">
					<h3 class="widget-title">New Products</h3>
					<div class="widget-body">
                        @foreach($sanphammoi as $item)
                            <div class="beta-sales beta-lists">
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="{{route('chitietsanpham',$item->id)}}"><img src="source/image/product/{{$item->image}}" alt=""></a>
                                    <div class="media-body">
                                        {{$item->name}}
                                        <span class="beta-sales-price">
										@if($item->promotion_price != 0)
                                                <span class="flash-sale">${{number_format($item->promotion_price)}}</span>
                                            @else
                                                <span class="flash-sale">${{number_format($item->unit_price)}}</span>
                                            @endif
									</span>
                                        <div> Đã bán: {{$item->sold}} {{$item->unit}} </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
					</div>
				</div> <!-- best sellers widget -->
			</div>
		</div>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection