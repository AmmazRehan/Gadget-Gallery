<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use App\Models\Admin\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data']=category::all();
        return view ('admin/category',$result); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_category(Request $request , $id='')
    {
        if($id>0){
           $arr= category::Where (['id'=>$id])->get();
           $result ['category_name']=$arr['0']->category_name;
           $result ['category_slug']=$arr['0']->category_slug;
           $result ['parent_category_id']=$arr['0']->parent_category_id;
           $result ['category_image']=$arr['0']->category_image;
           $result ['in_home']=$arr['0']->in_home;
           $result ['in_home_selected']="";
           if($arr['0']->in_home==1){
            $result ['in_home_selected']="checked";
           }
          
           
              $result ['id']=$arr['0']->id;
        }
        else{
            $result ['category_name']='';
            $result ['category_slug']='';
            $result ['parent_category_id']='';
            $result ['category_image']='';
            $result ['in_home']='';
            $result ['in_home_selected']="";
            $result ['id']=0;

    }
    $result['category']=DB::table('categories')->where(['status'=>1])->get();
 
    return view('admin/manage_category',$result);
}
    public function manage_category_process(Request $request )
    {
      //  return $request->post();
        $request->validate([
            'category_name' => 'required',
            'category_image'=>'mimes:jpeg,jpg,png',
            'category_slug' => 'required|unique:categories,category_slug,'.$request->post('id'),
        ]);
        $model = new category();
        if ($request->post('id') > 0) {
            $model = category::find($request->post('id'));
            $message = 'Category Updated';
        } else {
            $model = new category();
            $message = 'Category Inserted';
        }

        if($request->hasfile('category_image')){
            $category_image=$request->file('category_image');
            $ext=$category_image->extension();
            $image_name=time().'.'.$ext;
            $category_image->storeAs('/public/media/category',$image_name);
            $model->category_image=$image_name;
        }
        $model->category_name = $request->post('category_name');
        $model->category_slug = $request->post('category_slug');
        $model->parent_category_id = $request->post('parent_category_id');

        if ($request->post('in_home') == '') {
            $model->in_home = 0;
        } else {
            $model->in_home = 1;
        }

        $model->status = 1;
        $model->save();
        $request->session()->flash('message', '$message');
        return redirect('admin/category');

    }
    public function delete(Request $request, $id)
    {
       $model = category::find($id);
         $model->delete();
            $request->session()->flash('message', 'Category Deleted');
            return redirect('admin/category');


}
public function status(Request $request, $type, $id)
{
    $model = category::find($id);
    $model->status = $type;
    $model->save();
    $request->session()->flash('message', 'Category Status Updated');
    return redirect('admin/category');

}
}