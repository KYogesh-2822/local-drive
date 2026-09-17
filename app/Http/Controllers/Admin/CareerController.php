<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class CareerController extends BaseController
{

    public function index(){
        $data = DB::table('careers')->where('id',1)->first();
        $cards = DB::table('career_cards')->get();
        return view('admin.career',compact('data','cards'));
    }

    public function addContent(Request $request){
        $update = DB::table('careers')->where('id',1)->update([
            'banner_content' => $request->banner_content,
            'form_content' => $request->form_content,
            'mobility_content' => $request->mobility_content
        ]);
        return redirect()->back()->with(['message' => 'updated successfully']);
    }

    public function editCard(Request $request){
   
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
    
            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('career_cards')->where('id',$request->id)->value('image');
        }

        $update = DB::table('career_cards')->where('id',$request->id)->update([
            'image' => $imageName,
            'detail' => $request->detail
        ]);
    
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editLogoBanner(Request $request){
        if($request->hasFile('multi_logo'))
        {
            $i = 1;
            foreach($request->file('multi_logo') as $image)
            {
                $imageName = time().$i.'.'.$image->extension();  
                $image->move(public_path('images'), $imageName);      
                $i++;
                $logos[] = $imageName;
            }
            $logo = implode(",",$logos);
        }else{
            $logo = DB::table('careers')->where('id',1)->value('multi_logo'); 
        }
        $update = DB::table('careers')->where('id',1)->update([
          'logo_heading' => $request->logo_heading,
          'logo_text' => $request->logo_text,
          'multi_logo' => $logo
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }
}