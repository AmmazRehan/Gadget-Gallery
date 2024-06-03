@extends('admin/layouts')
@section('page_title','Customer Details')
@section('customer_select','active')
@section('container')
   
    <h1 class="mb10">Customer Details</h1>
    
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Fields</th>
                            <th>Details</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                      
                        <tr>
                            <td> <b>First Name: </b></td>
                            <td>{{$customer_list->fname}}</td>
                        </tr>

                        <tr>
                            <td><b> Last Name: </b></td>
                            <td>{{$customer_list->lname}}</td>
                        </tr>

                        <tr>
                            <td><b>Email: </b> </td>
                            <td>{{$customer_list->email}}</td>
                        </tr>

                        <tr>
                            <td><b> Password: </b></td>
                            <td>{{$customer_list->password}}</td>
                        </tr>

                        <tr>
                            <td><b> Mobile Number :</b></td>
                            <td>{{$customer_list->mobile}}</td>
                        </tr>

                        <tr>
                            <td><b>Address : </b> </td>
                            <td>{{$customer_list->address}}</td>
                        </tr>

                        <tr>
                            <td><b> City :</b></td>
                            <td>{{$customer_list->city}}</td>
                        </tr>

                        <tr>
                            <td><b> States :</b></td>
                            <td>{{$customer_list->state}}</td>
                        </tr>

                        <tr>
                            <td><b> Zip Code :</b></td>
                            <td>{{$customer_list->Zip}}</td>
                        </tr>

                        <tr>
                            <td> <b>Created On :</b></td>
                            <td>{{\Carbon\Carbon::parse($customer_list->created_at)->format('d-m-y h:i')}}</td>
                        </tr>


                        <tr>
                            <td><b> Updated On :</b></td>
                            <td>{{\Carbon\Carbon::parse($customer_list->updated_at)->format('d-m-y h:i')}}</td>
                        </tr>



                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection