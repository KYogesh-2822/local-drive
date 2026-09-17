<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Validator;
use DB;

class HomeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        $offers = DB::table('home_offers')->get();
        $blogs = DB::table('home_blogs')->get();
        $carsOffres = DB::table('home_carRentals_offer')->get();
        $cards = DB::table('home_carRentals')->get();
        $carHead = DB::table('home_carRentals_heading')->first();
        $banner = DB::table('banner_image')->first();
        return view('admin.home-page',compact('offers','blogs','carsOffres','cards','carHead','banner'));
    }

    public function createOffer(Request $request){
        if($request->hasFile('project_image')){
            $request->validate([
                'icon_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $imageName = time().'.'.$request->icon_image->extension();  
             
            $request->icon_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('home_offers')->where('id',$request->id)->value('icon_image');
        }

        $update = DB::table('home_offers')->where('id',$request->id)->update([
            'icon_image' => $imageName,
            'heading' => $request->heading,
            'discription' => $request->discription
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function rentalHeading(Request $request){
        DB::table('home_carRentals_heading')->where('id',1)->update(['heading' => $request->main_heading, 'detail' => $request->main_detail]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function rentalOffer(Request $request){
       DB::table('home_carRentals_offer')->where('id',$request->id)->update(['offer_heading' => $request->offer_heading, 'offer_detail' => $request->offer_discription]);
       return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function rentalCard(Request $request){
     
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('home_carRentals')->where('id',$request->id)->value('card_image');
        }

        $update = DB::table('home_carRentals')->where('id',$request->id)->update([
            'card_image' => $imageName,
            'image_title' => $request->image_title,
            'card_heading' => $request->heading,
            'card_detail' => $request->detail,
            'button' => $request->button
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function homeLearn(Request $request){

        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('home_blogs')->where('id',$request->id)->value('image');
        }

        $update = DB::table('home_blogs')->where('id',$request->id)->update([
            'image' => $imageName,
            'heading' => $request->heading,
            'discription' => $request->discription,
            'button' => $request->button,
            'link' => $request->link
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function homeBanner(Request $request){
        if($request->hasFile('banner')){
            $request->validate([
                'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->banner->extension();  
            
            $request->banner->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('banner_image')->where('id',1)->value('image');
        }

        $update = DB::table('banner_image')->where('id',1)->update([
            'image' => $imageName
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }
}
