@extends('front/layout')
@section('page_title','Registration')
@section('container')

<style>

	h2 {
		text-align: center;
		margin-bottom: 20px;
	}
	label {
		display: block;
		margin: 10px 0 5px;
	}
	input[type="text"], input[type="email"], input[type="password"], input[type="tel"], textarea {
		width: 100%;
		padding: 10px;
		margin-bottom: 10px;
		border: 1px solid #ccc;
		border-radius: 4px;
	}
	input[type="submit"] {
		display: block;
		width: 100%;
		padding: 10px;
		background-color: #be2828;
		border: none;
		border-radius: 4px;
		color: #fff;
		font-size: 16px;
		cursor: pointer;
	}
	input[type="submit"]:hover {
		background-color: #be2828;
	}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form id="frmRegistration" >
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="fname" >
			<div style="color: rgb(199, 50, 50);  font-weight: bold;" id="fname_error" class="field_error"></div>

            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lname" >
			<div style="color: rgb(199, 50, 50);  font-weight: bold;" id="lname_error" class="field_error"></div>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" >
			<div style="color: rgb(199, 50, 50);  font-weight: bold;" id="email_error" class="field_error"></div>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" >
			<div style="color: rgb(199, 50, 50);  font-weight: bold;" id="password_error" class="field_error"></div>

            <label for="phone">Phone Number</label>
            <input type="tel" id="mobile" name="mobile" >
			<div style="color: rgb(199, 50, 50);  font-weight: bold;" id="mobile_error" class="field_error"></div>

            <label for="address">Address</label>
            <textarea id="address" name="address" rows="4" ></textarea>
			<div style="color: rgb(199, 50, 50);  font-weight: bold;" id="address_error" class="field_error"></div>

            <input type="submit" value="Submit">
			@csrf
        </form>
		<div id="thank_you_msg" class="field_error"></div>
    </div>
    <script>
        jQuery('#frmRegistration').submit(function(e){
  e.preventDefault();
  jQuery('.field_error').html('');
  jQuery.ajax({
    url:'registration_process',
    data:jQuery('#frmRegistration').serialize(),
    type:'post',
    success:function(result){
      if(result.status=="error"){
        jQuery.each(result.error,function(key,val){
          jQuery('#'+key+'_error').html(val[0]);
        });
      }
      
      if(result.status=="success"){
        jQuery('#frmRegistration')[0].reset();
        jQuery('#thank_you_msg').html(result.msg);
      }
    }
  });
});
    </script>

@endsection