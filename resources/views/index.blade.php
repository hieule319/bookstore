<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bookstore</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/user/assets/images/favicon.ico') }}">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/user/assets/css/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/user/assets/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/user/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/user/assets/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/user/assets/css/flexslider.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/user/assets/css/chosen.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/user/assets/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/user/assets/css/color-01.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/user/assets/css/sweetalert.css') }}">
	<!-- <link rel="stylesheet" type="text/css" href="{{ asset('public/user/assets/css/userprofile.css') }}"> -->
</head>

<body class="home-page home-01 ">

	<!-- mobile menu -->
	<div class="mercado-clone-wrap">
		<div class="mercado-panels-actions-wrap">
			<a class="mercado-close-btn mercado-close-panels" href="/">x</a>
		</div>
		<div class="mercado-panels"></div>
	</div>

	<!--header-->
	@include('header')

	<!--main-->
	@yield('main')

	<!--footer-->
	@include('footer')

	<script src="{{ asset('public/user/assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
	<script src="{{ asset('public/user/assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
	<script src="{{ asset('public/user/assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/user/assets/js/jquery.flexslider.js') }}"></script>
	<script src="{{ asset('public/user/assets/js/chosen.jquery.min.js') }}"></script>
	<script src="{{ asset('public/user/assets/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('public/user/assets/js/jquery.countdown.min.js') }}"></script>
	<script src="{{ asset('public/user/assets/js/jquery.sticky.js') }}"></script>
	<script src="{{ asset('public/user/assets/js/functions.js') }}"></script>
	<script src="{{ asset('public/user/assets/js/sweetalert.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('.add-to-cart').click(function() {
				var id = $(this).data('id_product');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_thumbnail = $('.cart_product_thumbnail_' + id).val();
				var cart_product_quantity = $('.cart_product_quantity_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var _token = $('input[name="_token"]').val();

				$.ajax({
					url: '{{url("add-cart-ajax")}}',
					method: 'POST',
					data: {
						cart_product_id: cart_product_id,
						cart_product_name: cart_product_name,
						cart_product_thumbnail: cart_product_thumbnail,
						cart_product_quantity: cart_product_quantity,
						cart_product_price: cart_product_price,
						_token: _token
					},
					success: function(data) {
						swal({
								title: "???? th??m s???n ph???m v??o gi??? h??ng",
								text: "B???n c?? th??? mua h??ng ti???p ho???c t???i gi??? h??ng ????? ti???n h??nh thanh to??n",
								showCancelButton: true,
								cancelButtonText: "Xem ti???p",
								confirmButtonClass: "btn-success",
								confirmButtonText: "??i ?????n gi??? h??ng",
								closeOnConfirm: false
							},
							function() {
								window.location.href = "{{route('showCart')}}";
							});

					}
				});
			});
		});
	</script>
	<!--Update Cart Data-->
	<script>
		$(document).ready(function() {
			$('#applyPromoCode').click(function() {
				// l???y gi?? tr???
				var promoCode = $('#promoCode').val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{url('promo-to-cart')}}",
					method: "POST",
					data: {
						promoCode: promoCode,
						_token: _token
					},
					success: function(data) {
						if (data == "not_found") {
							swal({
								title: "???? x???y ra l???i",
								text: "Kh??ng t??m th???y m?? gi???m gi??!",
								type: "warning",
								confirmButtonClass: "btn-danger",
								confirmButtonText: "Yes!",
								closeOnConfirm: false
							});
							return false;
						} else {
							swal("Good job!", "??p d???ng m?? gi???m th??nh c??ng!", "success");
							var _html = '' + data + '??';
							$('.total_price').html(_html);
						}
					}
				});

			});
			$('.clearCart').click(function() {
				// l???y gi?? tr???
				var clearcart = $('#clearAll').val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{url('delete-to-cart')}}",
					method: "POST",
					data: {
						clearcart: clearcart,
						_token: _token
					},
					success: function(data) {
						if (data == "clear") {
							var _html = '<center><span class="text-danger" style="font-size: 20px;">Gi??? h??ng ??ang tr???ng ????????</span></center>';
							$('#result').html(_html);
						}
					}
				});

			});
			$('.deleteCart').click(function() {
				// l???y gi?? tr???
				var product_id = $(this).data('deletecart');
				var _token = $('input[name="_token"]').val();

				$.ajax({
					url: "{{url('delete-to-cart')}}",
					method: "POST",
					data: {
						product_id: product_id,
						_token: _token
					},
					success: function(data) {
						if (data == "clear") {
							var _html = '<center><span class="text-danger" style="font-size: 20px;">Gi??? h??ng ??ang tr???ng ????????</span></center>';
							$('#result').html(_html);
						} else {
							var _html = '' + data + '??';
							$('#total_price').html(_html);
							$('.total_price').html(_html);
						}
					}
				});

			});
			$('.qtyPlus').click(function() {
				// l???y gi?? tr???
				var product_id = $(this).data('product_id');
				var quantity = $('.qty-input_' + product_id).val();
				var new_qty = parseInt(quantity) + 1;
				var _token = $('input[name="_token"]').val();

				$.ajax({
					url: "{{url('update-to-cart')}}",
					method: "POST",
					data: {
						product_id: product_id,
						quantity: new_qty,
						_token: _token
					},
					success: function(data) {
						var obj = JSON.parse(data);
						for (var i = 0; i < 1; i++) {
							var subtotal = obj['subtotal'];
							var total = obj['total'];
						}
						var _html = '<p class="price">' + subtotal + '??</p>';
						var _html1 = '' + total + '??';
						$('.sub-total_' + product_id).html(_html);
						$('#total_price').html(_html1);
						$('.total_price').html(_html1);
					}
				});

			});
			$('.qtyMinus').click(function() {
				var product_id = $(this).data('product_id');
				var quantity = $('.qty-input_' + product_id).val();
				var _token = $('input[name="_token"]').val();
				if (quantity <= 1) {
					swal({
						title: "???? x???y ra l???i",
						text: "S??? l?????ng ph???i t??? 1 tr??? l??n!",
						type: "warning",
						confirmButtonClass: "btn-danger",
						confirmButtonText: "Yes!",
						closeOnConfirm: false
					});
					return false;
				} else {
					new_qty = parseInt(quantity) - 1;
					$.ajax({
						url: '{{url("update-to-cart")}}',
						method: 'POST',
						data: {
							product_id: product_id,
							quantity: new_qty,
							_token: _token
						},
						success: function(data) {
							var obj = JSON.parse(data);
							for (var i = 0; i < 1; i++) {
								var subtotal = obj['subtotal'];
								var total = obj['total'];
							}
							var _html = '<p class="price">' + subtotal + '??</p>';
							var _html1 = '' + total + '??';
							$('.sub-total_' + product_id).html(_html);
							$('#total_price').html(_html1);
							$('.total_price').html(_html1);
						}
					});
				}
			});
		});
	</script>

	<script>
		$('#keywords').keyup(function(){
			var query = $(this).val();
			if(query != '')
			{
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url:"{{url('search')}}",
					method:"POST",
					data:{
						query:query, _token:_token
					},	
					success: function(data){
						$('#resultSearch').fadeIn();
						$('#resultSearch').html(data);
					}		
				});
			}else{
				$('#resultSearch').fadeOut();
			}
		});
		$(document).on('click', 'li', function(){
			$('#keywords').val($(this).text());
			$('#resultSearch').fadeOut();
		});
	</script>
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
	<script>
		var usd = document.getElementById("vnd_to_usd").value;
		paypal.Button.render({
			// Configure environment
			env: 'sandbox',
			client: {
				sandbox: 'AUA_AeaGEmISztZ1Rh_bI1mPry3LbvsUNFq66Z6KdouWc1vpAZ33uV7JznE3jDK8rw4rMhTcU9FWbvd1',
				production: 'demo_production_client_id'
			},
			// Customize button (optional)
			locale: 'en_US',
			style: {
				size: 'small',
				color: 'gold',
				shape: 'pill',
			},

			// Enable Pay Now checkout flow (optional)
			commit: true,

			// Set up a payment
			payment: function(data, actions) {
				return actions.payment.create({
					transactions: [{
						amount: {
							total: `${usd}`,
							currency: 'USD'
						}
					}]
				});
			},
			// Execute the payment
			onAuthorize: function(data, actions) {
				return actions.payment.execute().then(function() {
					// Show a confirmation message to the buyer
					window.alert('C???m ??n b???n ???? mua h??ng t???i Bookstore!');
				});
			}
		}, '#paypal-button');
	</script>
</body>

</html>