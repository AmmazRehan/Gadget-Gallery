<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $result['data']=Coupon::all();
        return view ('admin/coupon',$result); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_coupon(Request $request , $id='')
    {
        if($id>0){
           $arr= Coupon::Where (['id'=>$id])->get();
           $result ['title']=$arr['0']->title;
           $result ['code']=$arr['0']->code;
           $result ['value']=$arr['0']->value;
           $result ['type']=$arr['0']->type;
           $result ['min_order_amt']=$arr['0']->min_order_amt;
           $result ['is_one_time']=$arr['0']->is_one_time;
              $result ['id']=$arr['0']->id;
        }
        else{
            $result ['title']='';
            $result ['code']='';
            $result ['value']='';
            $result ['type']='';
            $result ['min_order_amt']='';
            $result ['is_one_time']='';
            $result ['id']=0;

    }
 
    return view('admin/manage_coupon',$result);
}
    public function manage_coupon_process(Request $request )
    {
      //  return $request->post();
        $request->validate([
            'title' => 'required',
            'code' => 'required|unique:coupons,code,'.$request->post('id'),
            'value' => 'required',
        ]);
        $model = new Coupon();
        if ($request->post('id') > 0) {
            $model = Coupon::find($request->post('id'));
            $message = 'Coupon Updated';
        } else {
            $model = new Coupon();
            $message = 'Coupon Inserted';
            $model->status = 1;
        }
        $model->title = $request->post('title');
        $model->code = $request->post('code');
        $model->value = $request->post('value');
        $model->type = $request->post('type');
        $model->min_order_amt = $request->post('min_order_amt');
        $model->is_one_time = $request->post('is_one_time');
        $model->status = 1;
        
        $model->save();
        $request->session()->flash('message', '$message');
        return redirect('admin/coupon');

    }
    public function delete(Request $request, $id)
    {
       $model = Coupon::find($id);
         $model->delete();
            $request->session()->flash('message', 'coupon Deleted');
            return redirect('admin/coupon');


}
public function status(Request $request, $type, $id)
{
    $model = Coupon::find($id);
    $model->status = $type;
    $model->save();
    $request->session()->flash('message', 'Category Status Updated');
    return redirect('admin/coupon');

}
}
