@extends('front/layout')
@section('page_title','Gadget Gallery')
@section('container')

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					@foreach ($home_categories as $list)
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img width="50%" src="{{asset('storage/media/category/'.$list -> category_image)}}" alt="">
							</div>
							<div class="shop-body">
							<h3>{{$list -> category_name}}</h3>
								<a href="{{url('category/'.$list -> category_slug)}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					@endforeach
					<!-- /shop -->

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
		
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">New Products</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									@foreach($home_categories as $list)
										<li class=""><a href="#cat{{$list->id}}" data-toggle="tab">{{$list->category_name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->
		
					<!-- Products tab & slick -->
					<section id="aa-product" class="col-md-12">
						<div class="aa-product-area">
							<div class="aa-product-inner">
								<!-- Tab panes -->
								<div class="tab-content">
									<!-- Start men product category -->
									@php
										$loop_count = 1;
									@endphp
									@foreach($home_categories as $list)
										@php
											$cat_class = "";
											if($loop_count == 1){
												$cat_class = "in active"; 
												$loop_count++;
											}
										@endphp
										<div class="tab-pane fade {{$cat_class}}" id="cat{{$list->id}}">
											<div class="row">
												@if(isset($home_categories_product[$list->id][0]))
													@foreach($home_categories_product[$list->id] as $productArr)
														<div class="col-md-4">
															<div class="product">
																<div class="product-body">
																	<a href="{{url('product/'.$productArr->slug)}}"><img width="100%" src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
																	<h3 class="product-name"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h3>
																	<h4 class="product-price">$ {{$home_product_attr[$productArr->id][0]->price}}<del class="product-old-price">$ {{$home_product_attr[$productArr->id][0]->mrp}}</del></h4>
																</div>
																<div class="add-to-cart">
																	<a href="{{url('product/'.$productArr->slug)}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> See More</button></a>
																</div>
															</div>
														</div>
													@endforeach    
												@else
													<div class="col-md-12">
														<p>No data found</p>
													</div>
												@endif
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
		



		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Days</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Hours</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Mins</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Secs</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">hot deal this week</h2>
							<p>New Collection Up to 50% OFF</p>
							<a class="primary-btn cta-btn" href="#">Shop now</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<section id="aa-popular-category">
			<div class="container">
			  <div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">New Products</h3>
						<div class="section-nav">
							<ul class="section-tab-nav tab-nav">
								<li class="active"><a href="#featured" data-toggle="tab">Featured</a></li>
             				   <li><a href="#tranding" data-toggle="tab">Tranding</a></li>
               					 <li><a href="#discounted" data-toggle="tab">Discounted</a></li> 
							</ul>
						</div>
					</div>
				</div>
					  <!-- Tab panes -->
					  <div class="tab-content">
						<!-- Start men featured category -->
						<div class="tab-pane fade in active" id="featured">
						  <ul class="aa-product-catg aa-featured-slider">
							<!-- start single product item -->
							
							
							@if(isset($home_featured_product[$list->id][0]))
							   @foreach($home_featured_product[$list->id] as $productArr)
								<li>
								  <figure>
									<div class="col-md-4">
										<div class="product">
											<div class="product-body">
												<a href="{{url('product/'.$productArr->slug)}}"><img width="100%" src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
												<h3 class="product-name"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h3>
												<h4 class="product-price">$ {{$home_featured_product_attr[$productArr->id][0]->price}}<del class="product-old-price">$ {{$home_featured_product_attr[$productArr->id][0]->mrp}}</del></h4>
											</div>
											<div class="add-to-cart">
												<a href="{{url('product/'.$productArr->slug)}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> See More</button></a>
											</div>
										</div>
									</div>
								  </figure>                          
								</li>  
								@endforeach    
								@else
								<li>
								  <figure>
									No data found
								  <figure>
								<li>
								@endif                                                                                   
						  </ul>
						</div>
						<!-- / popular product category -->
						
						<!-- start tranding product category -->
						<div class="tab-pane fade" id="tranding">
						 <ul class="aa-product-catg aa-tranding-slider">
							<!-- start single product item -->
							@if(isset($home_tranding_product[$list->id][0]))
							   @foreach($home_tranding_product[$list->id] as $productArr)
								<li>
								  <figure>
									<div class="col-md-4">
										<div class="product">
											<div class="product-body">
												<a href="{{url('product/'.$productArr->slug)}}"><img width="100%" src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
												<h3 class="product-name"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h3>
												<h4 class="product-price">$ {{$home_tranding_product_attr[$productArr->id][0]->price}}<del class="product-old-price">$ {{$home_tranding_product_attr[$productArr->id][0]->mrp}}</del></h4>
											</div>
											<div class="add-to-cart">
												<a href="{{url('product/'.$productArr->slug)}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>See More</button></a>
											</div>
										</div>
									</div>
								  </figure>                          
								</li>  
								@endforeach    
								@else
								<li>
								  <figure>
									No data found
								  <figure>
								<li>
								@endif                                                                                       
						  </ul>
						</div>
						<!-- / featured product category -->
		
						<!-- start discounted product category -->
						<div class="tab-pane fade" id="discounted">
						  <ul class="aa-product-catg aa-discounted-slider">
							<!-- start single product item -->
							
							@if(isset($home_discounted_product[$list->id][0]))
							   @foreach($home_discounted_product[$list->id] as $productArr)
								<li>
								  <figure>
									<div class="col-md-4">
										<div class="product">
											<div class="product-body">
												<a href="{{url('product/'.$productArr->slug)}}"><img width="100%" src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
												<h3 class="product-name"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h3>
												<h4 class="product-price">$ {{$home_discounted_product_attr[$productArr->id][0]->price}}<del class="product-old-price"> $ {{$home_discounted_product_attr[$productArr->id][0]->mrp}}</del></h4>
											</div>
											<div class="add-to-cart">
												<a href="{{url('product/'.$productArr->slug)}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> See More</button></a>
											</div>
										</div>
									</div>
								  </figure>                          
								</li>  
								@endforeach    
								@else
								<li>
								  <figure>
									No data found
								  </figure>
								<li>
								@endif                                                                                     
						  </ul>
						</div>
						<!-- / latest product category -->              
					  </div>
					</div>
				  </div> 
				</div>
			  </div>
			</div>
		  </section><br><br>
		  <!-- / popular section -->
		
		
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Featured Items</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							@if(isset($home_featured_product[$list->id][0]))
							@foreach($home_featured_product[$list->id] as $productArr)
							<div>
								<!-- product widget -->
								
								<div class="product-widget">
								
									<div class="product-img">
										<a href="{{url('product/'.$productArr->slug)}}"><img width="100%" src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
									</div>
									<div class="product-body">
										<p class="product-category">{{$list->category_name}}</p>
										<h3 class="product-name"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h3>
										<h4 class="product-price">$ {{$home_featured_product_attr[$productArr->id][0]->price}}<del class="product-old-price">$ {{$home_featured_product_attr[$productArr->id][0]->mrp}}</del></h4>
									</div>
									
								</div>
								
							</div>
							@endforeach
									@endif

							
						</div>
					</div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Hot Items</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							@if(isset($home_tranding_product[$list->id][0]))
							@foreach($home_tranding_product[$list->id] as $productArr)
							<div>
								<!-- product widget -->
								
								<div class="product-widget">
								
									<div class="product-img">
										<a href="{{url('product/'.$productArr->slug)}}"><img width="100%" src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
									</div>
									<div class="product-body">
										<p class="product-category">{{$list->category_name}}</p>
										<h3 class="product-name"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h3>
										<h4 class="product-price">$ {{$home_tranding_product_attr[$productArr->id][0]->price}}<del class="product-old-price">$ {{$home_tranding_product_attr[$productArr->id][0]->mrp}}</del></h4>
									</div>
									
								</div>
								
							</div>
							@endforeach
									@endif

							
						</div>
					</div>

					<div class="clearfix visible-sm visible-xs"></div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">On Sale</h4>
							<div class="section-nav">
								<div id="slick-nav-5" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							@if(isset($home_discounted_product[$list->id][0]))
							@foreach($home_discounted_product[$list->id] as $productArr)
							<div>
								<!-- product widget -->
								
								<div class="product-widget">
								
									<div class="product-img">
										<a href="{{url('product/'.$productArr->slug)}}"><img width="100%" src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
									</div>
									<div class="product-body">
										<p class="product-category">{{$list->category_name}}</p>
										<h3 class="product-name"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h3>
										<h4 class="product-price">$ {{$home_discounted_product_attr[$productArr->id][0]->price}}<del class="product-old-price">$ {{$home_discounted_product_attr[$productArr->id][0]->mrp}}</del></h4>
									</div>
									
								</div>
								
							</div>
							@endforeach
									@endif

							
						</div>
					</div>

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

		 <!-- Client Brand -->
		
		<!-- Products tab & slick -->
		<div class="col-md-12">
			<h3 style="color: white">Famous Brands</h3>
			<div class="row">
				<div class="products-tabs">
					<!-- tab -->
					<div id="tab2" class="tab-pane fade in active">
						<div class="products-slick" data-nav="#slick-nav-2">
							<!-- product -->
							
							@foreach($home_brand as $list)
							<div class="product">
								<div class="col-md-12">
									<div class="product-img">
									  <img width="100%" src="{{asset('storage/media/brand/'.$list->image)}}" alt="{{$list->name}}">
									</div>
								</div>
							</div>
								@endforeach
								
							</div>
							<!-- /product -->

					
						</div>
						<div id="slick-nav-2" class="products-slick-nav"></div>
					</div>
					<!-- /tab -->
				</div>
			</div>
		</div>
		<!-- /Products tab & slick -->
		  <!-- / Client Brand -->
@endsection