@extends('front/layout')
@section('page_title',$product[0]->name)
@section('container')
@csrf
	<!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="{{asset('storage/media/'.$product[0]->image)}}" alt="">
                        </div>

                        @if (isset($product_images[$product[0]->id][0]))
                        @foreach($product_images[$product[0]->id] as $list)
 
                        <div class="product-preview">
                         <img src="{{asset('storage/media/'.$list->images)}}" alt="">
                     </div>
 
                        @endforeach
 
                        @endif

                        
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        

                       @if (isset($product_images[$product[0]->id][0]))
                       @foreach($product_images[$product[0]->id] as $list)

                       <div class="product-preview">
                        <img src="{{asset('storage/media/'.$list->images)}}" alt="">
                    </div>

                       @endforeach

                       @endif
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{$product[0]->name}}</h2>
                        
                        <div>
                            <h3 class="product-price">${{$product_attr[$product[0]->id][0]->price}} <del class="product-old-price">${{$product_attr[$product[0]->id][0]->mrp}}</del></h3><br>
                           <h5 class="">Model: <span class="product-available">{{$product[0]->model}}</span></h5>

                           @if($product[0]->lead_time != '')
                           <h5 class="">Delivery In: <span class="product-available">{{$product[0]->lead_time}}</span></h5>

                           @endif


                            <span class="product-available">In Stock</span>
                        </div>
                        <p>{!!$product[0]->short_description!!}</p>

                        <div class="product-options">
                            <div>
                            <b><label for="color_select">Size:</label></b>
                            
                            @foreach ($product_attr[$product[0]->id] as $color)
                                @if ($color->size != '')
                                    {{$color->size}}
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <b><label for="color_select">Color:</label></b>
                            
                                @foreach ($product_attr[$product[0]->id] as $color)
                                    @if ($color->color != '')
                                        {{$color->color}}
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="add-to-cart">
                            <div class="qty-label">
                                Qty
                                <div class="input-number">
                                    <select name="qty" id="qty">
                                        @for($i=1;$i<=10;$i++)
                                        <option value="{{$i}}">
                                            {{$i}}

                                        </option>
                                        @endfor
                                    </select>
                                </div>

                              
                                    
                                    </div>
                                    <a href="javascript:void(0)" onclick="add_to_cart('{{$product[0]->id}}')"><button class="add-to-cart-btn" ><i class="fa fa-shopping-cart"></i> add to cart</button></a>
                                    </div>
                                

                       

                        

                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                            <li><a data-toggle="tab" href="#tab2">Technical Specifications</a></li>
                            <li><a data-toggle="tab" href="#tab3">Warranty</a></li>
                            <li><a data-toggle="tab" href="#tab4">Reviews (3)</a></li>
                        </ul>
                        <!-- /product tab nav -->
                
                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{!! $product[0]->short_description !!}</p>
                                        <p>{!! $product[0]->description !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->
                
                            <!-- tab2 (Technical Specifications) -->
                            <div id="tab2" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{!! $product[0]->technical_specification !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab2 (Technical Specifications) -->

                            <!-- tab3 (Technical Specifications) -->
                            <div id="tab3" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{!! $product[0]->warranty !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab3 (Technical Specifications) -->
                
                            <!-- tab4 (Reviews) -->
                            <div id="tab4" class="tab-pane fade">
                               <div id="tab4" class="tab-pane fade in">
                                <div class="row">
                                    <!-- Rating -->
                                    <div class="col-md-3">
                                        <div id="rating">
                                            <div class="rating-avg">
                                                <span>4.5</span>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div style="width: 80%;"></div>
                                                    </div>
                                                    <span class="sum">3</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div style="width: 60%;"></div>
                                                    </div>
                                                    <span class="sum">2</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Rating -->

                                    <!-- Reviews -->
                                    <div class="col-md-6">
                                        <div id="reviews">
                                            <ul class="reviews">
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name">John</h5>
                                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                                        <div class="review-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name">John</h5>
                                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                                        <div class="review-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name">John</h5>
                                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                                        <div class="review-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                    </div>
                                                </li>
                                            </ul>
                                            <ul class="reviews-pagination">
                                                <li class="active">1</li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Reviews -->

                                    <!-- Review Form -->
                                    <div class="col-md-3">
                                        <div id="review-form">
                                            <form class="review-form">
                                                <input class="input" type="text" placeholder="Your Name">
                                                <input class="input" type="email" placeholder="Your Email">
                                                <textarea class="input" placeholder="Your Review"></textarea>
                                                <div class="input-rating">
                                                    <span>Your Rating: </span>
                                                    <div class="stars">
                                                        <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                                        <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                                        <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                                        <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                                        <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                                    </div>
                                                </div>
                                                <button class="primary-btn">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /Review Form -->
                                </div>
                            </div>
                            <!-- /tab3  -->
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- Section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">Related Products</h3>
                    </div>
                </div>

                <!-- product -->
                <div class="col-md-12 col-xs-6">
                    <div class="tab-pane fade in active" id="featured">
                        <ul class="aa-product-catg aa-featured-slider">
                          <!-- start single product item -->
                          
                          
                          @if(isset($related_product[0]))
                             @foreach($related_product as $productArr)
                              <li>
                                <figure>
                                  <div class="col-md-3">
                                      <div class="product">
                                          <div class="product-body">
                                              <a href="{{url('product/'.$productArr->slug)}}"><img width="100%" src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->name}}"></a>
                                              <h3 class="product-name"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h3>
                                              <h4 class="product-price">$ {{$related_product_attr[$productArr->id][0]->price}}<del class="product-old-price">$ {{$related_product_attr[$productArr->id][0]->mrp}}</del></h4>
                                          </div>
                                          <div class="add-to-cart">
                                              <a href="{{url('product/'.$productArr->slug)}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to cart</button></a>
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
                </div>
                <!-- /product -->

                

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div><br><br>
    <!-- /Section -->
<input type="hidden" id="qty" value="1"/>
<form action="" id="frmAddToCart">

    @csrf
    <input type="hidden" id="pqty" name="pqty">
    <input type="hidden" id="product_id" name="product_id">


</form>

@endsection