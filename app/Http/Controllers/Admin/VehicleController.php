<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class VehicleController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        $car = DB::table('vehicle_cars')->where('id',1)->first();
        $suv = DB::table('vehicle_suvs')->where('id',1)->first();
        $truck = DB::table('vehicle_trucks')->where('id',1)->first();
        $van = DB::table('vehicle_vans')->where('id',1)->first();
       return view('admin.vehicle',compact('car','suv','truck','van'));
    }
 
     public function carBaneer(Request $request){
         if($request->hasFile('car_banner_image')){
            $request->validate([
                'car_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $imageName = time().'.'.$request->car_banner_image->extension();  
             
            $request->car_banner_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('vehicle_cars')->where('id',1)->value('banner_image');
        }

        $update = DB::table('vehicle_cars')->where('id',1)->update([
            'banner_content' => $request->car_banner_content,
            'banner_button' => $request->car_banner_button,
            'banner_image' => $imageName
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
     }

     public function carContent(Request $request){
       $update = DB::table('vehicle_cars')->where('id',1)->update([
        'content' => $request->car_content,
        'button' => $request->car_button
       ]);

       return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function suvBaneer(Request $request){
      if($request->hasFile('suv_banner_image')){
        $request->validate([
            'suv_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

            $imageName = time().'.'.$request->suv_banner_image->extension();  
            
            $request->suv_banner_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('vehicle_suvs')->where('id',1)->value('banner_image');
        }

        $update = DB::table('vehicle_suvs')->where('id',1)->update([
            'banner_content' => $request->suv_banner_content,
            'banner_button' => $request->suv_banner_button,
            'banner_image' => $imageName
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function suvContent(Request $request){
      $update = DB::table('vehicle_suvs')->where('id',1)->update([
        'content' => $request->suv_content,
        'button' => $request->suv_button
       ]);

       return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function truckBaneer(Request $request){
       if($request->hasFile('truck_banner_image')){
        $request->validate([
            'truck_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

            $imageName = time().'.'.$request->truck_banner_image->extension();  
            
            $request->truck_banner_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('vehicle_trucks')->where('id',1)->value('banner_image');
        }

        $update = DB::table('vehicle_trucks')->where('id',1)->update([
            'banner_content' => $request->truck_banner_content,
            'banner_button' => $request->truck_banner_button,
            'banner_image' => $imageName
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function truckContent(Request $request){

        $update = DB::table('vehicle_trucks')->where('id',1)->update([
            'content' => $request->truck_content,
            'button' => $request->truck_button
           ]);
    
        return redirect()->back()->with(['message' => 'Update successfully']);

    }

    public function vanBaneer(Request $request){

       if($request->hasFile('van_banner_image')){
        $request->validate([
            'van_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

            $imageName = time().'.'.$request->van_banner_image->extension();  
            
            $request->van_banner_image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('vehicle_vans')->where('id',1)->value('banner_image');
        }

        $update = DB::table('vehicle_vans')->where('id',1)->update([
            'banner_content' => $request->van_banner_content,
            'banner_button' => $request->van_banner_button,
            'banner_image' => $imageName
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function vanContent(Request $request){

        $update = DB::table('vehicle_vans')->where('id',1)->update([
            'content' => $request->van_content,
            'button' => $request->van_button
           ]);
    
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

}
