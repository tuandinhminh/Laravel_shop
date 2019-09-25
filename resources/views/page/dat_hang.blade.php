@extends('master')
@section('content')
@if(Session::has('thongbao'))
<script type="text/javascript">
	alert("{{Session::get('thongbao')}}");
</script>
{{Session::forget('thongbao')}}
@endif
@if(Auth::check())
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Đặt hàng</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Đặt hàng</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">

		<form action="{{route('dathang')}}" method="post" class="beta-form-checkout">
			@if(Session::has('thongbao'))<h2 class="alert alert-success">{{Session::get('thongbao')}}</h2>@endif
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="row">
				<div class="col-sm-6">
					<h4>Đặt hàng</h4>
					<div class="space20">&nbsp;</div>

					<div class="form-block">
						<label for="name">Họ tên*</label>
						<input type="text" id="name" name="name" placeholder="Họ tên" required value="{{Auth::user()->full_name}}"  readonly="true">
					</div>

					<div class="form-block">
						<label for="email">Email*</label>
						<input type="email" id="email" name="email" required placeholder="expample@gmail.com" value="{{Auth::user()->email}}" readonly="true">
					</div>

					<div class="form-block">
						<label for="adress">Địa chỉ*</label>
						<input type="text" id="adress" name="address" placeholder="Street Address" required value="{{Auth::user()->address}}" readonly="true">
					</div>


					<div class="form-block">
						<label for="phone">Điện thoại*</label>
						<input type="text" id="phone" name="phone" required value="{{Auth::user()->phone}}"  readonly="true">
					</div>

					<div class="form-block">
						<label for="notes">Ghi chú</label>
						<textarea id="notes" name="notes"></textarea>
					</div>
				</div>
				<div class="col-sm-6">
					@if(Session::has('cart'))
					<div class="your-order">
						<div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
						<div class="your-order-body" style="padding: 0px 10px">
							<div class="your-order-item">
								<div>
									@foreach($product_cart as $product)
									<!--  one item	 -->
									<div class="media">
										<img width="25%" src="source/image/product/{{$product['item']['image']}}" alt="" class="pull-left">
										<div class="media-body">
											<p class="font-large">{{$product['item']['name']}}</p>
											<span class="color-gray your-order-info">
												Giá: {{number_format($product['item']['price'])}} đ
											</span>
											
											<span class="color-gray your-order-info">SL: {{$product['qty']}}</span>
										</div>
									</div>
									<!-- end one item -->
									@endforeach
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="your-order-item">
								<div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
								<div class="pull-right"><h5 class="color-black">{{number_format(Session('cart')->totalPrice)}} đ</h5></div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>

						<div class="your-order-body">
							<ul class="payment_methods methods">
								<li class="payment_method_bacs">
									<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
									<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
									<div class="payment_box payment_method_bacs" style="display: block;">
										Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
									</div>						
								</li>

								<li class="payment_method_cheque">
									<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
									<label for="payment_method_cheque">Chuyển khoản </label>
									<div class="payment_box payment_method_cheque" style="display: none;">
										Chuyển tiền đến tài khoản sau:
										<br>- Số tài khoản: 123 456 789
										<br>- Chủ TK: Đinh Minh Tuấn
										<br>- Ngân hàng BIDV
									</div>						
								</li>

							</ul>
						</div>

						<div class="text-center"><button type="submit" class="beta-btn primary" href="#">Đặt hàng <i class="fa fa-chevron-right"></i></button></div>
					</div> <!-- .your-order -->
					@else 
					<h2>Chưa có sản phẩm trong giỏ hàng</h2>
					@endif
				</div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->
@else
	<h2 class="alert alert-primary" style="text-align: center;">Bạn phải đăng nhập để đặt hàng</h2>
@endif
@endsection