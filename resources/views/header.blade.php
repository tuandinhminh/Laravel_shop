<div id="header">
	<div class="header-top">
		<div class="container">
			<div class="pull-left auto-width-left">
				<ul class="top-menu menu-beta l-inline">
					<li><a ><i class="fa fa-home"></i> 55 Giải Phóng</a></li>
					<li><a ><i class="fa fa-phone"></i> 0163 296 7751</a></li>
				</ul>
			</div>
			<div class="pull-right auto-width-right">
				<ul class="top-details menu-beta l-inline">
					@if(Auth::check())
					<li><a href="{{route('editprofile')}}"><i class="fa fa-user"></i>Chào bạn {{Auth::user()->full_name}}</a></li>
					<li><a href="{{route('logout1')}}">Đăng xuất</a></li>
					@else

					<li><a href="{{route('signup')}}">Đăng kí</a></li>
					<li><a href="{{route('loginpage')}}">Đăng nhập</a></li>
					@endif
				</ul>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .header-top -->
	<div class="header-body">
		<div class="container beta-relative">
			<div class="pull-left">
				<a href="{{route('trang-chu')}}" id="logo"><img src="source/assets/dest/images/logo-cake.jpg" width="200px" alt=""></a>
			</div>
			<div class="pull-right beta-components space-left ov">
				<div class="space10">&nbsp;</div>
				<div class="beta-comp">
					<form role="search" method="get" id="searchform" action="{{route('search')}}">
						<input type="text" value="" name="key" id="s" placeholder="Nhập từ khóa..." />
						<button class="fa fa-search" type="submit" id="searchsubmit"></button>
					</form>
				</div>

				<div class="beta-comp">
					@if(Session::has('cart'))
					<div class="cart">
						<div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng ( @if(Session::has('cart')){{Session('cart')->totalQty}} @else Trống @endif ) <i class="fa fa-chevron-down"></i></div>
						<div class="beta-dropdown cart-body">
							
							@foreach($product_cart as $product)
							<div class="cart-item">
								<a href="{!!route('xoagiohang',$product['item']['id'])!!}" class="cart-item-delete"><i class="fa fa-times"></i></a>
								<div class="media">
									<a class="pull-left" href="{{route('chitietsanpham',$product['item']['id'])}}"><img src="source/image/product/{{$product['item']['image']}}" alt=""></a>
									<div class="media-body">
										<span class="cart-item-title">{{$product['item']['name']}}</span>
										<span class="cart-item-amount">{{$product['qty']}}*
											<span>
												{{number_format($product['item']['price'])}} đ
											</span>
										</span>
									</div>
								</div>
							</div>
							@endforeach
							
							<div class="cart-caption">
								<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{number_format(Session('cart')->totalPrice)}} đ</span></div>
								<div class="clearfix"></div>

								<div class="center">
									<div class="space10">&nbsp;</div>
									<a href="{{route('dathang')}}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
						</div>
					</div> <!-- .cart -->
					@endif
				</div>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .header-body -->
	<div class="header-bottom" style="background-color: #0277b8;">
		<div class="container">
			<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
			<div class="visible-xs clearfix"></div>
			<nav class="main-menu">
				<ul class="l-inline ov">
					<li><a href="{{route('trang-chu')}}">Trang chủ</a></li>
					<li><a style="cursor: pointer;">Loại sản phẩm</a>
						<ul class="sub-menu">
							@foreach($loai_sp1 as $item)
							<li><a href="{{route('loaisanpham',$item->id)}}">{{$item->name}}</a></li>
							@endforeach
						</ul>
					</li>

					<li><a href="{{route('lienhe')}}">Chỉ đường</a></li>
				</ul>
				<div class="clearfix"></div>
			</nav>
		</div> <!-- .container -->
	</div> <!-- .header-bottom -->
	</div> <!-- #header -->