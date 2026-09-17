<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use App\Models\UsStateCity;
use App\Models\InterRegion;

class LocationController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        $data = DB::table('location_us')->where('id',1)->first();
        $data_inter = DB::table('location_inter')->where('id',1)->first();
        $cards = DB::table('location_inter_card')->get();
        $countries = DB::table('states')->select('id','name')->where('country_id',233)->get();
        $regions = DB::table('regions')->select('id','name')->get();
        $inter_regions = DB::table('inter_regions')->select('inter_regions.*','regions.name')->leftJoin('regions','inter_regions.region_id','=','regions.id')->get();
        $state_cities = DB::table('us_state_cities')->select('us_state_cities.*','states.name')->leftJoin('states','us_state_cities.state_id','=','states.id')->get();
        $popular = DB::table('countries')->select('id','name')->where('region_id',2)->get();
       $popular_ids = DB::table('countries')->select('id','name')->where('popular','yes')->pluck('id')->toArray();
        return view('admin.location',compact('data','data_inter','cards','countries','regions','inter_regions','state_cities','popular','popular_ids'));
    }

    public function editHeading(Request $request){
       $update = DB::table('location_us')->where('id',1)->update([
        'heading' => $request->loc_heading,
        'button' => $request->loc_button
       ]);
       return redirect()->back()->with(['message'=>'update successfully']);
    }

    public function editContent(Request $request){
        $update = DB::table('location_us')->where('id',1)->update([
            'content' => $request->loc_us_content
           ]);
        return redirect()->back()->with(['message'=>'update successfully']);
    }

    public function editInterHeading(Request $request){
        $update = DB::table('location_inter')->where('id',1)->update([
            'heading' => $request->inter_loc_heading,
            'button' => $request->inter_loc_button
        ]);
        return redirect()->back()->with(['message'=>'update successfully']);
    }

    public function editInterContent(Request $request){
  
        $update = DB::table('location_inter')->where('id',1)->update([
            'content' => $request->loc_inter_content
           ]);
        return redirect()->back()->with(['message'=>'update successfully']);
    }

    public function editInterCard(Request $request){
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $imageName = time().'.'.$request->image->extension();  
             
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = DB::table('location_inter_card')->where('id',$request->id)->value('image');
        }

        $update = DB::table('location_inter_card')->where('id',$request->id)->update([
            'image' => $imageName,
            'detail' => $request->detail,
            'button' => $request->button
        ]);

        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function editUsFaq(Request $request){
       $update = DB::table('location_us')->where('id',1)->update([
        'faq_heading' => $request->faq_heading,
        'faq_footer' => $request->faq_footer
       ]);
      return redirect()->back()->with(['message'=>'update successfully']);
    } 

    public function usCities(Request $request){
       $cities = DB::table('cities')->select('id','name')->where('state_id',$request->state_id)->get();
       return response()->json(['status' => 'success', 'cities' => $cities]);
    }

    public function addUsCities(Request $request){
        $cities = json_encode($request->cities);
        $update = UsStateCity::updateOrCreate(
        [
            'state_id' => $request->state
        ], 
        [
            'cities_id' => $cities
        ]);
        return redirect()->back()->with(['message'=>'update successfully']);
    }

    public function showCountries(Request $request){
        $region = DB::table('countries')->select('id','name')->where('region_id',$request->region_id)->get();
        return response()->json(['status' => 'success', 'region' => $region]);
    }

    public function addRegionCountries(Request $request){
        $countries = json_encode($request->country);
        $update = InterRegion::updateOrCreate(
        [
            'region_id' => $request->region
        ], 
        [
            'countries' => $countries
        ]);
        return redirect()->back()->with(['message'=>'update successfully']);
    }

    public function addUsPopular(Request $request){
    //    $popular_ids = DB::table('countries')->where('popular','yes')->pluck('id')->toArray();
    //    $result = array_intersect($popular_ids,$request->pupular_country_id);
       $popular = DB::table('countries')->whereIn('id',$request->pupular_country_id)->update(['popular' => 'yes']);
       return redirect()->back()->with(['message'=>'update successfully']);
    }
}
