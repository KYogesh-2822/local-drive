<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CookiespolicyController extends Controller
{
    public function index(){
        $policy = DB::table('cookies_policy')->first();
        return view('admin.cookie_policy', compact('policy'));
    }

    public function addpolicy(Request $request){
        $request->validate([
            'heading' => 'required',
            'contents' => 'required'
        ]);

        $add_terms = DB::table('cookies_policy')->where('id',$request->policy_id)->update([
            'heading' => $request->heading,
            'contents' => $request->contents
        ]);

        return redirect()->back()->with(['message' => 'Contents had been added successfully']);
    }
}
