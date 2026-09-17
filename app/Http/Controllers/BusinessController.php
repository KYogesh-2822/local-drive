<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Mail\BusinessForm;
use App\Mail\BusinessFormClient;
use Illuminate\Support\Facades\Redirect;

class BusinessController extends Controller
{
    public function carRental(){
        $data = DB::table('business_solution')->where('id',1)->first();
        $business_today = DB::table('business_today')->get();
        $business_benifit = DB::table('business_benifits')->get();
        $business_rentail = DB::table('business_rental_program')->get();
        $business_tool = DB::table('business_tools')->get();
        $vehicles = DB::connection('mysql_second')->table('vehicles')->take(5)->get();
        return view('business.business-car-rental',compact('data','business_today','business_benifit','business_rentail','business_tool','vehicles'));
    }

    public function travelAdmin(){
        $data = DB::table('travel_advisor_admin')->where('id',1)->first();
        return view('business.travel-admin',compact('data'));
    }

    public function advisorLogin(){
        $data = DB::table('travel_advisor_admin')->where('id',1)->first();
        $guides = DB::table('booking_guides')->get();
        return view('business.advisor-login',compact('data','guides'));
    }

    public function rentalDiscount(){
        $data = DB::table('military_rentals')->where('id',1)->first();
        return view('business.rental-discount',compact('data'));
    }

    public function businessForm(){
        $data = DB::table('business_solution')->where('id',1)->first();
        return view('business.business-rental-form',compact('data'));
    }
    public function businessFormSubmit(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'type' => 'required|string',
            'date' => 'required',
        ]);
            //save data
            DB::table('business_rental_form')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => $request->type,
                'date' => $request->date,
            ]);

            //mail
            $mailData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => $request->type,
                'date' => $request->date,
            ];
            $message = [
                'name' => $request->name,
                'message' => 'Thank you for the send the enquire form, your request has been submited',
            ];

        try {

            Mail::to('reetu.dalia@imarkinfotech.com')->send(new BusinessForm($mailData));
            // Mail::to($request->email)->send(new BusinessFormClient($message));
            return Redirect::back()->with(['success' => 'Your enquiry has been successfully submitted. We appreciate your interest and will get back to you as soon as possible.']);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Failed to send emails', 'details' => $e->getMessage()], 500);
        }

    }

    /**
     * Handle AJAX form submission
     */
    public function businessFormAjax(Request $request){
        // Validate
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'type' => 'required|string',
            'date' => 'required',
        ], [
            'name.required' => 'Primary Contact Name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Phone number is required.',
            'type.required' => 'Type of vehicle is required.',
            'date.required' => 'Dates field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Save data
            DB::table('business_rental_form')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => $request->type,
                'date' => $request->date,
            ]);

            // Mail
            $mailData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => $request->type,
                'date' => $request->date,
            ];

            Mail::to('reetu.dalia@imarkinfotech.com')->send(new BusinessForm($mailData));

            return response()->json([
                'success' => true,
                'message' => 'Your enquiry has been successfully submitted. We appreciate your interest and will get back to you as soon as possible.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

}
