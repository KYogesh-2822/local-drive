<?php
     
namespace App\Http\Controllers;
     
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use DB;
class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

       
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
   
        $data = DB::connection('mysql_second')->table('location_details')
                    ->where('location_name', 'LIKE', '%'. $request->text. '%')
                    ->orWhere('address', 'LIKE', '%'. $request->text. '%')
                    ->get();
         
        return response()->json(['data' => $data]);
    }   

    public function search(){
        return view('reservation.search');
    }

    public function selectLocation(Request $request){
      $name = DB::connection('mysql_second')->table('location_details')->where('id',$request->loc_id)->value('location_name');
      return response()->json(['name' => $name]);
    }


}