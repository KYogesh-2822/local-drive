<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class TravelController extends BaseController
{

    public function index(){
        $data = DB::table('travel_advisor_admin')->where('id',1)->first();
        $guides = DB::table('booking_guides')->get();
        return view('admin.travel-admin',compact('data','guides'));
    }

    public function addTrevalAdmin(Request $request){
        $update = DB::table('travel_advisor_admin')->where('id',1)->update([
            'admin_heading' => $request->heading,
            'admin_button' => $request->button
        ]);
        return redirect()->back()->with(['message' => 'Updated Successfully']);
    }

    public function addTrevalAdvisorContent(Request $request){
       
       $update = DB::table('travel_advisor_admin')->where('id',1)->update([
            'advisor_banner' => $request->banner_content
        ]);
        return redirect()->back()->with(['message' => 'Updated Successfully']);
    }

    public function addTrevalAdvisorPledge(Request $request){
         
        if($request->hasFile('pledge_image')){
            $request->validate([
                'pledge_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
    
            $imageName = time().'.'.$request->pledge_image->extension();  
            
            $request->pledge_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('travel_advisor_admin')->where('id',1)->value('pledge_image');
        }
        $update = DB::table('travel_advisor_admin')->where('id',1)->update([
            'pledge_image' => $imageName,
            'pledge_detail' => $request->pledge_detail,
            'pledge_button' => $request->pledge_button
        ]);
    
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function addTrevalAdvisorPolicy(Request $request){

       $update = DB::table('travel_advisor_admin')->where('id',1)->update([
        'policy_content' => $request->policy_content
       ]);
       return redirect()->back()->with(['message' => 'Updated Successfully']);
    }

    public function addTrevalAdvisorGuide(Request $request){
       $update = DB::table('booking_guides')->where('id',$request->id)->update([
        'heading' => $request->heading,
        'link' => $request->link
       ]);
       return redirect()->back()->with(['message' => 'Updated Successfully']);
    }

    public function addTrevalGuideHeading(Request $request){
       $update = DB::table('travel_advisor_admin')->where('id',1)->update([
        'guide_heading' => $request->guide_heading
       ]);
       return redirect()->back()->with(['message' => 'Updated Successfully']);
    }
}