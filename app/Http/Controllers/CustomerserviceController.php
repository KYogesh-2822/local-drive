<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CustomerserviceController extends Controller
{
    public function faq(){
        $topics = DB::table('faq_topics')->get();
        $faq =  DB::table('help&faqs')->where('id',1)->first();
        return view('customer.faq',compact('topics','faq'));
    }

    public function contact(){
        $data = DB::table('contact_us')->where('id',1)->first();
        $cards = DB::table('contact_us_card')->get();
        return view('customer.contact',compact('data','cards'));
    }

    public function siteMap(){
        $datas =  DB::table('site_map_heading')->get();
        return view('customer.site-map',compact('datas'));
    }

    public function faqPickup($id){
        $data =  DB::table('faq_questions')->where('id',$id)->first();
        return view('customer.pick-up',compact('data'));
    }

    public function accident(){
        return view('customer.rent-a-car-after-an-accident');
    }

    public function supportService(){
        return view('customer.supporting-those-service');
    }
    public function guide(){
        return view('customer.guide');
    }




    
}
