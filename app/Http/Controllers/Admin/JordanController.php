<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use DB;

class JordanController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
         $products = DB::connection('mysql_second')->table('vehicles')->get();
        return view('admin.jordan-vehicle',compact('products'));
    }

    public function AddJordenVechile(Request $request){
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->image->extension();  
            
            $request->image->move(public_path('vehicles'), $imageName);
        }else{
            $imageName = DB::connection('mysql_second')->table('vehicles')->where('id',$request->prod_id)->value('image');
        }

        $update = DB::connection('mysql_second')->table('vehicles')
        ->updateOrInsert(
            ['id' => $request->prod_id],
            [
                'vehicle' => $request->vehicle, 
                'model' => $request->model, 
                'transmission' => $request->transmission, 
                // 'features' => $request->feature, 
                'passengers' => $request->passengers, 
                'bags' => $request->bags, 
                'type' => $request->type, 
                'fuel_type' => $request->fual_type, 
                'image' => $imageName
            ]
        );
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function deleteJordenVechile(Request $request){
       $products = DB::connection('mysql_second')->table('vehicles')->where('id',$request->id)->delete();
       return 1;
    }
    
}
