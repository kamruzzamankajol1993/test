<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use PDF;
use App\Sendmoney;
use App\Branch;
use App\Money;
use App\Receivemoney;
use App\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Bank_info;
use App\Check_detail;
use App\Check_page_no;

class BankinfoController extends Controller
{
    public function bmanage(){

    	$details=Bank_info::latest()->get();
        
    	return view('bank.manage',['details'=>$details]);
    }
     public function cmanage($id){

    	$details=Check_detail::where('bank_id',$id)->get();
        $details1=Check_page_no::latest()->get();
    	$bankId=Bank_info::where('id',$id)->value('id');
    	$bankName=Bank_info::where('id',$id)->value('bankname');
        $branchName=Bank_info::where('id',$id)->value('branchname');
    	return view('check.manage',['details'=>$details,'details1'=>$details1,'bankId'=>$bankId,'bankName'=>$bankName,'branchName'=>$branchName]);
    }

    public function bcreate(){

    	return view('bank.create');
    }


     public function bstore(Request $request){
        $customer = new Bank_info();
        $customer->branch_id = $request->branch_id;
        $customer->bankname = $request->bankname;
        $customer->branchname = $request->branchname;
        $customer->accountnumber = $request->accountnumber;
       
        $customer->save();

        //$customerId = $customer->id;
        //Session::put('customerId',$customerId);
        //Session::put('customerName',$customer->branch_id);

       return redirect('/bank');
    }


     public function bedit($id)
    {
        $detail =Bank_info::find($id);
        return view('bank.edit',['detail'=>$detail]);
    }


     public function bupdate(Request $request){
   	    $userId = $request->input('id');

    	$customer =Bank_info::find($userId );
        $customer->branch_id = $request->branch_id;
        $customer->bankname = $request->bankname;
        $customer->branchname = $request->branchname;
        $customer->accountnumber = $request->accountnumber;
        $customer->save();
   	     return redirect('/bank')->with('message','Updated Successfully');
    }

    public function cstore(Request $request){
       
       $firstPage=$request->input('checkpage_no');
       $lastPage=$request->input('checkpage_no_last');

        $customer = new Check_detail();
        $customer->branch_id = $request->branch_id;
        $customer->bank_id = $request->bank_id;
        $customer->check_no = $request->check_no;
        //$customer->checkpage_no = implode(',',$request->checkpage_no);
       
        $customer->save();
        $checkId=$customer->id;

       $count=$firstPage;
if($request->checkpage_no != Null){
       for($i=$firstPage;$i<=$lastPage;$i++){

        $customer = new Check_page_no();
        $customer->branch_id = $request->branch_id;
        $customer->bank_id = $request->bank_id;
        $customer->check_id =$checkId;
        $customer->checkpage_no =$count++;
        $customer->save();
       }
   }
        
        return redirect('/bank')->with('message','Updated Successfully');
}

 public function detail($id)
    {
        
        $details =Check_page_no::where('check_id',$id)->get();
        return view('check.detail',['details'=>$details]);
    }
}
