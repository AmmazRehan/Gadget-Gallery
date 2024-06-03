<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title')</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset('front_assets/css/bootstrap.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('front_assets/css/slick.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('front_assets/css/slick-theme.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('front_assets/css/nouislider.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('front_assets/css/font-awesome.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('front_assets/css/style.css')}}"/>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <script>
        var PRODUCT_IMAGE="{{asset('storage/media/')}}";
    </script>
</head>
<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
                    @if(session()->has('FRONT_USER_LOGIN')!=null)
                    <li><a href="{{url('/logout')}}"></i> Logout</a></li>
                   

                    @else
                    <li><a href="#" data-toggle="modal" data-target="#loginModal"><i class="fa fa-user-o"></i> Login</a></li>
                   

                    @endif

                    <li><a href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <div class="container">
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="{{url ('/')}}" class="logo">
                                <img src="{{asset('front_assets/img/abc.png')}}" width="110%" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form>
                                @csrf
                                <select class="input-select">
                                    <option value="0"> Category</option>
                                    {{-- @foreach($home_categories as $list)
                                    <option value="{{ $list->id }}"> {{ $list->category_name }}</option>
                                    @endforeach --}}
                                </select>
                                <input class="input" placeholder="Search here" id="search_str">
                                <button class="search-btn" type="button" onclick="funSearch()">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <div>
                                <a href="#">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Wishlist</span>
                                    <div class="qty">2</div>
                                </a>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            @php
                            $getaddtocarttotalitem=getaddtocarttotalitem();
                            $totalItem= count($getaddtocarttotalitem);
                            $totalprice=0;
                            @endphp
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" id="cartBox">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty"><span class="abcd">{{$totalItem}}</span></div>
                                </a>
                                @if($totalItem>0)
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                    @foreach($getaddtocarttotalitem as $cartlist)
                                    @php
                                    $totalprice=$totalprice+($cartlist->price*$cartlist->qty);
                                    @endphp
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{asset('storage/media/'.$cartlist->image)}}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">{{$cartlist -> name}}</a></h3>
                                                <h4 class="product-price"><span class="qty">{{$cartlist -> qty}}x</span>{{$cartlist -> price}}$</h4>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                    <div class="cart-summary">
                                        <small>{{$totalItem}} Item(s) selected</small>
                                        <h5>SUBTOTAL: {{$totalprice}}$</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="{{url('/cart')}}">View Cart</a>
                                        <a href="{{url('/checkout')}}">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toggle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toggle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
            </div>
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <nav id="navigation">
        <div class="container">
            <div id="responsive-nav">
                <ul class="main-nav nav navbar-nav">
                    {!! getTopNavCat() !!}
                </ul>
            </div>
        </div>
    </nav>
    <!-- /NAVIGATION -->

    @section('container')
    @show

    @php
    if (isset($_COOKIE['login_email']) && isset($_COOKIE['login_pwd'])) {
    $login_email = $_COOKIE['login_email'];
    $login_pwd = $_COOKIE['login_pwd'];
    $is_remember = 'checked="checked"';
}
    else {
        $login_email='';
        $login_pwd='';
        $is_remember = '';
    }
    @endphp
    <!-- Login/Register Modal -->
    <div id="loginModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login or Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmLogin">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="str_login_email" placeholder="Enter email" value="{{$login_email}}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="str_login_password" placeholder="Password" value="{{$login_pwd}}">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="rememberme" name="rememberme" {{ $is_remember}}>
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <button type="submit" id="btnLogin" style="background-color: rgb(170, 36, 36); color: white; border-radius: 5px;">Login</button>
                        <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal" style="border-radius: 5px;">Cancel</button>
                        <div id="login_msg"></div>
                        @csrf
                    </form>
                    <hr>
                    <p>Don't have an account? <a href="{{url('registration')}}">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer id="footer">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <p>
                                Gadget Gallery is an e-commerce website specializing in the sale of the latest and most innovative gadgets and electronic devices</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+9246-5877387</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>Tahazafar112@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                
                                <li><a href="#">Laptops</a></li>
                                <li><a href="#">Consoles</a></li>
                                <li><a href="#">Mobile</a></li>
                                <li><a href="#">Games</a></li>
                                
                                
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="{{url('terms')}}">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="bottom-footer" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('front_assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('front_assets/js/slick.min.js')}}"></script>
    <script src="{{asset('front_assets/js/nouislider.min.js')}}"></script>
    <script src="{{asset('front_assets/js/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('front_assets/js/main.js')}}"></script>
    <script>
        jQuery('#frmLogin').submit(function(e){
            jQuery('#login_msg').html('');
            e.preventDefault();
            
            jQuery.ajax({
                url: 'login_process',
                data: jQuery('#frmLogin').serialize(),
                type: 'post',
                success: function(result){
                    if(result.status == "error"){
                        jQuery('#login_msg').html(result.msg);
                    }
                    
                    if(result.status == "success"){
                       window.location.href = '/';
                    }
                }
            });
        });
    </script>
</body>
</html>
