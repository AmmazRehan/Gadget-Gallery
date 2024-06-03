@extends('front/layout')
@section('page_title','Category')
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
			<div id="aside" class="col-md-3">
				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Categories</h3>
					<div class="checkbox-filter">
						@foreach($category_left as $cat_left)
						@if ($slug == $cat_left->category_slug)
						<div class="input-checkbox" style="position: relative;">
							
							<a href="{{url('category/'.$cat_left->category_slug)}}"  style="text-decoration: none; padding: 5px; border: 2px solid transparent; color:rgb(190, 57, 57)">
							
								<span></span>
								{{$cat_left->category_name}}
							
							</a>
						</div>
						@else
						<div class="input-checkbox" style="position: relative;">
							
							<a href="{{url('category/'.$cat_left->category_slug)}}" style="text-decoration: none; padding: 5px; border: 2px solid transparent;">
							
								<span></span>
								{{$cat_left->category_name}}
							
							</a>
						</div>

						@endif
						@endforeach

					
					</div>
				</div>
				<!-- /aside Widget -->

				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Price</h3>
					<div class="price-filter">
						<div id="price-slider"></div>
						<div class="input-number price-min">
							<input id="price-min" type="number">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
						<span>-</span>
						<div class="input-number price-max">
							<input id="price-max" type="number">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
						<div class="container mt-5">
							<button type="button" onclick="sort_price_filter()" style="background-color: rgb(179, 46, 46); color: white; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer; border-radius: 5px;" class="filter-btn">
								Filter</button>
						</div>
					</div>
				</div>
				
				<!-- /aside Widget -->

				<!-- aside Widget -->
			

		
				<!-- /aside Widget -->
			</div>
			<!-- /ASIDE -->

			<!-- STORE -->
			<div id="store" class="col-md-9">
				<!-- store top filter -->
				<div class="store-filter clearfix">
					<div class="store-sort">
						<label>
							Sort By:
							<select class="input-select" onchange="sort_by()" id="sort_by">
								<option Selected value="">Default</option>
								<option value="name">Name</option>
								<option value="price_desc">Price- Desc</option>
								<option value="price_asc">Price- Asc </option>
								<option value="date">Date </option>
								
							</select>
							{{$sort_txt}}
						</label>

						
					</div>
					<ul class="store-grid" >
						<li class="active"><i class="fa fa-th"></i></li>
						<li><a href="#"><i class="fa fa-th-list"></i></a></li>
					</ul>
				</div>
				<!-- /store top filter -->

				<!-- store products -->
				<div class="row">
					<!-- product -->
					@if(isset($product[0]))
					@foreach($product as $productArr)
					 
					   <figure>
						 <div class="col-md-4">
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


</form>

<form action="" id="categoryFilter">
    <input type="hidden" id="sort" name="sort" value="{{$sort}}">
	<input type="hidden" id="filter_price_start" name="filter_price_start">
	<input type="hidden" id="filter_price_end" name="filter_price_end" >
</form>

@endsection