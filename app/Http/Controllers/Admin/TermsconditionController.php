<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class TermsconditionController extends Controller
{
    public function index(){
        $condition = DB::table('terms_conditions')->first();
        return view('admin.terms_and_conditions', compact('condition'));
    }

    public function addconditions(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'paragraph' => 'required'
        ]);

        $add_terms = DB::table('terms_conditions')->where('id', $request->term_id)->update([
            'heading' => $request->heading,
            'paragraph' => $request->paragraph
        ]);

        return redirect()->back()->with(['message' => 'Contents had been added successfully']);
    }

}
