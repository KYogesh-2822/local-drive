<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class InspirationController extends Controller
{

    public function index(){
        $data =  DB::table('trip_ideas')->where('id',1)->first();
        $cards =  DB::table('trip_idea_cards')->get();
        return view('inspiration.road-trip',compact('data','cards'));
    }

    public function pursuit(){
        $data = DB::table('explore_jordan')->where('id',1)->first();
        $images = DB::table('jordan_images')->get();
        return view('inspiration.pursuits-with-enterprise',compact('data','images'));
    }
    
    public function afterAccident(){
        return view('inspiration.rent-car-after-accident');
    }
    
}

