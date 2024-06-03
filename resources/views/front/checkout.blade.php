@extends('front/layout')
@section('page_title', 'Checkout')
@section('container')

<style>
    .coupon-section {
        margin-top: 20px;
    }
    #coupon_code {
        width: 80%;
        margin: 0 auto;
    }
    .custom-btn {
        margin-top: 10px;
        width: 30%; /* Adjust the width to make the button smaller */
        background-color: #b12323; /* Custom button color */
        border-color: #b12323;
    }
    .custom-btn:hover {
        background-color: #b12323; /* Custom button color */
        border-color: #b12323;
    }
</style>

<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <form id="frmPlaceOrder">
                @csrf
                <div class="col-md-7">
                    <!-- Billing Details -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Billing address</h3>
                        </div>

                        @if(session()->has('FRONT_USER_LOGIN')==null)
                        <!-- Login Button -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
                            Login
                        </button>

                        <!-- Login Modal -->
                        @php
                            $login_email = isset($_COOKIE['login_email']) ? $_COOKIE['login_email'] : '';
                            $login_pwd = isset($_COOKIE['login_pwd']) ? $_COOKIE['login_pwd'] : '';
                            $is_remember = isset($_COOKIE['login_email']) && isset($_COOKIE['login_pwd']) ? 'checked="checked"' : '';
                        @endphp
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
                                                <input type="checkbox" class="form-check-input" id="rememberme" name="rememberme" {{ $is_remember }}>
                                                <label class="form-check-label" for="rememberme">Remember me</label>
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
                        @else
                        <div class="form-group">
                            <input class="input" type="text" name="fname" placeholder="First Name" value="{{$customers['fname']}}">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="lname" placeholder="Last Name" value="{{$customers['lname']}}">
                        </div>
                        <div class="form-group">
                            <input class="input" type="email" name="email" placeholder="Email" value="{{$customers['email']}}">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="address" placeholder="Address" value="{{$customers['address']}}">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="city" placeholder="City" value="{{$customers['city']}}">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="state" placeholder="State" value="{{$customers['state']}}">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="Zip" placeholder="ZIP Code" value="{{$customers['Zip']}}">
                        </div>
                        <div class="form-group">
                            <input class="input" type="tel" name="tel" placeholder="Telephone" value="{{$customers['mobile']}}">
                        </div>
                        @endif
                    </div>
                    <!-- /Billing Details -->
                </div>

                <!-- Order Details -->
                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Your Order</h3>
                    </div>
                    <div class="order-summary">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>PRODUCT</center></th>
                                    <th><center>QUANTITY</center></th>
                                    <th><center>TOTAL</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($cart_data as $list)
                                @php 
                                    $totalPrice += $list->price * $list->qty;
                                @endphp
                                <tr>
                                    <td><center>{{$list->name}}</center></td>
                                    <td><center>{{$list->qty}}</center></td>
                                    <td><center>{{$list->price * $list->qty}} $</center></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="hide show_coupon_box">
                                    <th>Coupon Code <a href="javascript:void(0)" onclick="remove_coupon_code()" class="remove_coupon_code_link" style="font-weight: bold;color:#b12323">Remove</a></th>
                                    <td id="coupon_code_str"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="coupon-section text-center">
                            <input type="text" class="form-control apply_coupon_code_box" id="coupon_code" placeholder="Enter coupon code" name="coupon_code">
                            <button type="button" class="btn btn-primary custom-btn apply_coupon_code_box" id="apply_coupon" onclick="applyCouponCode()">Apply Coupon</button>
                            <div id="coupon_code_msg" style="color: #b12323"></div>
                        </div>
                       
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div id="total_price" class="order-total" style="font-weight: bold"><strong>{{$totalPrice}} $</strong></div>
                        </div>
                    </div>
                    <!-- Payment Method -->
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment_type" id="COD" value="COD">
                            <label for="COD">
                                <span></span>
                                Cash On Delivery
                            </label>
                        </div>
                       
                        <div class="input-radio">
                            <input type="radio" name="payment_type" id="instamojo" value="Gateway">
                            <label for="instamojo">
                                <span></span>
                                Via Stripe
                            </label>
                        </div>
                    </div>
                    <input type="submit"  class=" primary-btn " id="btnPlaceOrder" value="Place Order"> 
                    <div id="order_place_msg" style="color: red;"></div>
                </div>
                <!-- /Order Details -->
            </form>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
