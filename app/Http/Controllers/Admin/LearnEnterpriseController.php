<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class LearnEnterpriseController extends BaseController
{
    public function index(){
        $data = DB::table('learn_enterprise')->where('id',1)->first();
        $rewards = DB::table('enterprise_rewards')->get();
        return view('admin.learn-enterprise',compact('data','rewards'));
    }

    public function addLearnContent(Request $request){
     
        if($request->hasFile('left_column')){
            $request->validate([
                'left_column' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
    
            $imageName = time().'.'.$request->left_column->extension();  
            
            $request->left_column->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('learn_enterprise')->where('id',1)->value('left_column');
        }

        $update = DB::table('learn_enterprise')->where('id',1)->update([
            'left_column' => $imageName,
            'heading' => $request->heading,
            'center_column' => $request->center_column
        ]);
    
        return redirect()->back()->with(['message' => 'Update successfully']);

    }

    public function addLearnreward(Request $request){
        if($request->hasFile('reward_image')){
            $request->validate([
                'reward_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
    
            $imageName = time().'.'.$request->reward_image->extension();  
            
            $request->reward_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('learn_enterprise')->where('id',1)->value('reward_image');
        }

        $update = DB::table('learn_enterprise')->where('id',1)->update([
            'reward_image' => $imageName,
            'reward_detail' => $request->reward_detail,
            'reward_button' => $request->reward_button
        ]);
    
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function addLearnBenifit(Request $request){
        $update = DB::table('learn_enterprise')->where('id',1)->update([
            'benifit_heading' => $request->benifit_heading,
            'benifit_detail' => $request->benifit_detail
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function addLearnRewardPoint(Request $request){
        $update = DB::table('enterprise_rewards')->where('id',$request->id)->update([
            'heading' => $request->heading,
            'points' => $request->point
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }
    public function addLearnRewardHeading(Request $request){
        $update = DB::table('learn_enterprise')->where('id',1)->update([
            'reward_point_heading' => $request->reward_point_heading
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

}