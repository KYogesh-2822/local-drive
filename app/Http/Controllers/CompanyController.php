<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Mail\applyJob;
use App\Events\CareerNotification;

class CompanyController extends Controller
{
    public function about(){
        $data = DB::table('about_us')->where('id',1)->first();
        $images = DB::table('about_us_images')->orderBy('id', 'DESC')->get();
        $sliders = DB::table('about_us_slider')->get();
        $cards = DB::table('about_us_card')->get();
        return view('company.about',compact('data','images','sliders','cards'));
    }

    public function mobilitySolution(){
        $cards = DB::table('mobility_solution_cards')->get();
        $data = DB::table('mobility_solution')->where('id',1)->first();
        return view('company.mobility-solution',compact('cards','data'));
    }

    public function meetPeople(){
        $data = DB::table('meet_our_people')->where('id',1)->first();
        $slider_cards = DB::table('meet_people_slider')->get();
        $data_review = DB::table('meet_people_review')->get();
        $data_card = DB::table('meet_people_cards')->get();
        return view('company.meet-our-people',compact('data','slider_cards','data_review','data_card'));
    }

    public function career(){
        $data = DB::table('careers')->where('id',1)->first();
        $cards = DB::table('career_cards')->get();
        $categories = DB::table('job_categories')->get();
        return view('company.career',compact('data','cards','categories'));
    }

    public function community(){
        return view('company.community');
    }

    public function jobAlert(Request $request){
        $insert = DB::table('careers_form')->insert([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,                     
            "email" => $request->email,
            "job_category_id" => $request->category,
            "location" => $request->location
        ]);
        return redirect()->back();
    }

    public function selectJob(Request $request){
        return $request;
    return  $categories = DB::table('job_categories')->whereIn('id',$request->id)->get();
      return response()->json(['status' => 'success' , 'data' =>$categories]);
    }


    public function jobFilter(Request $request){

      $cat_id = DB::table('job_categories')->where('name',$request->search_keyword)->value('id');
      $data = DB::table('job_req')->where('job_id',$cat_id)->get();
      $count = $data->count();
      return response()->json(['status' => 'success' , 'data' => $data , 'count' => $count]);
    }

    public function jobdis($id){
         $data = DB::table('job_req')->where('id',$id)->first();
        return view('company.job-discription',compact('data'));
    }

    public function applyJob(Request $request){
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.'
        ];
        Mail::to('reetu.dalia@imarkinfotech.com')->send(new applyJob($mailData));  
        dd("Email is sent successfully.");
    }

    public function careerForm(){
        return view('company.career-form');
    }

    public function careerFormSave(Request $request){
   
        $request->validate([
            'email' => 'required|unique:careers_form|email',
            // 'phone' => 'required|regex:/(7|8|9)\d{9}/',
            // 'photo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'resume' => 'required|max:2000|mimes:doc,docx,pdf',
             'cover_letter' => 'nullable|string|max:2000',
        ]);
        if($request->hasfile('photo'))
        {
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('photo'), $imageName);
        }else{
            $imageName ='';
        }

        if($request->hasfile('resume'))
        {
            $resumeName = time().'.'.$request->resume->extension();
            $request->resume->move(public_path('resume'), $resumeName);
        }else{
            $resumeName ='';
        }
        
        DB::table('careers_form')->insert([
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'headline' => $request->headline,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $imageName,
            'education' => implode(',', $request->education),
            'experience' => implode(',', $request->exp),
            'summary' => $request->summary,
            'resume' => $resumeName,
            'cover_letter' => $request->cover_letter
        ]);

    
        $notifi = [
            'userEmail' => $request->email,
            'adminEmail' => 'reetu.dalia@imarkinfotech.in'
        ];
      
        event(new CareerNotification($notifi));

        return redirect()->back()->with(['message' => 'Form has been submitted successfuly']);
  
    }


}
