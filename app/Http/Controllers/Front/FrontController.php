<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;
class FrontController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
//this is for category displaying on home page
$result ['home_categories']= DB::table('categories')->where (['status'=>1])->where(['in_home'=>1])->get();
foreach($result['home_categories']as $list){
$result['home_categories_product'][$list->id]= DB::table('products')->where (['status'=>1])->where(['category_id'=>$list->id])->get();
foreach($result['home_categories_product'][$list->id]as $list1){
$result['home_product_attr'][$list1->id]= DB::table('product_attribute')->leftjoin('sizes','sizes.id','=','size_id')
->leftjoin('colors','colors.id','=','color_id')->
where (['product_attribute.products_id'=>$list1->id])->get();
}
};



$result ['home_brand']= DB::table('brands')->where (['status'=>1])->where(['in_home'=>1])->get();

//is Featured product
        $result['home_featured_product'][$list->id]= DB::table('products')->where (['status'=>1])->where(['is_featured'=>1])->get();
        foreach($result['home_featured_product'][$list->id]as $list1){
        $result['home_featured_product_attr'][$list1->id]= DB::table('product_attribute')->leftjoin('sizes','sizes.id','=','size_id')
        ->leftjoin('colors','colors.id','=','color_id')->
        where (['product_attribute.products_id'=>$list1->id])->get();
        }

//is Discounted product

        $result['home_discounted_product'][$list->id]= DB::table('products')->where (['status'=>1])->where(['is_discounted'=>1])->get();
                foreach($result['home_discounted_product'][$list->id]as $list1){
                $result['home_discounted_product_attr'][$list1->id]= DB::table('product_attribute')->leftjoin('sizes','sizes.id','=','size_id')
                ->leftjoin('colors','colors.id','=','color_id')->
                where (['product_attribute.products_id'=>$list1->id])->get();
                }
// trending Products
        $result['home_tranding_product'][$list->id]= DB::table('products')->where (['status'=>1])->where(['is_trending'=>1])->get();
        foreach($result['home_tranding_product'][$list->id]as $list1){
        $result['home_tranding_product_attr'][$list1->id]= DB::table('product_attribute')->leftjoin('sizes','sizes.id','=','size_id')
        ->leftjoin('colors','colors.id','=','color_id')->
        where (['product_attribute.products_id'=>$list1->id])->get();
        }



