@extends ('admin.layouts');
@section ('page_title','Manage Category');
@section('container')


<h1>Manage Category</h1>
<a href="{{url('admin/category')}}">
<button type="button" class="btn btn-success">
<i class="fa fa-minus"></i>Back
</button>
</a>
<div class="row m-t-30">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <form action="{{route('category.manage_category_process')}}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-4">
                        <label for="category_name" class="control-label mb-1">Category Name</label>
                        <input id="category_name" value="{{$category_name}}" name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Add Category" required>
                        @error ('category_name')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}
                        </div>
                        @enderror
                     </div>
                     <div class="col-md-4">
                        <label for="category_slug" class="control-label mb-1">Category Slug</label>
                        <input id="category_slug" value="{{$category_slug}}" name="category_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error ('category_slug')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}
                        </div>
                        @enderror
                     </div>

                     <div class="col-md-4">
                        <label for="category_slug" class="control-label mb-1">Parent Category</label>
                        
                        <select id="parent_category_id" name="parent_category_id" class="form-control" >
                           <option value="0">Select Categories</option>
                           @foreach($category as $list)
                           @if($parent_category_id==$list->id)
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
                     <div class="form-group">
                        <label for="category_image" class="control-label mb-1"> Image</label>
                        <input id="category_image" name="category_image" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                        
                        @error('category_image')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}		
                           
                        </div>
                        @enderror
                        @if($category_image!='')
                      <img width="100px" target="_blank" src="{{asset('storage/media/category/'.$category_image)}}" >
                  @endif
               
                     </div>
                  </div>


                  
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="in_home" class="control-label mb-1"> Show In Home Page</label>
                     <input id="in_home" name="in_home" type="checkbox"  {{$in_home_selected}} >
                     
                    
            
                  </div>
               </div>
               <div>
                  <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                  Submit
                  </button>
               </div>
               <input type="hidden" name="id" value="{{$id}}">
            </form>
         </div>
      </div>
   </div>
</div>
</div>
@endsection
{{-- <label for="category_id" class="control-label mb-1"> Category</label>
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
</select> --}}
