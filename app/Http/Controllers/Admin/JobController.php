<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

class JobController extends Controller
{  

    public function index(){
        $categories = DB::table('job_categories')->get();
        return view('admin.job',compact('categories'));
    }

    public function jobEdit(Request $request){
         $update = DB::table('job_categories')->where('id',$request->cat_id)->update(['name' => $request->name]);
         return redirect()->back()->with(['message' => 'Job category edit successfully done']);
    }

    public function addReq(Request $request){
        DB::table('job_req')->insert([
           'job_id' => $request->category,
           'profile' => $request->profile,
           'location' => $request->location,
           'discription' => $request->discription,
           'type' => $request->type
        ]);
        return redirect()->back()->with(['message' => 'Job requirement added successfully done']);
    }

    public function viewJob(Request $request){
        $data = DB::table('job_req')->where('job_id',$request->job_cate)->get();
        return response()->json(['status' => 'success' , 'data' =>$data]);
    }

    public function addProfile(Request $request){
        $categories = DB::table('job_categories')->insert(['name' => $request->category]);
        return redirect()->back()->with(['message' => 'Job category added successfully done']);
    }

    public function deleteProfile(Request $request){
        $delete = DB::table('job_categories')->where('id',$request->id)->delete();
        return 1;
    }

    public function viewReq(Request $request){
       
       $data = DB::table('job_req')
        ->select('job_req.*', 'job_categories.name')
        ->where('job_req.id', $request->id)
        ->leftJoin('job_categories', 'job_req.job_id', '=', 'job_categories.id')
        ->first();
        return response()->json(['status' => 'success' , 'data' =>$data]);
    }

    public function editReq(Request $request){
        $update = DB::table('job_req')->where('id',$request->cat_id)->update([
            'profile' => $request->profile,
            'location' => $request->location,
            'discription' => $request->discription,
            'type' => $request->type
        ]);
        return redirect()->back()->with(['message' => 'Job requirement added successfully done']);
    }

    public function deleteReq(Request $request){
        $delete = DB::table('job_req')->where('id',$request->id)->delete();
        return 1;
    }

}