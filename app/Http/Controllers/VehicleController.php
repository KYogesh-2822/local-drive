<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class VehicleController extends Controller
{
    public function car(){
      $car = DB::table('vehicle_cars')->where('id',1)->first();
      $vehicles = DB::connection('mysql_second')->table('vehicles')->where('type','car')->get();
      $others = DB::connection('mysql_second')->table('vehicles')->select('type', DB::raw('count(*) as total'))->where('type','!=','car')->groupBy('type')->get();
      $suv = DB::connection('mysql_second')->table('vehicles')->where('type','suv')->value('image');
      $van = DB::connection('mysql_second')->table('vehicles')->where('type','vans')->value('image');
      $truck = DB::connection('mysql_second')->table('vehicles')->where('type','pickup')->value('image');
      return view('vehicle.car',compact('car','vehicles','others','suv','van','truck'));
    }

    public function suvs(){
      $suv = DB::table('vehicle_suvs')->where('id',1)->first();
      $vehicles = DB::connection('mysql_second')->table('vehicles')->where('type','suv')->get();
      $others = DB::connection('mysql_second')->table('vehicles')->select('type', DB::raw('count(*) as total'))->where('type','!=','suv')->groupBy('type')->get();
      $car = DB::connection('mysql_second')->table('vehicles')->where('type','car')->value('image');
      $van = DB::connection('mysql_second')->table('vehicles')->where('type','vans')->value('image');
      $truck = DB::connection('mysql_second')->table('vehicles')->where('type','pickup')->value('image');
      return view('vehicle.suv',compact('suv','vehicles','others','car','van','truck'));
    }

    public function trucks(){
      $truck = DB::table('vehicle_trucks')->where('id',1)->first();
      $vehicles = DB::connection('mysql_second')->table('vehicles')->where('type','pickup')->get();
      $others = DB::connection('mysql_second')->table('vehicles')->select('type', DB::raw('count(*) as total'))->where('type','!=','pickup')->groupBy('type')->get();
      $car = DB::connection('mysql_second')->table('vehicles')->where('type','car')->value('image');
      $van = DB::connection('mysql_second')->table('vehicles')->where('type','vans')->value('image');
      $suv = DB::connection('mysql_second')->table('vehicles')->where('type','suv')->value('image');
      return view('vehicle.truck',compact('truck','vehicles','others','car','van','suv'));
    }

    public function vans(){
      $van = DB::table('vehicle_vans')->where('id',1)->first();
      $vehicles = DB::connection('mysql_second')->table('vehicles')->where('type','vans')->get();
      $others = DB::connection('mysql_second')->table('vehicles')->select('type', DB::raw('count(*) as total'))->where('type','!=','vans')->groupBy('type')->get();
      $car = DB::connection('mysql_second')->table('vehicles')->where('type','car')->value('image');
      $truck = DB::connection('mysql_second')->table('vehicles')->where('type','pickup')->value('image');
      $suv = DB::connection('mysql_second')->table('vehicles')->where('type','suv')->value('image');
      return view('vehicle.van',compact('van','vehicles','others','car','truck','suv'));
    }

    public function detail($id){
      $data = DB::connection('mysql_second')->table('vehicles')->where('id',$id)->first();
      $others = DB::connection('mysql_second')->table('vehicles')->where('id','!=',$data->id)->where('type',$data->type)->take(3)->get();
      return view('vehicle.vehicle-detail',compact('data','others'));
    }

    public function exotic(){
      return view('vehicle.exotic-cars');
    }

    public function vechicle(){
      $groupedData = DB::connection('mysql_second')
        ->table('vehicles')
        ->select('type', DB::raw('count(*) as total'), DB::raw('MIN(id) as min_id'))
        ->groupBy('type');

      $data = DB::connection('mysql_second')
        ->table('vehicles')
        ->joinSub($groupedData, 'grouped_vehicles', function ($join) {
            $join->on('vehicles.id', '=', 'grouped_vehicles.min_id');
        })
        ->select('vehicles.*', 'grouped_vehicles.total')
        ->get();


      return view('vehicle.all-vehicle',compact('data'));
    }
}
