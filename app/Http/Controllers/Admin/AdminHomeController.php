<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class AdminHomeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dashboard(){
        return view('admin.admin-dashboard');
    }
}
