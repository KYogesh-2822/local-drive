<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;

class EnterpriseController extends Controller
{
    public function index(){
        $data = DB::table('learn_enterprise')->where('id',1)->first();
        $rewards = DB::table('enterprise_rewards')->get();
        return view('enterprise.enterprise-plus',compact('data','rewards'));
    }


    public function enterpriseJoin(){
        $states = DB::table('states')->select('id','name')->where('country_id',111)->get();
        $countries = DB::table('countries')->select('id','name')->get();
        return view('enterprise.join-enterprise-plus',compact('states','countries'));
    }


    public function create(Request $request){
        $validated = $request->validate([
           'email' => 'required|unique:users,email',
        ]);


        if($request->birthMonth != '' && $request->birthDate != '' && $request->birthYear != ''){
            $birth = $request->birthMonth.'-'.$request->birthDate.'-'.$request->birthYear;
        }else{
            $birth='';
        }

        if($request->expMonth != '' && $request->expDate != '' && $request->expYear != ''){
            $expiry = $request->expMonth.'-'.$request->expDate.'-'.$request->expYear;
        }else{
            $expiry = '';
        }
       $create = DB::table('users')->insert([
        'name' => $request->name,
        'last_name' => $request->lastName,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'country_of_residence' => $request->residence,
        'address1' => $request->address1,
        'address2' => $request->address2,
        'city' => $request->city,
        'state' => $request->state,
        'zip_code' => $request->zipCode,
        'phone_num' => $request->phone,
        'alter_phone_num' => $request->alterPhone,
        'issuing_country' => $request->issuingCountry,
        'issuing_authority' => $request->issuingAuthority,
        'birth_date' => $birth,
        'license_number' => $request->name,
        'expiration_date' => $expiry,
        'email_special' => $request->emailSpecial
       ]);

       return redirect()->back()->with(['message' => 'Account created']);
    }

    public function getState(Request $request){
        $states = DB::table('states')->where('country_id',$request->country)->get();
        return response()->json(['status' => 'success' , 'states' => $states]);
    }



}

