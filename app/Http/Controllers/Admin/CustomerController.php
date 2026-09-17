<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{
    public function index(){
        $topics = DB::table('faq_topics')->get(); 
        return view('admin.faq',compact('topics'));
    }

    public function editFaq(Request $request){
      $update = DB::table('faq_topics')->where('id',$request->topic_id)->update(['topic' => $request->topic]);
      return redirect()->back()->with(['message' => 'Update Successfully']);
    }

    public function viewFaq(Request $request){
      $data = DB::table('faq_questions')->where('topic_id',$request->topic)->get();
      return response()->json(['status' => 'success','data' => $data]);
    }

    public function viewQuestion(Request $request){
        $data = DB::table('faq_questions')->where('id',$request->id)->first();
        return response()->json(['status' => 'success','data' => $data]);
    }

    public function editQuestion(Request $request){
        $data = DB::table('faq_questions')->where('id',$request->question_id)->update([
            'question' => $request->question,
            'answer' => $request->answer
        ]);
        return redirect()->back()->with(['message' => 'Update Successfully']);
    }
    
    public function serviceFaq(){
        $faq =  DB::table('help&faqs')->where('id',1)->first();
        $site_map =  DB::table('site_map')->where('id',1)->first();
        $site_heading =  DB::table('site_map_heading')->get();
        return view('admin.customer-service',compact('faq','site_map','site_heading'));
    }

    public function serviceHeadFaq(Request $request){
        $update = DB::table('help&faqs')->where('id',1)->update([
          'heading' => $request->faq_heading,
          'sub_heading' => $request->faq_sub_footer
        ]);
        return redirect()->back()->with(['message' => 'Update Successfully']);
    }

    public function serviceSideHeading(Request $request){
       $update = DB::table('site_map_heading')->where('id',$request->site_id)->update([
        'heading' => $request->heading
      ]);
      return redirect()->back()->with(['message' => 'Update Successfully']);
    }

    public function serviceSideHeadingView(Request $request){
       $data = DB::table('site_map')->where('site_id',$request->heading)->get();
       return response()->json(['status' => 'success','data' => $data]);
    }

    public function singleHeadingDetail(Request $request){
       $data = DB::table('site_map')->where('id',$request->id)->first();
       return response()->json(['status' => 'success','data' => $data]);
    }

    public function singleHeadingedit(Request $request){
        $update = DB::table('site_map')->where('id',$request->site_id)->where('site_id',$request->site_subheading_id)->update(['heading' => $request->site_subheading]);
        return redirect()->back()->with(['message' => 'Update Successfully']);
    }

    public function singleDetailView(Request $request){
       $data = DB::table('site_map_link')->where('subheading_id',$request->sub_id)->get();
       return response()->json(['status' => 'success','data' => $data]);
    }

    public function detailView(Request $request){
       $data = DB::table('site_map_link')->where('id',$request->id)->first();
       return response()->json(['status' => 'success','data' => $data]);
    }

    public function detailUpdate(Request $request){
       $data = DB::table('site_map_link')->where('id',$request->detail_id)->where('subheading_id',$request->site_detail_id)->update(['detail' => $request->site_detail]);
       return redirect()->back()->with(['message' => 'Update Successfully']);
    }

}