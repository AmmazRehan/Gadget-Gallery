@extends ('admin.layouts');
@section('page_title','Manage Product')
@section('product_select','active')
@section('container')
@if($id>0)
   @php
      $image_required="";
   @endphp
   @else
   @php
      $image_required="required";
   @endphp
@endif

@error('attr_image.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    <span class="badge badge-pill badge-error">Error</span>
    {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true"></span>
    </button>
</div>
@enderror
@error('images.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    <span class="badge badge-pill badge-error">Error</span>
    {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true"></span>
    </button>
</div>
@enderror

@if (session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    <span class="badge badge-pill badge-success">Success</span>
    {{session('message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true"></span>
    </button>
</div>
@endif
<h1 class="mb10">Manage Product</h1>

<a href="{{url('admin/product')}}">
<button type="button" class="btn btn-success">
Back
</button>
</a>

<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<div class="row m-t-30">
   <div class="col-md-12">
      <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body">
                     @csrf
                     <div class="form-group">
                        <label for="name" class="control-label mb-1"> Name</label>
                        <input id="name" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}		
                        </div>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="slug" class="control-label mb-1"> Slug</label>
                        <input id="slug" value="{{$slug}}" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('slug')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}		
                        </div>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="image" class="control-label mb-1"> Image</label>
                        <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}>
                        @error('image')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}		
                        </div>
                        @enderror

                        @if($image!='')
                        <img width="100px" src="{{asset('storage/media/'.$image)}}" ></td>
                    @endif
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-4">
                              <label for="category_id" class="control-label mb-1"> Category</label>
                              <select id="category_id" name="category_id" class="form-control" required>
                                 <option value="">Select Categories</option>
                                 @foreach($category as $list)
                                 @if($category_id==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif
                                    {{$list->category_name}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label for="brand" class="control-label mb-1"> Brands</label>
                              <select id="brand" name="brand" class="form-control" required>
                                 <option value="">Select Brand</option>
                                 @foreach($brands as $list)
                                 @if($brand==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif
                                    {{$list->name}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label for="model" class="control-label mb-1"> Model</label>
                              <input id="model" value="{{$model}}" name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="short_description" class="control-label mb-1"> Short Description</label>
                        <textarea id="short_description" name="short_description" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$short_description}}</textarea>
                     </div>
                     <div class="form-group">
                        <label for="description" class="control-label mb-1"> Description</label>
                        <textarea id="description" name="description" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$description}}</textarea>
                     </div>
                     <div class="form-group">
                        <label for="keywords" class="control-label mb-1"> Keywords</label>
                        <textarea id="keywords" name="keywords" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$keywords}}</textarea>
                     </div>
                     <div class="form-group">
                        <label for="technical_specification" class="control-label mb-1"> Technical Specification</label>
                        <textarea id="technical_specification" name="technical_specification" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$technical_specification}}</textarea>
                     </div>
                     
                     <div class="form-group">
                        <label for="warranty" class="control-label mb-1"> Warranty</label>
                        <textarea id="warranty" name="warranty" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$warranty}}</textarea>
                     </div>

                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-4">
                              <label for="lead_time" class="control-label mb-1"> Deleivery Time</label>
                              <input id="lead_time" value="{{$lead_time}}" name="lead_time" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                          
                           </div>
                           <div class="col-md-4">
                              <label for="tax_id" class="control-label mb-1"> Tax </label>
                              <select id="tax_id" name="tax_id" class="form-control" required>
                                 <option value="">Select Tax</option>
                                 @foreach($taxes as $list)
                                 @if($tax_id==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif
                                    {{$list->tax_desc}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label for="tax_type" class="control-label mb-1"> Tax Type</label>
                              <input id="tax_type" value="{{$tax_type}}" name="tax_type" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                          
                           </div>
                        </div>
                     </div>

                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-3">
                              <label for="is_promo" class="control-label mb-1"> Is Promo</label>
                              <select id="is_promo" name="is_promo" class="form-control" required>
                                 @if($is_promo=='1')
                                 <option value="1" selected>Yes</option>
                                 <option value="0">No</option>

                                 @else
                                 <option value="1" >Yes</option>
                                 <option value="0" selected>No</option>

                                 @endif

                              </select>
                           </div>
                           <div class="col-md-3">
                              <label for="is_featured" class="control-label mb-1"> Is Featured</label>
                              <select id="is_featured" name="is_featured" class="form-control" required>
                                 @if($is_featured=='1')
                                 <option value="1" selected>Yes</option>
                                 <option value="0">No</option>

                                 @else
                                 <option value="1" >Yes</option>
                                 <option value="0" selected>No</option>

                                 @endif

                              </select>
                           </div>
                           <div class="col-md-3">
                              <label for="is_discounted" class="control-label mb-1"> Is Discounted</label>
                              <select id="is_discounted" name="is_discounted" class="form-control" required>
                                 @if($is_discounted=='1')
                                 <option value="1" selected>Yes</option>
                                 <option value="0">No</option>

                                 @else
                                 <option value="1" >Yes</option>
                                 <option value="0" selected>No</option>

                                 @endif

                              </select>
                           </div>

                           <div class="col-md-3">
                              <label for="is_trending" class="control-label mb-1"> Is Trending</label>
                              <select id="is_trending" name="is_trending" class="form-control" required>
                                 @if($is_trending=='1')
                                 <option value="1" selected>Yes</option>
                                 <option value="0">No</option>

                                 @else
                                 <option value="1" >Yes</option>
                                 <option value="0" selected>No</option>

                                 @endif

                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>




            <div class="col-lg-12" >
               <h2 class="mb10">Product Images</h2>
            
               
               <div class="card" >
                  <div class="card-body">
                     <div class="form-group">
                        @php
                        $loop_count_num=1;
                        @endphp
                        @foreach($productImagesArr as $key=>$list)
                     @php 
                        $pIArr=(array)$list;
                        $loop_count_prev=$loop_count_num;
                     @endphp
                     <input id="piid" type="hidden" name="piid[]" value="{{$pIArr['id']}}">
                        <div class="row" id="product_images_box">
                           <div class="col-md-4 product_images_{{$loop_count_num++}}" >
                              <label for="images" class="control-label mb-1"> Images</label>
                              <input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false"  {{$image_required}}>
                              @if($pIArr['images']!='')
                            <img width="100px" src="{{asset('storage/media/'.$pIArr['images'])}}" ></td>
                        @endif
                           </div>
                           
                           <div class="col-md-2" >
                              <div class="form-group">

                                 
                                 <label for="images" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label>
                              @if($loop_count_num==2)
                                <button type="button" class="btn btn-success btn-lg mt-4" onclick="add_image_more()">
                                <i class="fa fa-plus"></i>&nbsp; Add</button>
                              @else
                              <a href="{{url('admin/product/product_images_delete/')}}/{{$pIArr['id']}}/{{$id}}"><button type="button" class="btn btn-danger btn-lg">
                                <i class="fa fa-plus"></i>&nbsp; Remove</button></a>
                              @endif  

                           </div>
                          
                        </div>
                     </div>
                     
                  </div>@endforeach
                  </div>
               </div>
              
            </div>

            
            
            <div class="col-lg-12" id="product_attr_box">
               <h2 class="mb10">Product Attributes</h2>
               @php
               $loop_count_num=1;
               @endphp
               @foreach($productAttrArr as $key=>$list)
            @php 
               $pAArr=(array)$list;
               $loop_count_prev=$loop_count_num;
            @endphp
               <input id="paid" type="hidden" name="paid[]" value="{{$pAArr['id']}}">
               <div class="card" id="product_attr_{{$loop_count_num++}}">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-4">
                              <label for="sku" class="control-label mb-1"> SKU</label>
                              <input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['sku']}}" required>
                           
                           </div>
                           <div class="col-md-4">
                              <label for="mrp" class="control-label mb-1"> MRP</label>
                              <input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['mrp']}}" required>
                           </div>
                           <div class="col-md-4">
                              <label for="price" class="control-label mb-1"> Price</label>
                              <input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['price']}}" required>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="size_id" class="control-label mb-1"> Size</label>
                                 <select id="size_id" name="size_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                    <option value="">Select Size</option>
                                    @foreach($sizes as $list)
         
                                    @if ($pAArr['size_id']==$list->id)
                                    <option selected  value="{{$list->id}}">
                                       {{$list->size}}
                                    </option>
         
                                    @else 
                                    <option  value="{{$list->id}}">
                                       {{$list->size}}
                                    </option>
                                    @endif
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="color_id" class="control-label mb-1"> Color</label>
                                 <select id="color_id"  name="color_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                    <option value="">Select Color</option>
                                    @foreach($colors as $list)
                                    @if ($pAArr['size_id']==$list->id)
                                    <option  selected value="{{$list->id}}">
                                       {{$list->color}}
                                    </option>
         
                                    @else 
                                    <option  value="{{$list->id}}">
                                       {{$list->color}}
                                    </option>
                                    </option>
                                    @endif
                                    
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <label for="qty" class="control-label mb-1"> Qty</label>
                              <input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['qty']}}" required>
                           </div>
                           <div class="col-md-4">
                              <label for="attr_image" class="control-label mb-1"> Image</label>
                              <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false"  {{$image_required}}>
                           </div>
                           <div class="col-md-2">
                              <label for="attr_image" class="control-label mb-1"> 
                              &nbsp;&nbsp;&nbsp;</label>
                              @if($pAArr["attr_image"]!='')
                            <img width="100px" src="{{asset('storage/media/'.$pAArr['attr_image'])}}" ></td>
                        @endif
                              @if($loop_count_num==2)
                                <button type="button" class="btn btn-success btn-lg" onclick="add_more()">
                                <i class="fa fa-plus"></i>&nbsp; Add</button>
                              @else
                              <a href="{{url('admin/product/product_attr_delete/')}}/{{$pAArr['id']}}/{{$id}}"><button type="button" class="btn btn-danger btn-lg">
                                <i class="fa fa-plus"></i>&nbsp; Remove</button></a>
                              @endif  

                           </div>
                        </div>
                     </div>  
                  </div>
               </div>
            </div>
            @endforeach
         <div>
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
            Submit
            </button>
         </div>
         <input type="hidden" name="id" value="{{$id}}"/>
      </form>
   </div>
