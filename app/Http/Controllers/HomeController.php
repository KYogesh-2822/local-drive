<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (config('content.managed_pages_live')) {
            return app(\App\Http\Controllers\Content\PageController::class)->home();
        }

        $offers = DB::table('home_offers')->get();
        $carsOffres = DB::table('home_carRentals_offer')->get();
        $cards = DB::table('home_carRentals')->get();
        $carHead = DB::table('home_carRentals_heading')->first();
        $blogs = DB::table('home_blogs')->get();
        $banner = DB::table('banner_image')->first();
        $vehicles = DB::connection('mysql_second')->table('vehicles')->take(8)->get();
        return view('index',compact('offers','carHead','carsOffres','cards','blogs','banner','vehicles'));
    }

          public function new_index()
    {
        $offers = DB::table('home_offers')->get();
        $carsOffres = DB::table('home_carRentals_offer')->get();
        $cards = DB::table('home_carRentals')->get();
        $carHead = DB::table('home_carRentals_heading')->first();
        $blogs = DB::table('home_blogs')->get();
        $banner = DB::table('banner_image')->first();
        $vehicles = DB::connection('mysql_second')->table('vehicles')->take(8)->get();
        return view('new_index',compact('offers','carHead','carsOffres','cards','blogs','banner','vehicles'));
    }
    

    public function language(){
        $session = session()->all();
        $offers = DB::table('home_offers')->get();
        $carsOffres = DB::table('home_carRentals_offer')->get();
        $cards = DB::table('home_carRentals')->get();
        $carHead = DB::table('home_carRentals_heading')->first();
        $blogs = DB::table('home_blogs')->get();
        $banner = DB::table('banner_image')->first();
        if(isset($session['lang'])){
        if($session['lang']=="en"){
         Session::forget('lang'); 
         return view('index',compact('offers','carHead','carsOffres','cards','blogs','banner'));
        }
        else{
         Session::put('lang','en');
        }
       }
       else{
       Session::put('lang','en');
       return view('index',compact('offers','carHead','carsOffres','cards','blogs','banner'));
       } 
       }


    
}
