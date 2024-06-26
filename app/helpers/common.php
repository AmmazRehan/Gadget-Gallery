<?php
use Illuminate\Support\Facades\DB;

function prx ($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    die();
}
function getTopNavCat(){

    $result= DB::table('categories')->where (['status'=>1])->get();
    $arr=[];
    foreach($result as $row){
        $arr[$row->id]['category_name']=$row->category_name;
        $arr[$row->id]['parent_id']=$row->parent_category_id;
        $arr[$row->id]['category_slug']=$row->category_slug;
    }
    $str=buildTreeView($arr,0);
    return $str;

}
$html='';
function buildTreeView($arr,$parent,$level=0,$prelevel=-1){
    global $html;
    foreach($arr as $id=>$data){
        if($parent==$data['parent_id']){
            if($level>$prelevel){
                if($level==0){
                    $html.='<ul class="main-nav nav navbar-nav">';
                }
                else{
                    $html.='<ul class="submenu">';
                }
            }
            if($level==$prelevel){
                $html.='</li>';
            }
            $html.='<li><a href="category/'.$data['category_slug'].'">'.$data['category_name'].'</a>';
            if($level>$prelevel){
                $prelevel=$level;
            }
            $level++;
            buildTreeView($arr,$id,$level,$prelevel);
            $level--;
        }
    }
    if($level==$prelevel){
        $html.='</li></ul>';
    }
    return $html;
}










function getUserTempId(){

    if (!session()-> has('USER_TEMP_ID')) {
        $rand=rand(111111111,999999999);
         session()-> put('USER_TEMP_ID',$rand);
         return $rand;
    } 
    else {
        return session()-> get('USER_TEMP_ID');

        
    }
}

function getaddtocarttotalitem(){
    if (session()-> has('Front_login'))
    {
       $uid= session()-> get('Front_login');
       $user_type="Reg";
    }
    else
    {
       $uid= getUserTempId();
       $user_type="Not-Reg";
    }

    $result=DB::table('cart')
    ->leftjoin('products','products.id','=','cart.product_id')
    ->leftjoin('product_attribute','product_attribute.id','=','cart.product_attr_id')
    ->where(['user_id'=>$uid])
    ->where(['user_type'=>$user_type])
    ->select('cart.qty', 'products.name','products.image','product_attribute.price', 'products.slug', 'products.id as pid', 'product_attribute.id as attr_id')
    ->get();
     return $result;
}

function apply_coupon_code($coupon_code){
    $totalPrice=0;
                            $result=DB::table('coupons')  
                                ->where(['code'=>$coupon_code])
                                ->get(); 
                            
                            if(isset($result[0])){
                                $value=$result[0]->value;
                                $type=$result[0]->type;
                                $getaddtocarttotalitem=getaddtocarttotalitem();
                                
                                foreach($getaddtocarttotalitem as $list){
                                    $totalPrice=$totalPrice+($list->qty*$list->price);
                                }  
                                if($result[0]->status==1){
                                    if($result[0]->is_one_time==1){
                                        $status="error";
                                        $msg="Coupon code already used";    
                                    }else{
                                        $min_order_amt=$result[0]->min_order_amt;
                                        if($min_order_amt>0){
                                             
                                            if($min_order_amt<$totalPrice){
                                                $status="success";
                                                $msg="Coupon code applied";
                                            }else{
                                                $status="error";
                                                $msg="Cart amount must be greater then $min_order_amt";
                                            }
                                        }else{
                                             $status="success";
                                             $msg="Coupon code applied";
                                        }
                                    }
                                }else{
                                    $status="error";
                                    $msg="Coupon code deactivated";   
                                }
                                
                            }else{
                               $status="error";
                               $msg="Please enter valid coupon code";
                            }
                            
                           $coupon_code_value=0;
                            if($status=='success'){
                                if($type=='Value'){
                                    $coupon_code_value=$value;
                                    $totalPrice=$totalPrice-$value;
                                }if($type=='Per'){
                                    $newPrice=($value/100)*$totalPrice;
                                    $totalPrice=round($totalPrice-$newPrice);
                                    $coupon_code_value=$newPrice;
                                }
                            }
                    
                            return json_encode(['status'=>$status,'msg'=>$msg,'totalPrice'=>$totalPrice,'coupon_code_value'=>$coupon_code_value]); 
}

?>