return view('front/index', $result);
}



                public function product(Request $request, $slug)
                {
                        $result=[];
                       
                       
                        $result['product']= DB::table('products')->where (['status'=>1])->where(['slug'=>$slug])->get();

                        foreach($result['product'] as $list1){
                        $result['product_attr'][$list1->id]= DB::table('product_attribute')->leftjoin('sizes','sizes.id','=','size_id')
                        ->leftjoin('colors','colors.id','=','color_id')->
                        where (['product_attribute.products_id'=>$list1->id])->get();
                        }
                        //for multiple images

                        foreach($result['product'] as $list1){
                                $result['product_images'][$list1->id]= DB::table('product_images')->
                                where (['product_images.products_id'=>$list1->id])->get();
                                }

                        //for related product
                        $result['related_product']= DB::table('products')->where (['status'=>1])->where ('slug','!=',$slug)->where(['category_id'=>$result['product'][0]->category_id])->get();
                        foreach($result['related_product'] as $list1){
                                $result['related_product_attr'][$list1->id]= DB::table('product_attribute')->leftjoin('sizes','sizes.id','=','size_id')
                                ->leftjoin('colors','colors.id','=','color_id')->
                                where (['product_attribute.products_id'=>$list1->id])->get();
                                }
                //       echo "<pre>";
                //       print_r($result);
                //             echo "</pre>";

                        return view('front/product', $result);
                       
                }


                public function add_to_cart(Request $request)
                {
                     if ($request->session()-> has('Front_login'))
                     {
                        $uid= $request->session()-> get('Front_login');
                        $user_type="Reg";
                     }
                     else
                     {
                        $uid= getUserTempId();
                        $user_type="Not-Reg";
                     }
                         $product_id=$request->post('product_id');
                         $pqty=$request->post('pqty');

                         $result=DB::table('product_attribute')
                                ->where(['products_id'=>$product_id,])
                                ->get();
                                $product_attr_id=$result[0]->id;

                                $check=DB::table('cart')
                                ->where(['user_id'=>$uid])
                                ->where(['user_type'=>$user_type])
                                ->where(['product_id'=>$product_id])
                                ->where(['product_attr_id'=>$product_attr_id])
                                ->get();
                               
                                if(isset($check[0]))
                                {
                                        $update_id=$check[0]->id;
                                        if ($pqty==0)
                                        {
                                                DB::table('cart')
                                                ->where(['id'=>$update_id])
                                                ->delete();
                                                $msg=" Deleted";
                                        }
                                        else
                                        {
                                                DB::table('cart')
                                                ->where(['id'=>$update_id])
                                                ->update(['qty'=>$pqty]);
                                                $msg=" Updated";
                                        }
                                        
                                        
                                }
                                else{
                                        $id=DB::table('cart') 
                                        ->insertGetId([
                                                
                                        'user_id'=>$uid,
                                
                                        'user_type'=>$user_type,
                                        'product_id'=>$product_id,
                                        'product_attr_id'=>$product_attr_id,
                                        'qty'=>$pqty,
                                        'added_on'=>date('Y-m-d h:i:s')
                                        ]);
                                        $msg=" Added";
                                }
                                $result=DB::table('cart')
                                ->leftjoin('products','products.id','=','cart.product_id')
                                ->leftjoin('product_attribute','product_attribute.id','=','cart.product_attr_id')
                                ->where(['user_id'=>$uid])
                                ->where(['user_type'=>$user_type])
                                ->select('cart.qty', 'products.name','products.image','product_attribute.price', 'products.slug', 'products.id as pid', 'product_attribute.id as attr_id')
                                ->get();
                                return response()->json(['msg'=>$msg, 'data' => $result , 'total_item'=>count($result)]);
 
                        }


                        public function cart(Request $request)
                        {

                                if ($request->session()-> has('Front_login'))
                                {
                                   $uid= $request->session()-> get('Front_login');
                                   $user_type="Reg";
                                }
                                else
                                {
                                   $uid= getUserTempId();
                                   $user_type="Not-Reg";
                                }
                                $result['list']=DB::table('cart')
                                ->leftjoin('products','products.id','=','cart.product_id')
                                ->leftjoin('product_attribute','product_attribute.id','=','cart.product_attr_id')
                                ->where(['user_id'=>$uid])
                                ->where(['user_type'=>$user_type])
                                ->select('cart.qty', 'products.name','products.image','product_attribute.price', 'products.slug', 'products.id as pid', 'product_attribute.id as attr_id')
                                ->get();
                               


                              return view('front/cart', $result);
                               
                        }

                        public function category(Request $request,$slug)
                        {   
                            $sort="";
                            $sort_txt="";
                            if($request->get('sort')!==null){
                                $sort=$request->get('sort');
                            }    
                            
                            $query=DB::table('products');
                            $query=$query->leftJoin('categories','categories.id','=','products.category_id');
                            $query=$query->leftJoin('product_attribute','products.id','=','product_attribute.products_id');
                            $query=$query->where(['products.status'=>1]);
                            $query=$query->where(['categories.category_slug'=>$slug]);
                            if($sort=='name'){
                                $query=$query->orderBy('products.name','asc');
                                $sort_txt="Product Name";
                            }
                            if($sort=='date'){
                                $query=$query->orderBy('products.id','desc');
                                $sort_txt="Date";
                            }
                            if($sort=='price_desc'){
                                $query=$query->orderBy('product_attribute.price','desc');
                                $sort_txt="Price - DESC";
                            }if($sort=='price_asc'){
                                $query=$query->orderBy('product_attribute.price','asc');
                                $sort_txt="Price - ASC";
                            }
                            if($request->get('filter_price_start')!==null && $request->get('filter_price_end')!==null){
                                $filter_price_start=$request->get('filter_price_start');
                                $filter_price_end=$request->get('filter_price_end');
                    
                                if($filter_price_start>0 && $filter_price_end>0){
                                    $query=$query->whereBetween('product_attribute.price',[$filter_price_start,$filter_price_end]);
                                }
                    
                            }  
                            $query=$query->distinct()->select('products.*');
                            $query=$query->get();
                            $result['product']=$query;
                            
                            foreach($result['product'] as $list1){
                               
                                $query1=DB::table('product_attribute');
                                $query1=$query1->leftJoin('sizes','sizes.id','=','product_attribute.size_id');
                                $query1=$query1->leftJoin('colors','colors.id','=','product_attribute.color_id');
                                $query1=$query1->where(['product_attribute.products_id'=>$list1->id]);
                    
                                $query1=$query1->get();
                                
                                $result['product_attribute'][$list1->id]=$query1;
                    
                            }

                            $result ['category_left']= DB::table('categories')->where (['status'=>1])->get();
                            
                            $result['slug']=$slug;
                            $result['sort']=$sort;
                            $result['sort_txt']=$sort_txt;
                        //     $result['filter_price_start']=$filter_price_start;
                        //     $result['filter_price_end']=$filter_price_end;
                            return view('front.category',$result);
                        }

                        public function search (Request $request, $str){
                                   $query=DB::table('products');
                                $query=$query->leftJoin('categories','categories.id','=','products.category_id');
                                $query=$query->leftJoin('product_attribute','products.id','=','product_attribute.products_id');
                                $query=$query->where(['products.status'=>1]);
                                
                                $query=$query->where ('name','like',"%$str%");
                                $query=$query->orwhere ('model','like',"%$str%");
                                $query=$query->orwhere ('brand','like',"%$str%");
                                $query=$query->orwhere ('model','like',"%$str%");
                                $query=$query->orwhere ('technical_specification','like',"%$str%");

                                $query=$query->distinct()->select('products.*');
                                $query=$query->get();
                                $result['product']=$query;
                               
                                foreach($result['product'] as $list1){
                                   
                                    $query1=DB::table('product_attribute');
                                    $query1=$query1->leftJoin('sizes','sizes.id','=','product_attribute.size_id');
                                    $query1=$query1->leftJoin('colors','colors.id','=','product_attribute.color_id');
                                    $query1=$query1->where(['product_attribute.products_id'=>$list1->id]);
                        
                                    $query1=$query1->get();
                                    
                                    $result['product_attribute'][$list1->id]=$query1;
                        
                                }
                           return view('front/search', $result);
                        }

                        public function registration(Request $request)
                        {
                            if ( $request->session()->has('FRONT_USER_LOGIN')!=null){

                                return redirect('/');

                            }
                            $result=[];
                           return view('front.registration' , $result);
                        }
                        public function registration_process(Request $request)
                            {
                                $valid = Validator::make($request->all(), [
                                    "fname" => 'required',
                                    "lname" => 'required',
                                    "email" => 'required|email|unique:customers,email',
                                    "password" => 'required',
                                    "mobile" => 'required|numeric|digits:11',
                                    "address" => 'required',
                                ]);

                                if (!$valid->passes()) {
                                    return response()->json(['status' => 'error', 'error' => $valid->errors()->toArray()]);
                                } else {
                                    $rand_id = rand(111111111, 999999999);  // Generate rand_id
                                    $arr = [
                                        "fname" => $request->fname,
                                        "lname" => $request->lname,
                                        "email" => $request->email,
                                        "password" => bcrypt($request->password),  // Hash the password
                                        "mobile" => $request->mobile,
                                        "address" => $request->address,
                                        "status" => 1,
                                        "is_verify" => 0,
                                        "rand_id" => $rand_id,  // Retain rand_id
                                        "created_at" => now(),  // Use Laravel's helper function
                                        "updated_at" => now()   // Use Laravel's helper function
                                    ];
                                    $query = DB::table('customers')->insert($arr);
                                    if ($query) {
                                        return response()->json(['status' => 'success', 'msg' => "Registration successfully."]);
                                    }
                                }
                            }


                        public function login_process(Request $request)
                        {
                            $email = $request->str_login_email;
                            $password = $request->str_login_password;
                            $rememberme = $request->rememberme;
                        
                            // Fetch user data from database
                            $result = DB::table('customers')->where('email', $email)->first();
                        
                            // Check if user exists and password is correct
                            if ($result && Hash::check($password, $result->password)) {
                                $status = "success";
                                $msg = "Login successfully";
                        
                                // Set cookies based on remember me option
                                $cookie_time = $rememberme ? time() + 60 * 60 * 24 * 30 : 0; // 30 days or session
                        
                                setcookie('login_email', $email, $cookie_time, "/");
                                setcookie('login_pwd', $password, $cookie_time, "/");
                        
                                // Set session variables
                                $request->session()->put('FRONT_USER_LOGIN', true);
                                $request->session()->put('FRONT_USER_ID', $result->id);
                                $request->session()->put('FRONT_USER_NAME', $result->fname . ' ' . $result->lname);
                                $getUserTempId=getUserTempId();
                                DB::table('cart')
                                ->where('user_id', $getUserTempId)
                                ->where('user_type', 'Not-Reg')
                                ->update(['user_id' => $result->id, 'user_type' => 'Reg']);
                            } else {
                                $status = "error";
                                $msg = $result ? "Invalid Password" : "Please Enter Valid Email Or Password";
                            }
                        
                            return response()->json(['status' => $status, 'msg' => $msg]);
                        }

                        public function checkout(Request $request)
                        {
                            $result['cart_data']=getAddToCartTotalItem();
                    
                            if(isset($result['cart_data'][0])){
                    
                                if($request->session()->has('FRONT_USER_LOGIN')){
                                    $uid=$request->session()->get('FRONT_USER_ID');
                                    $customer_info=DB::table('customers')  
                                        ->where(['id'=> $uid])
                                         ->get(); 
                                    $result['customers']['fname']=$customer_info[0]->fname;
                                    $result['customers']['lname']=$customer_info[0]->lname;
                                    $result['customers']['email']=$customer_info[0]->email;
                                    $result['customers']['mobile']=$customer_info[0]->mobile;
                                    $result['customers']['address']=$customer_info[0]->address;
                                    $result['customers']['city']=$customer_info[0]->city;
                                    $result['customers']['state']=$customer_info[0]->state;
                                    $result['customers']['Zip']=$customer_info[0]->Zip;
                                }else{
                                    $result['customers']['name']='';
                                    $result['customers']['email']='';
                                    $result['customers']['mobile']='';
                                    $result['customers']['address']='';
                                    $result['customers']['city']='';
                                    $result['customers']['state']='';
                                    $result['customers']['zip']='';
                                }
                    
                                return view('front.checkout',$result);
                            }else{
                                return redirect('/');
                            }
                        }
                    

                        public function apply_coupon_code(Request $request)
                        {
                            $arr=apply_coupon_code($request->coupon_code);
                            $arr=json_decode($arr,true);

                            return response()->json(['status'=>$arr['status'],'msg'=>$arr['msg'],'totalPrice'=>$arr['totalPrice']]);
                        }
                        
                        public function remove_coupon_code(Request $request)
                        {
                            $totalPrice=0;
                            $result=DB::table('coupons')  
                            ->where(['code'=>$request->coupon_code])
                            ->get(); 
                            $getaddtocarttotalitem=getaddtocarttotalitem();
                            $totalPrice=0;
                            foreach($getaddtocarttotalitem as $list){
                                $totalPrice=$totalPrice+($list->qty*$list->price);
                            }  
                            
                            return response()->json(['status'=>'success','msg'=>'Coupon code removed','totalPrice'=>$totalPrice]); 
                        }
                        
                        public function place_order(Request $request)
    {
        $payment_url='';
        if($request->session()->has('FRONT_USER_LOGIN')){
            $coupon_value=0;
            if($request->coupon_code!=''){
                $arr=apply_coupon_code($request->coupon_code);
                $arr=json_decode($arr,true);
                if($arr['status']=='success'){
                    $coupon_value=$arr['coupon_code_value'];
                }else{
                    return response()->json(['status'=>'false','msg'=>$arr['msg']]);
                }
            }
            

            $uid=$request->session()->get('FRONT_USER_ID');
            $totalPrice=0;
            $getaddtocarttotalitem=getaddtocarttotalitem();
            foreach($getaddtocarttotalitem as $list){
                $totalPrice=$totalPrice+($list->qty*$list->price);
            }  
            $arr=[
                "customer_id"=>$uid,
                "fname"=>$request->fname,
                "lname"=>$request->lname,
                "email"=>$request->email,
                "mobile"=>$request->mobile,
                "address"=>$request->address,
                "city"=>$request->city,
                "state"=>$request->state,
                "pincode"=>$request->Zip,
                "coupon_code"=>$request->coupon_code,
                "coupon_value"=>$coupon_value,
                "payment_type"=>$request->payment_type,
                "payment_status"=>"Pending",
                "total_amt"=>$totalPrice,
                "order_status"=>1,
                "added_on"=>date('Y-m-d h:i:s')
            ];
            $order_id=DB::table('orders')->insertGetId($arr);

            if($order_id>0){
                foreach($getaddtocarttotalitem as $list){
                    $prductDetailArr['product_id']=$list->pid;
                    $prductDetailArr['product_attr_id']=$list->attr_id;
                    $prductDetailArr['price']=$list->price;
                    $prductDetailArr['qty']=$list->qty;
                    $prductDetailArr['orders_id']=$order_id;
                    DB::table('order_details')->insert($prductDetailArr);
                }
                
                DB::table('cart')->where(['user_id'=>$uid,'user_type'=>'Reg'])->delete();
                $request->session()->put('ORDER_ID',$order_id);

                $status="success";
                $msg="Order placed";
            }else{
                $status="false";
                $msg="Please try after sometime";
            }
        }else{
            $status="false";
            $msg="Please login to place order";
        }
        return response()->json(['status'=>$status,'msg'=>$msg, 'payment_url'=>$payment_url]); 
    }

    public function order_placed(Request $request)
    {
        if($request->session()->has('ORDER_ID')){
            return view('front.order_placed');
        }else{
            return redirect('/');
        }
    }

    public function terms(Request $request)
    {
        return view('front.term');
    }
                    }
                    