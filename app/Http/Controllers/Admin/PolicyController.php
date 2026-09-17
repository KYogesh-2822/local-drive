<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use App\Models\HoursServices;

use Illuminate\Http\Request;


class PolicyController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        $policies = DB::table('rental_policies')->get();
        return view('admin.rental-policy',compact('policies'));
    }
    public function addPolicy(){
        
        return view('admin.add-rental-policy');
    }
    public function policy(Request $request){
        DB::table('rental_policies')->insert([
            'heading' => $request->heading,
            'detail' => $request->detail
        ]);
        return redirect()->back()->with(['message' => 'Policy has been added successfully']);
    }

    public function editPolicy($id){
        $data = DB::table('rental_policies')->where('id',$id)->first();
        return view('admin.edit-rental-policy',compact('data'));
    }

    public function editRentalPolicy(Request $request){
        $data = DB::table('rental_policies')->where('id',$request->id)->update([
            'heading' => $request->heading,
            'detail' => $request->detail
        ]);
        return redirect()->back()->with(['message' => 'Policy has been updated successfully']);
    }

    public function deletePolicy(Request $request){
      $data = DB::table('rental_policies')->where('id',$request->id)->delete();
      return 1;
    }

    public function services(){
        $data = DB::connection('mysql_second')->table('location_details')->get();
        return view('admin.hours-services',compact('data'));
    }

    public function addHours(Request $request){
     
        $data = [
            'sun_day' => $request->input('sun_day'),
            'sun_open' => $request->input('sun_open'),
            'sun_close' => $request->input('sun_close'),
            'sun_open_2' => $request->input('sun_open_2'),
            'sun_close_2' => $request->input('sun_close_2'),
            'sun_24_service' => $request->input('sun_24_service'),
            'mon_day' => $request->input('mon_day'),
            'mon_open' => $request->input('mon_open'),
            'mon_close' => $request->input('mon_close'),
            'mon_open_2' => $request->input('mon_open_2'),
            'mon_close_2' => $request->input('mon_close_2'),
            'mon_24_service' => $request->input('mon_24_service'),
            'tues_day' => $request->input('tues_day'),
            'tues_open' => $request->input('tues_open'),
            'tues_close' => $request->input('tues_close'),
            'tues_open_2' => $request->input('tues_open_2'),
            'tues_close_2' => $request->input('tues_close_2'),
            'tues_24_service' => $request->input('tues_24_service'),
            'wed_day' => $request->input('wed_day'),
            'wed_open' => $request->input('wed_open'),
            'wed_close' => $request->input('wed_close'),
            'wed_open_2' => $request->input('wed_open_2'),
            'wed_close_2' => $request->input('wed_close_2'),
            'wed_24_service' => $request->input('wed_24_service'),
            'thur_day' => $request->input('thur_day'),
            'thur_open' => $request->input('thur_open'),
            'thur_close' => $request->input('thur_close'),
            'thur_open_2' => $request->input('thur_open_2'),
            'thur_close_2' => $request->input('thur_close_2'),
            'thur_24_service' => $request->input('thur_24_service'),
            'fri_day' => $request->input('fri_day'),
            'fri_open' => $request->input('fri_open'),
            'fri_close' => $request->input('fri_close'),
            'fri_open_2' => $request->input('fri_open_2'),
            'fri_close_2' => $request->input('fri_close_2'),
            'fri_24_service' => $request->input('fri_24_service'),
            'sat_day' => $request->input('sat_day'),
            'sat_open' => $request->input('sat_open'),
            'sat_close' => $request->input('sat_close'),
            'sat_open_2' => $request->input('sat_open_2'),
            'sat_close_2' => $request->input('sat_close_2'),
            'sat_24_service' => $request->input('sat_24_service'),
        ];

        HoursServices::updateOrCreate(
            ['location_id' => $request->location],
            [
            'location_id' => $request->location, 
            'hours' => json_encode($data)
            ]
        );
        return redirect()->back()->with(['message' => 'Policy has been updated successfully']);
     
    }

    public function showHours(Request $request){
       
      $data = HoursServices::where('location_id',$request->loc_id)->first();
      return response()->json(['status' => 'success' , 'data' => $data]);
    }
}
