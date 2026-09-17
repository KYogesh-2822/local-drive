<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class MilitaryController extends BaseController
{

    public function index(){
        $data = DB::table('military_rentals')->where('id',1)->first();
        return view('admin.military-rental',compact('data'));
    }

    public function addMilitaryBanner(Request $request){
        $update = DB::table('military_rentals')->where('id',1)->update([
            'heading' => $request->heading,
            'banner_line' => $request->banner_line
        ]);
        return redirect()->back()->with(['message' => 'Updated Successfully']);
    }

    public function addMilitaryDiscountContent(Request $request){
        $update = DB::table('military_rentals')->where('id',1)->update([
            'discount_content' => $request->discount_content
        ]);
        return redirect()->back()->with(['message' => 'Updated Successfully']);
    }

    public function addMilitaryServeContent(Request $request){
       $update = DB::table('military_rentals')->where('id',1)->update([
        'serve_content' => $request->serve_content,
        'video_link' => $request->video_link
    ]);
    return redirect()->back()->with(['message' => 'Updated Successfully']);
    }

    
}