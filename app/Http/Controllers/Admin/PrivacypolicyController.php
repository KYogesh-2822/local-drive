<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PrivacypolicyController extends Controller
{
    public function index(){
        $policy = DB::table('privacy_policy')->first();
        return view('admin.privacy_policy', compact('policy'));
    }

    public function addpolicies(Request $request)
    {
        return $request;
        $request->validate([
            'policy_heading' => 'required',
            'policy_paragraph' => 'required'
        ]);

        $add_terms = DB::table('privacy_policy')->insert([
            'policy_heading' => $request->policy_heading,
            'policy_paragraph' => $request->policy_paragraph
        ]);

        return redirect()->back()->with(['message' => 'Contents had been added successfully']);
    }

    public function updatepolicies(Request $request)
    {
        $request->validate([
            'policy_heading' => 'required',
            'policy_paragraph' => 'required'
        ]);

        $update_terms = DB::table('privacy_policy')->where('id',$request->policy_id)->update([
            'policy_heading' => $request->policy_heading,
            'policy_paragraph' => $request->policy_paragraph
        ]);

        return redirect()->back()->with(['message' => 'Content had been updated successfully']);
    }
}
