<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RentallocationsController extends Controller
{
    public function index(){
       $data = DB::table('location_us')->first();
       $faqs = DB::table('faq_questions')->where('topic_id', 1)->get();
       $states = DB::table('us_state_cities')->get();
       foreach($states as $state){
          $data_states = DB::table('us_state_cities')->select('us_state_cities.*','states.name')->leftJoin('states','us_state_cities.state_id', '=' ,'states.id')->get();
       }

       return view('location.jordan-rental-location',compact('data','faqs','data_states'));
    }

    public function interLocation(){
       $data = DB::table('location_inter')->first();
       $cards = DB::table('location_inter_card')->get();
       $popular = DB::table('countries')->select('id','name')->where('popular','yes')->get();
       $regions = DB::table('inter_regions')->select('inter_regions.*','regions.name')->leftJoin('regions','inter_regions.region_id', '=' ,'regions.id')->get();
       $website_countries = DB::table('countries')->select('id','name','link')->where('link','!=','')->get();
       return view('location.inter-rental-location',compact('data','cards','popular','regions','website_countries'));
    }

    public function locationResult(){
   
   
       return view('location.location-result',compact('count','location'));
    }

    public function locationSearch(Request $request){
      if ($request->isMethod('post')) {
            $loc = DB::connection('mysql_second')->table('location_details')->where('location_name',$request->search_location)->first();
            if($request->has('loc_type')){
               $location = DB::connection('mysql_second')->table('location_details')->whereIn('location_type',$request->loc_type)->get(); 
               $pluck = $location->pluck('location_type')->toArray();
            }else{
               $location = DB::connection('mysql_second')->table('location_details')->get();
               $pluck = [];
            }      
            $count = $location->count();

            return view('location.location-result',compact('loc','location','count','pluck'));
      }
      if ($request->isMethod('get')) {
         $location = DB::connection('mysql_second')->table('location_details')->get();
         $count = $location->count();
         $pluck = [];
         return view('location.location-result',compact('location','count','pluck'));
      }
    }

    public function singleLocation($id){
         $data = DB::connection('mysql_second')->table('location_details')->where('id',$id)->first(); 
         $policies = DB::table('rental_policies')->get(); 
         if($data->location_type == 'airport'){
            $near = DB::connection('mysql_second')->table('location_details')->where('location_type',$data->location_type )->where('id','!=',$data->id)->get(); 
         }else{
            $near = DB::connection('mysql_second')->table('location_details')->where('location_type',$data->location_type )->where('id','!=',$data->id)->get(); 
         }
        return view('location.single-location',compact('data','policies','near'));
    }

    
}