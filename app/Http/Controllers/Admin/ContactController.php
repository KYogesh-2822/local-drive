<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class ContactController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        $data = DB::table('contact_us')->where('id',1)->first();
        $cards = DB::table('contact_us_card')->get();
        return view('admin.contact-us',compact('data','cards'));
    }
    
    public function addContact(Request $request){
       $update = DB::table('contact_us')->where('id',1)->update(['banner_content' => $request->banner_content]);
       return redirect()->back()->with(['message' => 'Content has been updated successfully']);
    }

    public function updateContact(Request $request){
        if($request->hasFile('card_icon')){
            $request->validate([
                'card_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->card_icon->extension();  
            
            $request->card_icon->move(public_path('images'), $imageName);
            }else{
                $imageName = DB::table('contact_us_card')->where('id',$request->card_id)->value('image');
            }

            $update = DB::table('contact_us_card')->where('id',$request->card_id)->update([
                'image' => $imageName,
                'heading' => $request->card_heading,
                'detail' => $request->card_detail
            ]);

            return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function section1Contact(Request $request){
     
        $update = DB::table('contact_us')->where('id',1)->update([
            'section1Content' => $request->section1Content,
            'section2Content' => $request->section2Content,
            'section3Content' => $request->section3Content,
            'section4Content' => $request->section4Content,
            'section5Content' => $request->section5Content,
            'section6Content' => $request->section6Content
        ]);
        return redirect()->back()->with(['message' => 'Content has been updated successfully']);
    }

    public function bannerContact(Request $request){
      if($request->hasFile('banner')){
        $request->validate([
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->banner->extension();  
        
        $request->banner->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('contact_us')->where('id',1)->value('banner_image');
        }

        $update = DB::table('contact_us')->where('id',1)->update([
            'banner_image' => $imageName,
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function lastSectionContact(Request $request){
      $update = DB::table('contact_us')->where('id',1)->update([
        'last_section' => $request->lastSection
    ]);
    return redirect()->back()->with(['message' => 'Content has been updated successfully']);
    }
}