<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class AboutController extends BaseController
{

    public function index(){
        $data = DB::table('about_us')->where('id',1)->first();
        $images = DB::table('about_us_images')->orderBy('id', 'DESC')->get();
        $sliders = DB::table('about_us_slider')->get();
        $cards = DB::table('about_us_card')->get();
        return view('admin.about-us',compact('data','images','sliders','cards'));
    }

    public function editAboutContent(Request $request){

        if($request->hasFile('left_column')){
            $request->validate([
                'left_column' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $imageName = time().'.'.$request->left_column->extension();  
            
            $request->left_column->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('about_us')->where('id',1)->value('left_column');
        }

        $update = DB::table('about_us')->where('id',1)->update([
            'heading' => $request->heading,
            'left_column' => $imageName,
            'center_column' => $request->center_column,
            'right_column' => $request->right_column
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editAboutmultiImage(Request $request){

        if($request->hasFile('multi_images'))
        {
            // $request->validate([
            //     'multi_images' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            // ]);
            $i = 1;
            foreach($request->file('multi_images') as $image)
            {
                $imageName = time().$i.'.'.$image->extension();  
                $image->move(public_path('images'), $imageName);      
                $create = DB::table('about_us_images')->insert([
                    'image' => $imageName,
                ]);
                $i++;
            }
         
        }
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editAboutValue(Request $request){
      
        if($request->hasFile('value_image')){
            $request->validate([
                'value_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,avif',
            ]);

            $imageName = time().'.'.$request->value_image->extension();  
            
            $request->value_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('about_us')->where('id',1)->value('value_image');
        }

        $update = DB::table('about_us')->where('id',1)->update([
            'value_image' => $imageName,
            'value_content' => $request->value_content,
            'value_heading' => $request->value_heading
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editAboutSlider(Request $request){
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,avif',
            ]);

            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('about_us_slider')->where('id',$request->id)->value('image');
        }

        $update = DB::table('about_us_slider')->where('id',$request->id)->update([
            'image' => $imageName,
            'content' => $request->detail
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editAboutCards(Request $request){
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,avif',
            ]);

            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('about_us_card')->where('id',$request->id)->value('image');
        }

        $update = DB::table('about_us_card')->where('id',$request->id)->update([
            'image' => $imageName,
            'heading' => $request->heading,
            'detail' => $request->detail,
            'button' => $request->button
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editAboutBanner(Request $request){

        if($request->hasFile('banner_image')){
            $request->validate([
                'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $imageName = time().'.'.$request->banner_image->extension();  
            
            $request->banner_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('about_us')->where('id',1)->value('banner_image');
        }

        $update = DB::table('about_us')->where('id',1)->update([
            'banner_content' => $request->banner_content,
            'banner_image' => $imageName,
            'banner_button' => $request->banner_button
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function deleteAboutMultiImage(Request $request){
        $images = DB::table('about_us_images')->where('id',$request->id)->delete();
        return response()->json(['status'=>'success','message'=>'Image has been deleted successfully']);
    }

}