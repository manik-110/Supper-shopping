<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\str;

class CategoryController extends Controller
{
    function add_category(){
        $categories = category::all();
        return view('admin.category.add_category',[
            'categories' => $categories,
        ]);
    }
    function category_store(Request $request)

    {
        $request->validate([
           'category_name'=>'required',
           'category_photo'=>'required',
           'category_photo'=>['required','mimes:png,jpg,gif,jpeg','max:1024'],


        ]);


        $category_slug = Str::lower(str_replace('','-',$request->category_name)).'-' . random_int(200000, 999999);

        $photo = $request->category_photo;
        $extension =$photo->extension();
        $file_name = uniqid().'.'.$extension;

        image::make($photo)->save(public_path('uploads/category/'.$file_name ));

        category::insert([
            'category_name'=>$request->category_name,
            'category_photo'=>$file_name,
            'category_slug'=>$category_slug,
            'created_at'=>carbon::now(),

        ]);

        return back();

}
    function category_delete($id)
    {

    //    $category =category::find($id);
    //    $delete_from = public_path('uploads/category/'. $category->category_photo);
    //    unlink($delete_from);


       category::find($id)->delete();

       return back()->with('del','category_delete!');
    }
    function category_edit($id)
    {
        $category = category::find($id);
      return view('admin.category.category_edit',[
        'category' => $category,
      ]);


    }
    function category_update(Request $request,$id){
        $img = $request->category_photo;
        $category_slug = Str::lower(str_replace('','-',$request->category_name)).'-' . random_int(200000, 999999);
        if($img == ''){
            category::find($id)->update([
            'category_name'=>$request->category_name,
            'category_slug'=>$category_slug,

            ]);
            return back()->with('update','category_update!');

        }else{
            $category =category::find($id);
            $delete_from = public_path('uploads/category/'. $category->category_photo);
            unlink($delete_from);

            $photo = $request->category_photo;
            $extension =$photo->extension();
            $file_name = uniqid().'.'.$extension;
            image::make($photo)->save(public_path('uploads/category/'.$file_name ));
            }
            category::find($id)->update([
                'category_name'=> $request->category_name,
                'category_photo'=> $file_name,
                'category_slug'=>$category_slug,
            ]);
            return back()->with('update','category updated!');
    }
    function category_trash(){
        $categories = category::onlyTrashed()->get();
        return view('admin.category.trash',[
            'categories' => $categories,
        ]);
    }
    function category_recovery($id){
        category::onlyTrashed()->find($id)->restore();
        return back();
    }
    function category_forced_deleted($id){
        $category = category::onlyTrashed()->find($id);

        if ($category->category_photo) {
            $delete_from = public_path('uploads/category/'. $category->category_photo);
            unlink($delete_from);
        }
        $category->forceDelete();
        return back();
    }
 }
