<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class FooterController extends Controller
{
    public function index(){
        $term = DB::table('terms_of_use')->first();
        return view('admin.terms_of_use', compact('term'));
    }

    public function addterms(Request $request)
    {
        $request->validate([
            'term_heading' => 'required',
            'paragraph' => 'required'
        ]);

        $add_terms = DB::table('terms_of_use')->insert([
            'term_heading' => $request->term_heading,
            'paragraph' => $request->paragraph
        ]);

        return redirect()->back()->with(['message' => 'Contents had been added successfully']);
    }

    public function updateterms(Request $request)
    {
        $request->validate([
            'term_heading' => 'required',
            'paragraph' => 'required'
        ]);

        $update_terms = DB::table('terms_of_use')->where('id',$request->term_id)->update([
            'term_heading' => $request->term_heading,
            'paragraph' => $request->paragraph
        ]);

        return redirect()->back()->with(['message' => 'Content had been updated successfully']);
    }
}
