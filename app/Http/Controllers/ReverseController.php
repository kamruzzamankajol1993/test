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
class ReverseController extends Controller
{
    public function new1history($add){

    	$prov=Receivemoney::where('pin',$add)->first();
       $branchNames=DB::table('branches')->distinct('add')->get(['add']);
    	
    	return view('branch.reverse.part1',['prov'=>$prov,'branchNames'=>$branchNames]);
    }


     public function new2history3(Request $request){
         
         //$userId = $request->input('id');

      if ($request->file('file')) {

     date_default_timezone_set('Asia/Dhaka');
        $currentDate = date("h:i:s",time());
        $newDate =date('Y-m-d');
        $userId = $request->input('id');
        $rec = Receivemoney::find($userId);
        $rec->pin = $request->pin;
        $rec->sender_name = $request->sender_name;
        $rec->sender_number = $request->sender_number;
        $rec->sender_location = $request->sender_location;
        $rec->branch_id = Session::get('customerId');
        $rec->user_id = Session::get('customerAddress');
        $rec->amount = $request->amount;
        $rec->status =1;
        $rec->receiver_number = $request->receiver_number;
        $rec->receiver_location = $request->receiver_location;
        $rec->receiver_name = $request->receiver_name;
        $rec->receiver_nid = $request->receiver_nid;
        $rec->date=$newDate;
        $rec->time= $currentDate;
        
            $photoName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path().'/upload', $photoName);
            $rec->nidcopy = $photoName;
        

        $rec->save();
        $pinNum=$rec->pin;
        $upAd=$rec->receiver_location;
    $sendMoney = DB::table('sendmoneys')->where('pin',$pinNum)->update(['status'=>1,'receiver_location'=>$upAd,'user_id'=>Session::get('customerAddress')]);

             $info=Receivemoney::Where('pin',$pinNum)->first();
             $pdf=PDF::loadView('branch.receivemoney.print',['info'=>$info]);

            return $pdf->download('Money_receipt.pdf');
       
         //Toastr::success('Successfull:)','Success');
        //return redirect()->route('branch.receivemoney');
     
    
  } else{

    date_default_timezone_set('Asia/Dhaka');
        $currentDate = date("h:i:s",time());
        $newDate =date('Y-m-d');
        $userId = $request->input('id');
        $rec = Receivemoney::find($userId);
        $rec->pin = $request->pin;
        $rec->sender_name = $request->sender_name;
        $rec->sender_number = $request->sender_number;
        $rec->sender_location = $request->sender_location;
        $rec->branch_id = Session::get('customerId');
        $rec->user_id = Session::get('customerAddress');
        $rec->amount = $request->amount;
        $rec->status ="unpaid";
        $rec->receiver_number = $request->receiver_number;
        $rec->receiver_location = $request->receiver_location;
        $rec->receiver_name = $request->receiver_name;
        $rec->receiver_nid = $request->receiver_nid;
        $rec->date=$newDate;
        $rec->time= $currentDate;
        

        $rec->save();
      $pinNum=$rec->pin;
      $upAd=$rec->receiver_location;
    $sendMoney = DB::table('sendmoneys')->where('pin',$pinNum)->update(['receiver_location'=>$upAd,'user_id'=>Session::get('customerAddress')]);
       
         Toastr::success('Successfull:)','Success');
        return redirect()->route('subusersend.history');
     
    }

  }
         

}
