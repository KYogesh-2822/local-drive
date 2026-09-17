<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class InspirationController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        $data =  DB::table('trip_ideas')->where('id',1)->first();
        $cards =  DB::table('trip_idea_cards')->get();
        return view('admin.inspiration',compact('data','cards'));
    }

    public function BannerContent(Request $request){
       $update = DB::table('trip_ideas')->where('id',1)->update(['banner_content' => $request->banner_content]);
       return redirect()->back()->with(['message' => 'Updated successfully']);
    }

    public function planningContent(Request $request){

       if($request->hasFile('planning_image')){
        $request->validate([
            'planning_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->planning_image->extension();  
        
        $request->planning_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('trip_ideas')->where('id',1)->value('planning_image');
        }

        $update = DB::table('trip_ideas')->where('id',1)->update([
            'planning_image' => $imageName,
            'planning_detail' => $request->planning_content,
            'planning_button' => $request->planning_button
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    } 

    public function destinationContent(Request $request){
  
       if($request->hasFile('destination_image')){
        $request->validate([
            'destination_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->destination_image->extension();  
        
        $request->destination_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('trip_ideas')->where('id',1)->value('destination_image');
        }

        $update = DB::table('trip_ideas')->where('id',1)->update([
            'destination_image' => $imageName,
            'destination_detail' => $request->destination_content,
            'destination_button' => $request->destination_button
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function bestTripContent(Request $request){
       if($request->hasFile('best_trip_image')){
        $request->validate([
            'best_trip_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->best_trip_image->extension();  
        
        $request->best_trip_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('trip_ideas')->where('id',1)->value('best_trip_image');
        }

        $update = DB::table('trip_ideas')->where('id',1)->update([
            'best_trip_image' => $imageName,
            'best_trip_detail' => $request->best_trip_content,
            'best_trip_button' => $request->best_trip_button
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function featureHeading(Request $request){
        $update = DB::table('trip_ideas')->where('id',1)->update([
            'feature_heading' => $request->feature_heading
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editFeatureCard(Request $request){
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('trip_idea_cards')->where('id',$request->id)->value('image');
        }
    
        $update = DB::table('trip_idea_cards')->where('id',$request->id)->update([
            'image' => $imageName,
            'detail' => $request->detail,
            'button' => $request->button
        ]);
    
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editFaqMessage(Request $request){
        $update = DB::table('trip_ideas')->where('id',1)->update([
            'faq_message' => $request->faq_message,
            'faq_button' => $request->faq_button
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function explore(){
         $data = DB::table('explore_jordan')->where('id',1)->first();
         $images = DB::table('jordan_images')->get();
        return view('admin.explore-jordan',compact('data','images'));
    }

    public function jordanBanner(Request $request){
  
        if($request->hasFile('logo')){
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $imageName = time().'.'.$request->logo->extension();  
            
            $request->logo->move(public_path('images'), $imageName);
            }else{
                $imageName = DB::table('explore_jordan')->where('id',1)->value('logo');
            }
        $update = DB::table('explore_jordan')->where('id',1)->update([
            'logo' => $imageName,
            'banner_line' => $request->logo_line,
            'banner_text' => $request->banner_content
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function jordanPeople(Request $request){
     $update = DB::table('explore_jordan')->where('id',1)->update(['people_heading' => $request->heading]);
     return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function jordanImage(Request $request){
     
       if($request->hasFile('image')){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
        
        $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = '';
        }
        $update = DB::table('jordan_images')->insert([
            'image' => $imageName,
            'name' => $request->name
        ]);

        return redirect()->back()->with(['message' => 'Add successfully']);
    } 

    public function editJordanImage(Request $request){
  
       if($request->hasFile('image')){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
            
        $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('jordan_images')->where('id',$request->id)->value('image');
        }

        $update = DB::table('jordan_images')->where('id',$request->id)->update([
            'image' => $imageName,
            'name' => $request->name
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function deleteJordanImage(Request $request){
        DB::table('jordan_images')->where('id',$request->id)->delete();
        return 1;
    }
}