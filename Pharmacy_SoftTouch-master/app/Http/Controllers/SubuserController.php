<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use PDF;
use App\Branch;
use App\Receivemoney;
use App\Sendmoney;
use App\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
class SubuserController extends Controller
{
     public function store(Request $request){
        $customer = new Branch();
        $customer->user_id = $request->user_id;
        $customer->sub_branch_id = $request->sub_branch_id;
        $customer->detail = $request->detail;
        $customer->branch_id = str_slug($request->detail);
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->add= Session::get('customerAddress');;
        $customer->add_by = 1;
        //$customer->mstatus = $request->mstatus;
        $customer->password = Hash::make($request->password);
        $customer->mpass =$request->password;
        $customer->save();

        //$customerId = $customer->id;
        //Session::put('customerId',$customerId);
        //Session::put('customerName',$customer->branch_id);
        //Session::put('customerAddress',$customer->add);
   //Session::put('customerStatus',$customer->add_by);
       return redirect('/sub_user');
    }

    public function index(){

    	$details= Branch::latest()->get();
        
    	return view('subuser.manage',['details'=>$details]);
    }


    public function create(){

    	return view('subuser.create');
    }

     public function destroy($id)
    {
         Branch::find($id)->delete();
         Toastr::warning('Successfully Deleted :)','Success');
         return redirect()->back();
    }


    public function edit($id)
    {
        $detail = Branch::find($id);
        return view('subuser.edit',['detail'=>$detail]);
    }


   public function update(Request $request){
    	 $userId = $request->input('id');

    	$customer = Branch::find($userId );
        $customer->user_id = $request->user_id;
        $customer->detail = $request->detail;
        $customer->branch_id = str_slug($request->detail);
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->add = $request->add;
        //$customer->mstatus = $request->mstatus;
        $customer->add_by = $request->add_by;
        $customer->sub_branch_id = $customer->id;
        $customer->password = Hash::make($request->password);
        $customer->password = $request->password;
        $customer->save();
   	     return redirect('/sub_user')->with('message','Updated Successfully');
    }


     public function history($add)
    {
        Session::put('customerBid',$add);
        $details = Sendmoney::whereIn('status', [2,1])->where('get_status',0)->where('branch_id',$add)->orderBy('id','desc')->get();
        $details1 = Receivemoney::where('status',5)->where('branch_id',$add)->orderBy('id','desc')->get();
        $branchName=Branch::where('id',$add)->distinct('branch_id')->value('branch_id');
        return view('subuser.history',['details'=>$details,'details1'=>$details1,'branchName'=>$branchName]);
    }


     public function senderhistory()
    {
        $details = Sendmoney::whereIn('status', [2,1])->where('get_status',0)->orderBy('id','desc')->get();
        
        return view('subuser.Senderhistory',['details'=>$details]);
    }


     public function sendersearch(Request $request)
    {
        
        $from_date = $request->input('from');
        $to_date = $request->input('to');
        $status=$request->input('status');
     
    $details= Sendmoney::whereIn('status', [2,1])->where('get_status',0)->Where('sender_number', 'like', '%'.$status.'%')->whereBetween('date', array($from_date, $to_date))->orwhere('sender_nid', 'like', '%'.$status.'%')->orderBy('id','desc')->get();
 $UserName=Sendmoney::where('sender_number',$status)->orWhere('sender_nid',$status)->distinct('sender_name')->value('sender_name');
 $UserNid=Sendmoney::where('sender_number',$status)->orWhere('sender_nid',$status)->distinct('sender_nid')->value('sender_nid');
 $UserNumber=Sendmoney::where('sender_number',$status)->orWhere('sender_nid',$status)->distinct('sender_number')->value('sender_number');

    return view('subuser.search')->with([
       
     'details'=>$details,
     'UserName'=>$UserName,
     'UserNid'=>$UserNid,
     'UserNumber'=>$UserNumber,
    
    ]);  
        
}

public function new1history(Request $request)
    {
        
        $from_date = $request->input('from');
        $to_date = $request->input('to');
        $status=$request->input('status');
        if($status == "receive" ){
          $details=Receivemoney::where('status',5)->whereBetween('date', array($from_date, $to_date))->orderBy('id','desc')->get(); 
           return view('subuser.newhis')->with([
       
     'details'=>$details,
     'status'=>$status,
    
    ]); 
        }else{
         $details= Sendmoney::whereIn('status', [2,1])->where('get_status',0)->whereBetween('date', array($from_date, $to_date))->orderBy('id','desc')->get(); 
          return view('subuser.newhis1')->with([
       
     'details'=>$details,
     'status'=>$status,
    ]);  
        }
       


   
    }

    public function new2history(Request $request)
    {
        
        $from_date = $request->input('from');
        $to_date = $request->input('to');
        $status=$request->input('status');
        if($status == "receive" ){
          $details=Receivemoney::where('status',5)->whereBetween('date', array($from_date, $to_date))->orderBy('id','desc')->get(); 
           return view('subuser.newhis2')->with([
       
     'details'=>$details,
     'status'=>$status,
    ]); 
        }else{
         $details= Sendmoney::whereIn('status', [2,1])->where('get_status',0)->whereBetween('date', array($from_date, $to_date))->orderBy('id','desc')->get(); 
          return view('subuser.newhis3')->with([
       
     'details'=>$details,
     'status'=>$status,
    ]);  
        }
       


   
    }

    public function npprint($add){

             $infos=Sendmoney::Where('sender_number',$add)->orderBy('id','desc')->get();
             $pdf=PDF::loadView('subuser.allp',['infos'=>$infos]);

            return $pdf->stream('Money_receipt.pdf');
    }
}
