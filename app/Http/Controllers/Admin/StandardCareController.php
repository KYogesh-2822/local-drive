<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class StandardCareController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        $data  = DB::table('standard_care')->where('id',1)->first();
        $cards  = DB::table('standard_care_cards')->get();
        return view('admin.standard-care',compact('data','cards'));
    }

    public function content(Request $request){

      if($request->hasFile('banner_logo')){
        $request->validate([
            'banner_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->banner_logo->extension();  
         
        $request->banner_logo->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('standard_care')->where('id',1)->value('banner_logo');
        }

        $update = DB::table('standard_care')->where('id',1)->update([
            'content' => $request->standard_content,
            'banner_logo' => $imageName
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function standardCard(Request $request){
   
        if($request->hasFile('icon')){
            $request->validate([
                'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $imageName = time().'.'.$request->icon->extension();  
             
            $request->icon->move(public_path('images'), $imageName);
            }else{
                $imageName = DB::table('standard_care_cards')->where('id',$request->id)->value('logo');
            }
    
            $update = DB::table('standard_care_cards')->where('id',$request->id)->update([
                'content' => $request->content,
                'logo' => $imageName
            ]);
    
            return redirect()->back()->with(['message' => 'Update successfully']);
    }
}
