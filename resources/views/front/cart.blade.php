@extends('front/layout')
@section('page_title','Cart Page')
@section('container')
<style>
 
  
  .container2 {
      max-width: 1200px;
      margin: 20px auto;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
  }
  
  .banner {
      background-color: #e0474d;
      color: #fff;
      padding: 10px;
      text-align: center;
      font-size: 20px;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
  }
  
  table {
      width: 100%;
      border-collapse: collapse;
  }
  
  th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
  }
  
  th {
      background-color: #f2f2f2;
  }
  
  tr:nth-child(even) {
      background-color: #f9f9f9;
  }
  
  tr:hover {
      background-color: #f2f2f2;
  }
  
  .update-button {
      display: block;
      width: 10%;
      float: right;
      padding: 10px;
      text-align: center;
      background-color: #e0474d;
      color: #fff;
      border: none;
      border-bottom-left-radius: 8px;
      border-bottom-right-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
  }
  fa{
        background-color: transparent;
        color: #e0474d;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        font-size: 100px;
        text-align: center
        line-height: 1;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s ease;
    }
</style>
    

    <div class="container2">
      <div class="banner">Featured Products</div>
      <form action="">
        @if(isset($list[0]))
      <table>
          <tr>
            <th>Action</th>
              <th>Images</th>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total</th>
             
          </tr>
          @foreach($list as $data)
          <tr id="cart_box{{$data->attr_id}}">
            <td><a class="remove" href="javascript:void(0)" onclick="deleteCartProduct('{{$data->pid}}','{{$data->attr_id}}')"><fa class="fa fa-close"></fa></a></td> 
            <td><a href="{{url('product/'.$data->slug)}}"><img width="30%" src="{{asset('storage/media/'.$data->image)}}" alt=""></a></td>
            <td><a href="{{url('product/'.$data->slug)}}">{{$data->name}}</a></td>
            <td>{{$data->price}} $</td>
            <td style="width: 10%">
                <input id="qty{{$data->attr_id}}" value="{{$data->qty}}" style="width: 100%" type="number" onchange="updateQTY('{{$data->pid}}', '{{$data->attr_id}}', '{{$data->price}}')">
            </td>
            <td id="total_price_{{$data->attr_id}}">{{$data->price*$data->qty}} $</td>
        </tr>
        
          @endforeach
      </table>
      @else
      <h3>Cart Is Empty</h3>
      @endif
      

      
    </form>
    <a href="{{url('/checkout')}}">
        <button type="submit" class="update-button">Check Out</button>
      </a>
       
 
  </div>
  
  <input type="hidden" id="qty" value="1"/>
  <form action="" id="frmAddToCart">
  
      @csrf 
      <input type="hidden" id="pqty" name="pqty">
      <input type="hidden" id="product_id" name="product_id">
  
  
  </form>

@endsection