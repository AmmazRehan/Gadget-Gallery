(function($) {
	"use strict";

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	});

	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});

	// Products Slick
	$('.products-slick').each(function() {
		var $this = $(this),
			$nav = $this.attr('data-nav');

		$this.slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			infinite: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
			responsive: [{
				breakpoint: 991,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				}
			}]
		});
	});

	// Products Widget Slick
	$('.products-widget-slick').each(function() {
		var $this = $(this),
			$nav = $this.attr('data-nav');

		$this.slick({
			infinite: true,
			autoplay: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});

	// Product Main img Slick
	$('#product-main-img').slick({
		infinite: true,
		speed: 300,
		dots: false,
		arrows: true,
		fade: true,
		asNavFor: '#product-imgs',
	});

	// Product imgs Slick
	$('#product-imgs').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: true,
		centerMode: true,
		focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
		asNavFor: '#product-main-img',
		responsive: [{
			breakpoint: 991,
			settings: {
				vertical: false,
				arrows: false,
				dots: true,
			}
		}]
	});

	// Product img zoom
	var zoomMainProduct = document.getElementById('product-main-img');
	if (zoomMainProduct) {
		$('#product-main-img .product-preview').zoom();
	}

	// Input number
	$('.input-number').each(function() {
		var $this = $(this),
			$input = $this.find('input[type="number"]'),
			up = $this.find('.qty-up'),
			down = $this.find('.qty-down');

		down.on('click', function () {
			var value = Math.max(parseInt($input.val()) - 1, 1);
			$input.val(value);
			$input.change();
			updatePriceSlider($this, value);
		});

		up.on('click', function () {
			var value = parseInt($input.val()) + 1;
			$input.val(value);
			$input.change();
			updatePriceSlider($this, value);
		});
	});

	var priceInputMax = document.getElementById('price-max'),
		priceInputMin = document.getElementById('price-min');

	priceInputMax.addEventListener('change', function(){
		updatePriceSlider($(this).parent(), this.value);
	});

	priceInputMin.addEventListener('change', function(){
		updatePriceSlider($(this).parent(), this.value);
	});

	function updatePriceSlider(elem, value) {
		if (elem.hasClass('price-min')) {
			priceSlider.noUiSlider.set([value, null]);
		} else if (elem.hasClass('price-max')) {
			priceSlider.noUiSlider.set([null, value]);
		}
	}

	// Price Slider
	var priceSlider = document.getElementById('price-slider');
	if (priceSlider) {
		noUiSlider.create(priceSlider, {
			start: [1, 4999],
			connect: true,
			step: 1,
			range: {
				'min': 1,
				'max': 4999
			}
		});

		priceSlider.noUiSlider.on('update', function(values, handle) {
			var value = values[handle];
			handle ? priceInputMax.value = value : priceInputMin.value = value;
		});
	}

})(jQuery);

function add_to_cart(id) {
	jQuery('#product_id').val(id);
	jQuery('#pqty').val(jQuery('#qty').val());
	jQuery.ajax({
		url: '/add_to_cart',
		type: 'post',
		data: jQuery('#frmAddToCart').serialize(),
		success: function(result) {
			var totalPrice = 0;
			alert('Product' + result.msg);
			if (result.total_item == 0) {
				jQuery('.abcd').html('0');
				jQuery('.cart-dropdown').remove();
			} else {
				jQuery('.abcd').html(result.total_item);
				var html = '<div class="cart-dropdown">';
				jQuery.each(result.data, function(ARRkey, ARRvalue) {
					totalPrice += parseInt(ARRvalue.qty) * parseInt(ARRvalue.price);
					html += '<div class="product-widget"><div class="product-img"><img src="' + PRODUCT_IMAGE + '/' + ARRvalue.image + '" alt=""></div><div class="product-body"><h3 class="product-name"><a href="#">' + ARRvalue.name + '</a></h3><h4 class="product-price"><span class="qty">' + ARRvalue.qty + 'x</span>' + ARRvalue.price + '$</h4></div></div>';
				});
				html += '<div class="cart-summary"><h5>SUBTOTAL: ' + totalPrice + '$</h5></div>';
				html += '<div class="cart-btns"><a href="cart">View Cart</a><a href="checkout">Checkout <i class="fa fa-arrow-circle-right"></i></a></div></div>';
				jQuery('#cartBox').after(html);
			}
		}
	});
}

function updateQTY(pid, attr_id, price) {
	var qty = jQuery('#qty' + attr_id).val();
	jQuery('#qty').val(qty);
	add_to_cart(pid);
	jQuery('#total_price_' + attr_id).html('$' + price * qty);
}

function deleteCartProduct(pid, attr_id) {
	jQuery('#qty').val(0);
	add_to_cart(pid);
	jQuery('#cart_box' + attr_id).hide();
}

function sort_by() {
	var sort_by = jQuery('#sort_by').val();
	jQuery('#sort').val(sort_by);
	jQuery('#categoryFilter').submit();
}

function sort_price_filter() {
	jQuery('#filter_price_start').val(jQuery('#price-min').val());
	jQuery('#filter_price_end').val(jQuery('#price-max').val());
	jQuery('#categoryFilter').submit();
}

function funSearch() {
	var search_str = jQuery('#search_str').val();
	if (search_str !== '') {
		window.location.href = '/search/' + search_str;
	}
}
