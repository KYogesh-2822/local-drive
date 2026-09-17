<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FooterdataController extends Controller
{
    public function termsofuse(){
        $term = DB::table('terms_of_use')->first();
        return view('footer.terms_of_use', compact('term'));
    }

    public function privacypolicy(){
        $policy = DB::table('privacy_policy')->first();
        return view('footer.privacy_policy', compact('policy'));
    }

    public function cookiepolicy(){
        $policy = DB::table('cookies_policy')->first();
        return view('footer.cookie_policy', compact('policy'));
    }

    public function termsconditions(){
        $condition = DB::table('terms_conditions')->first();
        return view('footer.terms_and_conditions', compact('condition'));
    }
}