</div>
<script>
   var loop_count=1; 
   function add_more(){
       loop_count++;
       var html='<input id="paid" type="hidden" name="paid[]" ><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';

       html+='<div class="col-md-4"><label for="sku" class="control-label mb-1"> SKU</label><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>'; 

       html+='<div class="col-md-4"><label for="mrp" class="control-label mb-1"> MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>'; 

       html+='<div class="col-md-4"><label for="price" class="control-label mb-1"> Price</label><input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

       var size_id_html=jQuery('#size_id').html(); 
       size_id_html=size_id_html.replace("selected","");
       html+='<div class="col-md-4"><label for="size_id" class="control-label mb-1"> Size</label><select id="size_id" name="size_id[]" class="form-control">'+size_id_html+'</select></div>';

       var color_id_html=jQuery('#color_id').html(); 
       color_id_html=color_id_html.replace("selected","");
       html+='<div class="col-md-4"><label for="color_id" class="control-label mb-1"> Color</label><select id="color_id" name="color_id[]" class="form-control" >'+color_id_html+'</select></div>';

       html+='<div class="col-md-4"><label for="qty" class="control-label mb-1"> Qty</label><input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';

       html+='<div class="col-md-4"><label for="attr_image" class="control-label mb-1"> Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false"  {{$image_required}}></div>';

       html+='<div class="col-md-4"><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>'; 

       html+='</div></div></div></div>';

       jQuery('#product_attr_box').append(html)
   }
   function remove_more(loop_count){
        jQuery('#product_attr_'+loop_count).remove();
   }
   var loop_image_count=1; 
   function add_image_more(){
      loop_image_count++;

      var html='<input id="piid" type="hidden" name="piid[]" value=""><div class="col-md-4  product_images_'+loop_image_count+'" ><label for="images" class="control-label mb-1"> Images</label><input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required></div>';
      html+='<div class="col-md-2  product_images_'+loop_image_count+'"><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg mt-4" onclick=remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>'; 

      jQuery('#product_images_box').append(html)


   }

   function remove_image_more(loop_image_count){
        jQuery('.product_images_'+loop_image_count).remove();
   }
   CKEDITOR.replace('short_description');
   CKEDITOR.replace('description');
   CKEDITOR.replace('technical_specification');
</script>
@endsection