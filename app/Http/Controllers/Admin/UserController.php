<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;

class UserController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        // $users = DB::table('users')->where('role',1)->get();
        $users = DB::table('business_rental_form')->get();
        return view('admin.user-list',compact('users'));
    }
}
