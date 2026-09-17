<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class ReservationController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        $intro = DB::table('reservation_intro')->where('id',1)->first();
        $first_cards = DB::table('reservation_first_section')->get();
        $second_cards = DB::table('reservation_second_section')->get();
        $third_cards = DB::table('reservation_third_section')->get();
        $vmc = DB::table('reservation_vmc')->where('id',1)->first();
        $receipt = DB::table('reservation_receipt')->where('id',1)->first();
        $shortTerm_banner = DB::table('reservation_shortTerm_banner')->where('id',1)->first();
        $shortTerm_cards = DB::table('reservation_shortTerm_cards')->get();
        $subscribe = DB::table('reservation_subscribe')->where('id',1)->first();
        $subscribe_cards = DB::table('reservation_subscribe_card')->get();
        $subscribe_works = DB::table('reservation_subscribe_work')->get();
        $subscribe_link = DB::table('reservation_subscribe_link')->where('id',1)->first();
       return view('admin.reservation',compact('intro','first_cards','second_cards','third_cards','vmc','receipt','shortTerm_banner','shortTerm_cards','subscribe','subscribe_cards','subscribe_works','subscribe_link'));
    }

    public function reservationIntro(Request $request){
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $imageName = time().'.'.$request->image->extension();  
             
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('reservation_intro')->where('id',1)->value('image');
        }

        $update = DB::table('reservation_intro')->where('id',1)->update([
            'discription' => $request->discription,
            'image' => $imageName
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function reservationFirstcard(Request $request){
       if($request->hasFile('section1_image')){
        $request->validate([
            'section1_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->section1_image->extension();  
         
        $request->section1_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('reservation_first_section')->where('id',$request->section1_id)->value('image');
        }

        $update = DB::table('reservation_first_section')->where('id',$request->section1_id)->update([
            'heading' => $request->section1_heading,
            'detail' => $request->section1_discription,
            'button' => $request->section1_button,
            'image' => $imageName
        ]);

       return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function reservationSecondcard(Request $request){
        if($request->hasFile('section2_image')){
            $request->validate([
                'section2_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $imageName = time().'.'.$request->section2_image->extension();  
             
            $request->section2_image->move(public_path('images'), $imageName);
            }else{
                $imageName = DB::table('reservation_second_section')->where('id',$request->section2_id)->value('image');
            }
    
            $update = DB::table('reservation_second_section')->where('id',$request->section2_id)->update([
                'heading' => $request->section2_heading,
                'detail' => $request->section2_discription,
                'button' => $request->section2_button,
                'image' => $imageName
            ]);
    
           return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function reservationThirdcard(Request $request){
      if($request->hasFile('section3_image')){
        $request->validate([
            'section3_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->section3_image->extension();  
         
        $request->section3_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('reservation_third_section')->where('id',$request->section3_id)->value('image');
        }

        $update = DB::table('reservation_third_section')->where('id',$request->section3_id)->update([
            'heading' => $request->section3_heading,
            'detail' => $request->section3_discription,
            'button' => $request->section3_button,
            'image' => $imageName
        ]);

       return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function reservationVmc(Request $request){
        $update = DB::table('reservation_vmc')->where('id',1)->update([
            'heading' => $request->vmc_heading,
            'discription' => $request->vmc_discription
        ]); 
     return redirect()->back()->with(['message' => 'Update successfully']);
    } 

    public function reservationReceipt(Request $request){
        $update = DB::table('reservation_receipt')->where('id',1)->update([
            'heading' => $request->receipt_heading,
            'discription' => $request->receipt_discription
        ]); 
     return redirect()->back()->with(['message' => 'Update successfully']);

    }

    public function reservationshortTermBanner(Request $request){
        if($request->hasFile('shortTerm_banner_image')){
            $request->validate([
                'shortTerm_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->shortTerm_banner_image->extension();  
            
            $request->shortTerm_banner_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('reservation_shortTerm_banner')->where('id',1)->value('image');
        }

        $update = DB::table('reservation_shortTerm_banner')->where('id',1)->update([
            'heading' => $request->shortTerm_banner_heading,
            'discription' => $request->shortTerm_banner_discription,
            'image' => $imageName
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function reservationshortTermBenefit(Request $request){
       $update = DB::table('reservation_shortTerm_banner')->where('id',1)->update([
        'shortTerm_benefit' => $request->shortTerm_benefit,
        'why_shortTerm' => $request->why_shortTerm
       ]);
       return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function reservationshortTermCard(Request $request){
        if($request->hasFile('shortTerm_card_image')){
            $request->validate([
                'shortTerm_card_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->shortTerm_card_image->extension();  
            
            $request->shortTerm_card_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('reservation_shortTerm_cards')->where('id',$request->shortTerm_card_id)->value('image');
        }

        $update = DB::table('reservation_shortTerm_cards')->where('id',$request->shortTerm_card_id)->update([
            'heading' => $request->shortTerm_card_heading,
            'detail' => $request->shortTerm_card_discription,
            'image' => $imageName,
            'button' => $request->shortTerm_card_button
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function reservationshortTermBusiness(Request $request){
        if($request->hasFile('shortTerm_business_image')){
            $request->validate([
                'shortTerm_business_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->shortTerm_business_image->extension();  
            
            $request->shortTerm_business_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('reservation_shortTerm_banner')->where('id',1)->value('business_image');
        }

        $update = DB::table('reservation_shortTerm_banner')->where('id',1)->update([
            'business_text' => $request->shortTerm_business_text,
            'business_button' => $request->shortTerm_business_button,
            'business_image' => $imageName
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function reservationSubscribe(Request $request){
        if($request->hasFile('subscribe_banner_image')){
            $request->validate([
                'subscribe_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->subscribe_banner_image->extension();  
            
            $request->subscribe_banner_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('reservation_subscribe')->where('id',1)->value('banner_image');
        }

        $update = DB::table('reservation_subscribe')->where('id',1)->update([
            'banner_image' => $imageName
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);

    }

    public function reservationContent(Request $request){

        $update = DB::table('reservation_subscribe')->where('id',1)->update([
          'content' => $request->subscribe_content
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function reservationSubCard(Request $request){
        if($request->hasFile('sub_image')){
            $request->validate([
                'sub_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->sub_image->extension();  
            
            $request->sub_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('reservation_subscribe_card')->where('id',$request->sub_id)->value('image');
        }

        $update = DB::table('reservation_subscribe_card')->where('id',$request->sub_id)->update([
            'heading' => $request->sub_heading,
            'image' => $imageName,
            'detail' => $request->sub_discription
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function reservationSubWork(Request $request){
      
        if($request->hasFile('sub_work_image')){
            $request->validate([
                'sub_work_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->sub_work_image->extension();  
            
            $request->sub_work_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('reservation_subscribe_work')->where('id',$request->sub_work_id)->value('image');
        }

        $update = DB::table('reservation_subscribe_work')->where('id',$request->sub_work_id)->update([
            'heading' => $request->sub_work_heading,
            'image' => $imageName,
            'detail' => $request->sub_work_discription
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);

    }

    public function reservationSubWorkheading(Request $request){
        $update = DB::table('reservation_subscribe')->where('id',1)->update([
            'work_heading' => $request->work_heading
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);

    }

    public function reservationSubLink(Request $request){
        $update = DB::table('reservation_subscribe_link')->where('id',1)->update([
            'heading' => $request->link_heading,
            'heading' => $request->link_heading1,
            'heading' => $request->link_heading2
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);

    }

    public function reservationSubLastlink(Request $request){
        $update = DB::table('reservation_subscribe')->where('id',1)->update([
            'last_content' => $request->subscribe_last_content
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);

    }

    public function LongTermRental(){
        $data = DB::table('long_term_rental')->where('id',1)->first();
        return view('admin.long-term',compact('data'));
    }

    public function editLongTermRental(Request $request){
        if($request->hasFile('banner_image')){
            $request->validate([
                'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->banner_image->extension();  
            
            $request->banner_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('long_term_rental')->where('id',1)->value('image');
        }

        $update = DB::table('long_term_rental')->where('id',1)->update([
            'heading' => $request->banner_heading,
            'banner_image' => $imageName
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);

    }

    public function editLongTermCardText(Request $request){
        $update = DB::table('long_term_rental')->where('id',1)->update([
            'rate_text' => $request->rate_text,
            'mileage_text' => $request->mileage_text,
            'location_text' => $request->location_text
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editLongTermPopularText(Request $request){
  
       if($request->hasFile('popular_images'))
       {
           $i = 1;
           foreach($request->file('popular_images') as $image)
           {
               $imageName = time().$i.'.'.$image->extension();  
               $image->move(public_path('images'), $imageName);      
               $i++;
               $images[] = $imageName;
           }
           $popular = implode(",",$images);
       }else{
           $popular = DB::table('long_term_rental')->where('id',1)->value('popular_images'); 
       }
       $update = DB::table('long_term_rental')->where('id',1)->update([
         'popular_text' => $request->popular_text,
         'popular_button' => $request->popular_button,
         'popular_images' => $popular
       ]);
       return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editLongTermReasonText(Request $request){
        if($request->hasFile('reason_image')){
            $request->validate([
                'reason_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->reason_image->extension();  
            
            $request->reason_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('long_term_rental')->where('id',1)->value('image');
        }

        $update = DB::table('long_term_rental')->where('id',1)->update([
            'reason_text' => $request->reason_text,
            'reason_button' => $request->reason_button,
            'reason_image' => $imageName
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editLongTermLeaseRental(Request $request){
      
        $update = DB::table('long_term_rental')->where('id',1)->update([
           'lease_rental' => $request->lease_rental
       ]);
       return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function oneWayRental(){
        $data = DB::table('one-way-rental')->where('id',1)->first();
        return view('admin.one-way',compact('data'));
    }

    public function editOneWayRental(Request $request){
       $update = DB::table('one-way-rental')->where('id',1)->update([
        'mileage_text' => $request->mileage_text,
        'location_text' => $request->location_text,
        'time_text' => $request->time_text
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editOneWayRentalType(Request $request){
       if($request->hasFile('car_type_image'))
       {
           $i = 1;
           foreach($request->file('car_type_image') as $image)
           {
               $imageName = time().$i.'.'.$image->extension();  
               $image->move(public_path('images'), $imageName);      
               $i++;
               $images[] = $imageName;
           }
           $popular = implode(",",$images);
       }else{
           $popular = DB::table('one-way-rental')->where('id',1)->value('car_type_image'); 
       }
       $update = DB::table('one-way-rental')->where('id',1)->update([
         'type_text' => $request->type_text,
         'car_type_image' => $popular
       ]);
       return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editOneWayRentalmileage(Request $request){
        $update = DB::table('one-way-rental')->where('id',1)->update([
            'full_mileage_text' => $request->full_mileage_text
          ]);
          return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editOneWayRentalLooking(Request $request){
        if($request->hasFile('looking_image'))
        {
            $i = 1;
            foreach($request->file('looking_image') as $image)
            {
                $imageName = time().$i.'.'.$image->extension();  
                $image->move(public_path('images'), $imageName);      
                $i++;
                $images[] = $imageName;
            }
            $popularimg = implode(",",$images);
        }else{
            $popularimg = DB::table('one-way-rental')->where('id',1)->value('looking_image'); 
        }
        $update = DB::table('one-way-rental')->where('id',1)->update([
          'looking_trip_text' => $request->looking_trip_text,
          'looking_image' => $popularimg
        ]);
        return redirect()->back()->with(['message' => 'Update successfully']);
     }
}
