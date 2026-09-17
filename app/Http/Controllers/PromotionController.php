<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PromotionController extends Controller
{
    public function index(){
        $data = DB::table('promotion_coupons')->where('id',1)->first();
        $cards = DB::table('promotion_offers')->get();
        return view('promotion.deal-promotion',compact('data','cards'));
    }

    public function emailSpecial(){
        return view('promotion.email-special');
    }

    public function travelPartner(){
        $program = DB::table('reward_programs')->where('id',1)->first();
        $reward_images = DB::table('reward_images')->get();
        return view('promotion.travel-partner',compact('program','reward_images'));
    }

}
