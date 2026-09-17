<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
use DB;
use Auth;

class ReservationController extends Controller
{
    public function index(){
        $intro = DB::table('reservation_intro')->where('id',1)->first(); 
        $first_cards = DB::table('reservation_first_section')->get(); 
        $second_cards = DB::table('reservation_second_section')->get(); 
        $third_cards = DB::table('reservation_third_section')->get(); 
        return view('reservation.reservation',compact('intro','first_cards','second_cards','third_cards'));
    }

    public function vMc(){
        $vmc = DB::table('reservation_vmc')->where('id',1)->first();
        return view('reservation.view-modify-cancel',compact('vmc'));
    }

    public function receipt(){
        $receipts = DB::table('reservation_receipt')->where('id',1)->first();
        return view('reservation.receipt',compact('receipts'));
    }

    public function shortTermRental(){
        $short_term = DB::table('reservation_shortTerm_banner')->where('id',1)->first();
        $short_term_cards = DB::table('reservation_shortTerm_cards')->get();
        return view('reservation.short-term-rental',compact('short_term','short_term_cards'));
    }

    public function subscribeEnterprise(){
        $subscribe = DB::table('reservation_subscribe')->where('id',1)->first();
        $subscribe_cards = DB::table('reservation_subscribe_card')->get();
        $subscribe_works = DB::table('reservation_subscribe_work')->get();
        $subscribe_link = DB::table('reservation_subscribe_link')->where('id',1)->first();
        return view('reservation.subscribe-with-enterprise',compact('subscribe','subscribe_cards','subscribe_works','subscribe_link'));
    }

    public function oneWayEnterprise(){
        $data = DB::table('one-way-rental')->where('id',1)->first();
        return view('reservation.one-way-car-rental', compact('data'));
    }

    public function ourStandardCare(){
        $data = DB::table('standard_care')->where('id',1)->first();
        $cards = DB::table('standard_care_cards')->get();
        return view('reservation.our-standard-care',compact('data','cards'));
    }

    public function longTermEnterprise(){
        $data = DB::table('long_term_rental')->where('id',1)->first();
        return view('reservation.long-term-car-rental',compact('data'));
    }

    public function getIp(){
        $ip_address = '';
        if(isset($_SERVER['HTTP_CLIENT_IP'])){
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else if(isset($_SERVER['HTTP_X_FORWARDED'])){
            $ip_address = $_SERVER['HTTP_X_FORWARDED'];
        }else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
            $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
        }else if(isset($_SERVER['HTTP_FORWARDED'])){
            $ip_address = $_SERVER['HTTP_FORWARDED'];
        }else if(isset($_SERVER['REMOTE_ADDR'])){
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }else{
            $ip_address = 'UNKNOWN';
        }
     

        $url = "https://ipwho.is/$ip_address";
       return $locationData = Http::get($url)->json();

        return [
            'country' => $locationData['country'],
            'city' => $locationData['city']
        ];
    }

    public function carSelect($days=1){
       $vehicles = DB::connection('mysql_second')->table('vehicles')->paginate(7);
       $count = DB::connection('mysql_second')->table('vehicles')->count();
       $types =    DB::connection('mysql_second')->table('vehicles')
        ->select('type', DB::raw('count(*) as total'))
        ->groupBy('type')
        ->get();

       $fuels = DB::connection('mysql_second')->table('vehicles')
        ->select('fuel_type', DB::raw('count(*) as total'))
        ->groupBy('fuel_type')
        ->get();

       return view('reservation.car-select',compact('vehicles','types','fuels','count','days'));
    }

    public function filter(Request $request){
        if(Auth::check()){
            $points = Auth::user()->points;
       }else{
            $points = 0;
       }
       $query = DB::connection('mysql_second')->table('vehicles');
       if($request->type) {
           $query->whereIn('type', $request->type);
       }
       if($request->fuel) {
           $query->whereIn('fuel_type', $request->fuel);
       }
       if($request->passenger) {
           $query->where('passengers','>=',max($request->passenger));
       }
       if($request->sort){
           if($request->sort == 'high-to-low'){
               $query->orderBy('price', 'DESC');
           }else{
               $query->orderBy('price', 'ASC');
           }
       }
       $data = $query->get();
     return response()->json(['status' => 'success','data' => $data,'point' => $points]);

    }

    public function addVehicle(Request $request){
    
      $vehicle_data = DB::connection('mysql_second')->table('vehicles')->select('id','vehicle','price','tax','points')->where('id',$request->id)->first();
      return response()->json(['status' => 'success','data' => $vehicle_data]);
    } 

    public function addExtras($id = null){
        $datas = DB::connection('mysql_second')->table('equipments')->where('vehicle_id',$id)->get();
        $equipment =  Session::get('equipment');
        
        return view('reservation.extras',compact('datas','equipment'));
    }

    public function addEquipment(Request $request){
      Session::put('equipment', $request->equ);
      $data = DB::connection('mysql_second')->table('equipments')->where('id',$request->id)->first();
      return response()->json(['status' => 'success','data' => $data]);
    } 

    public function reviewReserve(){
        return view('reservation.review-reserve');
    }
  
    public function getLocAddress(Request $request){
       $data = DB::connection('mysql_second')->table('location_details')->where('location_name',$request->location)->first();
       return response()->json(['status' => 'success','data' => $data]);
    }
 

}
