<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use App\Models\WebsiteByCountry;

class CountryWebsiteController extends Controller
{

    public function index(){
        $countries = DB::table('countries')->select('id','name')->get();
        $country_links = DB::table('countries')->select('id','name','link')->where('link','!=','')->get();
        return view('admin.country-website',compact('countries','country_links'));
    }

    public function viewCountry(Request $request){
       $data = DB::table('countries')->where('id',$request->id)->first();
       return response()->json(['status' => 'success', 'data' => $data]);
    }

    public function updateCountryLink(Request $request){
       $update = DB::table('countries')->where('id',$request->country_id)->update(['link' => $request->website_link]);
       return redirect()->back()->with('success', 'Link has been added successfully');   
    }

    public function deleteCountryLink(Request $request){
      $update = DB::table('countries')->where('id',$request->id)->update(['link' => '']);
      return response()->json(['status' => 'success', 'message' => 'Link has been deleted successfully']);
    }

}