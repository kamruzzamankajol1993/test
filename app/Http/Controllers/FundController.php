<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Fund;
use Session;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use PDF;

class FundController extends Controller
{
    
    public function findProductName(Request $request){

        $data=Branch::select('branch_id')->where('id',$request->id)->get();
        return response()->json($data);
    }
    public function index(){
        
        $userNames = Branch::where('mstatus',1)->where('fund_status',2)->get();
        return view('fund.assaign',['userNames'=>$userNames]);

        
    }
    
    
     public function store(Request $request){

       

    
        date_default_timezone_set('Asia/Dhaka');
        $currentDate = date("h:i:s",time());
        $newDate =date('Y-m-d');
        $reg = new Fund();
        $reg->user_id = $request->user_id;
        $reg->pin = 'ATC-'.rand('10000000','99999999');
        $reg->Branch_name = $request->Branch_name;
         $reg->Branch_number = $request->Branch_number;
        $reg->send_amount = $request->send_amount;
        $reg->date=$newDate;
        $reg->time= $currentDate;
        
        $reg->save();
        $regId=$reg->Branch_name;
        $amount=$reg->send_amount;

        
     
        $totalView=DB::table('branches')->where('id',$regId)->value('amout');
        $update=$totalView+$amount;
         $prov=DB::table('branches')->where('id',$regId)->update(['amout'=>$update]);
         
            Toastr::success('Money Successfully Added To Branch:)' ,'success');
        return redirect()->route('fund.history');

  } 
  
  
  public function history(){
      
      $details =Fund::orderBy('id','desc')->get();
        $userNames = Branch::where('mstatus',1)->get();
        return view('fund.history',['details'=>$details,'userNames'=>$userNames]);
  }
  
  
  public function return(){
      
      $details =Branch::where('mstatus',1)->get();
        //$userNames = Branch::where('mstatus',1)->get();
        return view('fund.return',['details'=>$details]);
  }
  
  
  public function rstore(Request $request){
      
      $userId = $request->input('id');
     $customer = Branch::find($userId );
     $customer->amout = $request->amout;
     $customer->save();
     return redirect()->route('fund.return');
      
  }
  
  
}
