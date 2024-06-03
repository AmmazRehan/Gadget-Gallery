@extends('front/layout')
@section('page_title','Search')
@section('container')
@csrf

<style>
    .input-checkbox a:hover {
        border-color: red;
        text-decoration: underline;
        text-decoration-color: red;
    }
</style>
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			
			<!-- /ASIDE -->

			<!-- STORE -->
			<div id="store" class="col-md-12">
				<!-- store top filter -->
				
				<!-- /store top filter -->

				<!-- store products -->
				<div class="row">
					<!-- product -->
					@if(isset($product[0]))
					@foreach($product as $productArr)
					 
					   <figure>
						 <div class="col-md-3">
							 <div class="product">
								 <div class="product-body">
									 <a href="{{url('product/'.$productArr->slug)}}"><img width="100%" src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
									 <h3 class="product-name"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h3>
									 <h4 class="product-price">$ {{$product_attribute[$productArr->id][0]->price}}<del class="product-old-price">$ {{$product_attribute[$productArr->id][0]->mrp}}</del></h4>
								 </div>
								 <div class="add-to-cart">
									 <a href="{{url('product/'.$productArr->slug)}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> See More</button></a>
								 </div>
							 </div>
						 </div>
					   </figure>                          
					
					 @endforeach    
					 @else
					
					   <figure>
						 No data found
					   <figure>
					
						
					 @endif   
					<!-- /product -->
				</div>
				
				<!-- /store products -->

				<!-- store bottom filter -->
				<div class="store-filter clearfix">
					<span class="store-qty">Showing 20-100 products</span>
					<ul class="store-pagination">
						<li class="active">1</li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
					</ul>
				</div>
				<!-- /store bottom filter -->
			</div>
			<!-- /STORE -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- NEWSLETTER -->
<div id="newsletter" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="newsletter">
					<p>Sign Up for the <strong>NEWSLETTER</strong></p>
					<form>
						<input class="input" type="email" placeholder="Enter Your Email">
						<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
					</form>
					<ul class="newsletter-follow">
						<li>
							<a href="#"><i class="fa fa-facebook"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-twitter"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-instagram"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-pinterest"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /NEWSLETTER -->


<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>


<input type="hidden" id="qty" value="1"/>
<form action="" id="frmAddToCart">

    @csrf
    <input type="hidden" id="pqty" name="pqty">
    <input type="hidden" id="product_id" name="product_id">




@endsection