function applyCouponCode(){
    jQuery('#coupon_code_msg').html('');
    var coupon_code = jQuery('#coupon_code').val();
    if(coupon_code != ''){
        jQuery.ajax({
            type: 'post',
            url: '/apply_coupon_code',
            data: {
                coupon_code: coupon_code,
                _token: jQuery("[name='_token']").val()
            },
            success: function(result){
                console.log(result);  // Log the result for debugging
                if(result.status == 'success'){
                    jQuery('.show_coupon_box').removeClass('hide');
                    jQuery('#coupon_code_str').html(coupon_code);
                    jQuery('#total_price').html('$ '+result.totalPrice);
                    jQuery('.apply_coupon_code_box').hide();
                }
                jQuery('#coupon_code_msg').html(result.msg);
            },
            error: function(xhr, status, error){
                console.error(xhr, status, error);  // Log the error for debugging
                jQuery('#coupon_code_msg').html('An error occurred while applying the coupon. Please try again.');
            }
        });
    } else {
        jQuery('#coupon_code_msg').html('Please enter coupon code');
    }
}

function remove_coupon_code(){
    jQuery('#coupon_code_msg').html('');
    var coupon_code = jQuery('#coupon_code').val();
    jQuery('#coupon_code').val('');
    if(coupon_code != ''){
        jQuery.ajax({
            type: 'post',
            url: '/remove_coupon_code',
            data: {
                coupon_code: coupon_code,
                _token: jQuery("[name='_token']").val()
            },
            success: function(result){
                console.log(result);  // Log the result for debugging
                if(result.status == 'success'){
                    jQuery('.show_coupon_box').addClass('hide');
                    jQuery('#coupon_code_str').html('');
                    jQuery('#total_price').html('$'+result.totalPrice);
                    jQuery('.apply_coupon_code_box').show();
                }
                jQuery('#coupon_code_msg').html(result.msg);
            },
            error: function(xhr, status, error){
                console.error(xhr, status, error);  // Log the error for debugging
                jQuery('#coupon_code_msg').html('An error occurred while removing the coupon. Please try again.');
            }
        });
    }
}

jQuery(document).ready(function(){
    jQuery('#frmPlaceOrder').on('submit', function(e){
        e.preventDefault();  // Prevent the default form submission
        jQuery('#order_place_msg').html("Please wait...");

        var formData = jQuery('#frmPlaceOrder').serialize();

        if (jQuery('#instamojo').is(':checked')) {
            // Send form data to the server and then redirect to Stripe page
            jQuery.ajax({
                url: '/place_order',  // First, send data to place_order
                type: 'post',
                data: formData,
                success: function(result){
                    console.log(result);  // Log the result for debugging
                    if(result.status == 'success'){
                        // Redirect to the Stripe page with the order_id or any required data
                        var order_id = result.order_id;  // Assuming the server returns the order_id
                        window.location.href = "/stripe?order_id=" + order_id;
                    } else {
                        jQuery('#order_place_msg').html(result.msg);
                    }
                },
                error: function(xhr, status, error){
                    console.error(xhr, status, error);  // Log the error for debugging
                    jQuery('#order_place_msg').html('An error occurred. Please try again.');
                }
            });
        } else {
            // Handle other payment types
            jQuery.ajax({
                url: '/place_order',
                type: 'post',
                data: formData,
                success: function(result){
                    console.log(result);  // Log the result for debugging
                    if(result.status == 'success'){
                        window.location.href = "/order_placed";
                    } else {
                        jQuery('#order_place_msg').html(result.msg);
                    }
                },
                error: function(xhr, status, error){
                    console.error(xhr, status, error);  // Log the error for debugging
                    jQuery('#order_place_msg').html('An error occurred. Please try again.');
                }
            });
        }
    });
});




</script>
