<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class MeetQurPeopleController extends BaseController
{

    public function index(){
        $data = DB::table('meet_our_people')->where('id',1)->first();
        $data_cards = DB::table('meet_people_slider')->get();
        $data_review = DB::table('meet_people_review')->get();
        $data_card = DB::table('meet_people_cards')->get();
        return view('admin.meet-our-people',compact('data','data_cards','data_review','data_card'));
    }

    public function addContent(Request $request){
        $update = DB::table('meet_our_people')->where('id',1)->update([
            'heading' => $request->heading,
            'content' => $request->content,
            'content_right' => $request->content_right,
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editslider(Request $request){

        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
    
            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('meet_people_slider')->where('id',$request->id)->value('image');
        }
    
        $update = DB::table('meet_people_slider')->where('id',$request->id)->update([
            'image' => $imageName,
            'detail' => $request->detail
        ]);
    
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editCulture(Request $request){
        $update = DB::table('meet_our_people')->where('id',1)->update([
            'culture_heading' => $request->culture_heading,
            'culture_content' => $request->culture_content
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editReview(Request $request){
 
       if($request->hasFile('review_image')){
        $request->validate([
            'review_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

            $imageName = time().'.'.$request->review_image->extension();  
            
            $request->review_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('meet_people_review')->where('id',$request->id)->value('image');
        }

        $update = DB::table('meet_people_review')->where('id',$request->id)->update([
            'image' => $imageName,
            'video' => $request->review_link,
            'name' => $request->review_name,
            'detail' => $request->detail
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editCard(Request $request){
      if($request->hasFile('card_image')){
        $request->validate([
            'card_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

            $imageName = time().'.'.$request->card_image->extension();  
            
            $request->card_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('meet_people_cards')->where('id',$request->id)->value('image');
        }

        $update = DB::table('meet_people_cards')->where('id',$request->id)->update([
            'image' => $imageName,
            'detail' => $request->card_detail,
            'button' => $request->card_button
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editRoadSuccess(Request $request){
       $update = DB::table('meet_our_people')->where('id',1)->update([
        'road_heading' => $request->road_heading,
        'road_content' => $request->road_content,
        'road_button' => $request->road_button,
    ]);
    return redirect()->back()->with(['message' => 'Update successfully']);
    }



}