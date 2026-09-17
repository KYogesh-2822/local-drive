<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class PromotionController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        $data = DB::table('promotion_coupons')->where('id',1)->first();
        $cards = DB::table('promotion_offers')->get();
        $program = DB::table('reward_programs')->where('id',1)->first();
        $reward_images = DB::table('reward_images')->get();
        return view('admin.promotion',compact('data','cards','program','reward_images'));
    }

    public function add(Request $request){
        $update = DB::table('promotion_coupons')->where('id',1)->update([
            'heading' => $request->heading,
            'message' => $request->message
        ]);
        return redirect()->back()->with(['message' => 'Content had been added successfully']);
    }

    public function updateOffer(Request $request){
 
        if($request->hasFile('card_icon')){
            $request->validate([
                'card_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $imageName = time().'.'.$request->card_icon->extension();  
            
            $request->card_icon->move(public_path('images'), $imageName);
            }else{
                $imageName = DB::table('promotion_offers')->where('id',$request->card_id)->value('image');
            }
    
            $update = DB::table('promotion_offers')->where('id',$request->card_id)->update([
                'image' => $imageName,
                'heading' => $request->card_heading,
                'detail' => $request->card_detail
            ]);
    
            return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function program(Request $request){
        $update = DB::table('reward_programs')->where('id',1)->update(['content' => $request->content]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function updateImage(Request $request){
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('images'), $imageName);
            }else{
                $imageName = DB::table('reward_images')->where('id',$request->image_id)->value('image');
            }
    
            $update = DB::table('reward_images')->where('id',$request->image_id)->update([
                'image' => $imageName,
            ]);
    
            return redirect()->back()->with(['message' => 'Update successfully']);
    }

}
