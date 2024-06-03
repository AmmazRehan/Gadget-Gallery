@extends ('admin.layouts');
@section ('page_title','Product');
@section('product_select','active')
@section('container')

@if (session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    <span class="badge badge-pill badge-success">Success</span>
    {{session('message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<h1>Products</h1>

<a href="{{url('admin/product/manage_product')}}">

    <button type="button" class="btn btn-success">
        <i class="fa fa-plus"></i> Add Products

    </button>
</a>


   <div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th> Name</th>
                        
                        <th> category</th>
                        <th> Slug</th>
                        <th> image</th>

                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->name}}</td>
                        <td>{{$list->category_id}}</td>
                        <td>{{$list->slug}}</td>
                        <td>
                            @if($list->image!='')
                            <img width="100px" src="{{asset('storage/media/'.$list->image)}}" ></td>
                        @endif
                        <td>
                            <a href="{{url('admin/product/delete/')}}/{{$list->id}}">
                            <Button class="btn btn-danger" type="button">
                                Delete
                             </Button>
                            </a>
                            @if ($list->status==1)
                            <a href="{{url('admin/product/status/0')}}/{{$list->id}}">
                                <Button class="btn btn-success" type="button">
                                    Active
                                 </Button>
                                </a>

                                @elseif ($list->status==0)
                                <a href="{{url('admin/product/status/1')}}/{{$list->id}}">
                                    <Button class="btn btn-warning" type="button">
                                        Deactive
                                     </Button>
                                    </a>
                                    
                                @endif
                                <a href="{{url('admin/product/manage_product')}}/{{$list->id}}">
                                    <Button class="btn btn-primary" type="button">
                                        Edit
                                     </Button>
                                    </a>


                        </td>
                    </tr>
                    @endforeach
                 
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection