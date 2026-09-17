<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class BusinessController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        $data = DB::table('business_solution')->where('id',1)->first();
        $business_today = DB::table('business_today')->get();
        $business_benifit = DB::table('business_benifits')->get();
        $business_rentail = DB::table('business_rental_program')->get();
        $business_tool = DB::table('business_tools')->get();
        return view('admin.business',compact('data','business_today','business_benifit','business_rentail','business_tool'));
    }

    public function businessBanner(Request $request){
        if($request->hasFile('banner_image')){
            $request->validate([
                'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
    
            $imageName = time().'.'.$request->banner_image->extension();  
            
            $request->banner_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('business_solution')->where('id',1)->value('banner_image');
        }
    
        $update = DB::table('business_solution')->where('id',1)->update([
            'banner_image' => $imageName,
            'banner_content' => $request->banner_text,
            'first_button' => $request->first_button
            // 'signup_line' => $request->signup_line
        ]);
    
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function businessToday(Request $request){
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('images'), $imageName);
            }else{
                $imageName = DB::table('business_today')->where('id',$request->id)->value('image');
            }

            $update = DB::table('business_today')->where('id',$request->id)->update([
                'image' => $imageName,
                'heading' => $request->heading,
                'detail' => $request->detail
            ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function businessTodayHeading(Request $request){
        $update = DB::table('business_solution')->where('id',1)->update(['today_business_heading' => $request->today_business_heading]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function businessBenifits(Request $request){
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
    
            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('business_benifits')->where('id',$request->id)->value('image');
        }
    
        $update = DB::table('business_benifits')->where('id',$request->id)->update([
            'image' => $imageName,
            'detail' => $request->detail
        ]);
    
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function businessBenifitHeading(Request $request){
       $update = DB::table('business_solution')->where('id',1)->update(['benefit_heading' => $request->business__benifit_heading]);
       return redirect()->back()->with(['message' => 'Update successfully']);
    } 

    public function businessLoyalty(Request $request){
        
        if($request->hasFile('loyalty_image')){
            $request->validate([
                'loyalty_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $imageName = time().'.'.$request->loyalty_image->extension();  
            
            $request->loyalty_image->move(public_path('images'), $imageName);
            }else{
                $imageName = DB::table('business_solution')->where('id',1)->value('loyalty_image');
            }
            $update = DB::table('business_solution')->where('id',1)->update([
                'loyalty_image' => $imageName,
                'loyalty_heading' => $request->loyalty_heading,
                'loyalty_detail' => $request->loyalty_detail
            ]);

        return redirect()->back()->with(['message' => 'Update successfully']);

    }

    public function businessRentailProgram(Request $request){
        $update = DB::table('business_solution')->where('id',1)->update(['rentail_program_heading' => $request->business_rental_program]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function businessRentail(Request $request){

        $update = DB::table('business_rental_program')->where('id',$request->id)->update([
            'text' => $request->detail,
            'button' => $request->button
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function businessRentailImages(Request $request){
        if($request->hasFile('multi_image'))
        {
            $i = 1;
            foreach($request->file('multi_image') as $image)
            {
                $imageName = time().$i.'.'.$image->extension();  
                $image->move(public_path('images'), $imageName);      
                $i++;
                $images[] = $imageName;
            }
            $image = implode(",",$images);
        }else{
            $image = DB::table('business_solution')->where('id',1)->value('rentail_program_images'); 
        }
     $update = DB::table('business_solution')->where('id',1)->update(['rentail_program_images' => $image]);
     return redirect()->back()->with(['message' => 'Update successfully']);

    }

    public function businessCenter(Request $request){
        if($request->hasFile('center_image')){
            $request->validate([
                'center_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $imageName = time().'.'.$request->center_image->extension();  
            
            $request->center_image->move(public_path('images'), $imageName);
            }else{
                $imageName = DB::table('business_solution')->where('id',1)->value('center_image');
            }
            $update = DB::table('business_solution')->where('id',1)->update([
                'center_image' => $imageName,
                'center_content' => $request->center_content,
                'center_button' => $request->center_button
            ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    } 

    public function businessSafety(Request $request){
        $update = DB::table('business_solution')->where('id',1)->update([
            'safety_content' => $request->safety_content,
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function businessTool(Request $request){
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('images'), $imageName);
            }else{
                $imageName = DB::table('business_tools')->where('id',$request->id)->value('image');
            }
            $update = DB::table('business_tools')->where('id',$request->id)->update([
                'image' => $imageName,
                'detail' => $request->tool_detail,
                'button' => $request->button_text
            ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
       
    }

    public function businessToolHeading(Request $request){
        $update = DB::table('business_solution')->where('id',1)->update([
            'tool_heading' => $request->tool_heading,
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);

    }

    public function chooseenterpriseHeading(Request $request){
        $update = DB::table('business_solution')->where('id',1)->update([
            'enterprise_heading' => $request->enterprise_heading
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);

    }

    public function chooseenterpriseContent(Request $request){
        $update = DB::table('business_solution')->where('id',1)->update([
            'choose_content1' => $request->choose_content1,
            'choose_content2' => $request->choose_content2,
            'choose_content3' => $request->choose_content3,
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function signingUp(Request $request){
       $update = DB::table('business_solution')->where('id',1)->update([
        'signing_up_step' => $request->signing_up_step
       ]);
       return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function retailForm(){
        $data = DB::table('business_solution')->where('id',1)->first();
        return view('admin.business-form',compact('data'));
    }
    
    public function retailFormSave(Request $request){
   
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('business_solution')->where('id',1)->value('business_form_image');
        }

        $update = DB::table('business_solution')->where('id',1)->update([
            'business_form_image' => $imageName,
            'business_form_content' => $request->banner_text,
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }
}

