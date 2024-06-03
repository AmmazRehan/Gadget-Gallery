@extends ('admin.layouts');
@section ('page_title','Coupon');
@section('coupon_select','active')
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
<h1>Coupon</h1>

<a href="{{url('admin/coupon/manage_coupon')}}">

    <button type="button" class="btn btn-success">
        <i class="fa fa-plus"></i> Add Coupon

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
                        <th>Title</th>
                        <th>Code</th>
                        <th>Value</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->title}}</td>
                        <td>{{$list->code}}</td>
                        <td>{{$list->value}}</td>
                        
                        <td>
                            <a href="{{url('admin/coupon/delete/')}}/{{$list->id}}">
                            <Button class="btn btn-danger" type="button">
                                Delete
                             </Button>
                            </a>

                            @if ($list->status==1)
                            <a href="{{url('admin/coupon/status/0')}}/{{$list->id}}">
                                <Button class="btn btn-success" type="button">
                                    Active
                                 </Button>
                                </a>

                                @elseif ($list->status==0)
                                <a href="{{url('admin/coupon/status/1')}}/{{$list->id}}">
                                    <Button class="btn btn-warning" type="button">
                                        Deactive
                                     </Button>
                                    </a>
                                    
                                @endif
                            <a href="{{url('admin/coupon/manage_coupon')}}/{{$list->id}}">
                                <Button class="btn btn-warning" type="button">
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