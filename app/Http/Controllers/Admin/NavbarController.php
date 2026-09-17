<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;

class NavbarController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        $main_headings = DB::table('nav_headings')->get();
        $top_nav =  DB::table('nav_top')->get();
        return view('admin.navbar',compact('main_headings','top_nav'));
    }

    public function editNav(Request $request){
        $update = DB::table('nav_headings')->where('id',$request->main_id)->update(['heading' => $request->main_heading]);
        return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function subHeadingView(Request $request){
        $data = DB::table('nav_sub_headings')->where('nav_id',$request->main_id)->get();
        return response()->json(['status' => 'success', 'sub_heading' => $data]);
    }

    public function singleHeadingView(Request $request){
       $data = DB::table('nav_sub_headings')->where('id',$request->id)->first();
       return response()->json(['status' => 'success', 'sub_heading' => $data]);
    }

    public function updateSubHeading(Request $request){
       $data = DB::table('nav_sub_headings')->where('id',$request->sub_heading_id)->update(['sub_heading' => $request->sub_heading ,'link' =>$request->sub_link,'status' => $request->status]);
       return redirect()->back()->with(['message' => 'Update successfully']);
    }

    public function topNav(Request $request){
       $update = DB::table('nav_top')->where('id',$request->top_id)->update([
        'heading' => $request->top_heading,
        'link' => $request->link
       ]);
       return redirect()->back()->with(['message' => 'Update successfully']);
    }
}