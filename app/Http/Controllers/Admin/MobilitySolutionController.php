<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class MobilitySolutionController extends BaseController
{

    public function index(){
        $cards = DB::table('mobility_solution_cards')->get();
        $data = DB::table('mobility_solution')->where('id',1)->first();
        return view('admin.mobility-solution',compact('cards','data'));
    }

    public function addMobilityCard(Request $request){
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
    
            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('mobility_solution_cards')->where('id',$request->id)->value('image');
        }
    
        $update = DB::table('mobility_solution_cards')->where('id',$request->id)->update([
            'image' => $imageName,
            'detail' => $request->detail,
            'button' => $request->button
        ]);
    
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function mobilityContent(Request $request){
        $update = DB::table('mobility_solution')->where('id',1)->update(['content' => $request->mobility_content]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function mobilityBannerImage(Request $request){
        if($request->hasFile('banner_image')){
            $request->validate([
                'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
    
            $imageName = time().'.'.$request->banner_image->extension();  
            
            $request->banner_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('mobility_solution')->where('id',1)->value('image');
        }
    
        $update = DB::table('mobility_solution')->where('id',1)->update([
            'image' => $imageName,
        ]);
    
        return redirect()->back()->with(['message' => 'Update successfully']);
    }
}