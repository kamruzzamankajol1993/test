<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Bank_info;
use App\Check_detail;
use App\Check_page_no;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use PDF;
use App\Branch;
use App\Deposite_information;
use App\Printm;
class DepositeController extends Controller
{
    public function manage(){

    	$details=Deposite_information::latest()->get();
        $branchNames=Bank_info::latest()->get();
    	return view('deposite.manage',['details'=>$details,'branchNames'=>$branchNames]);
    }


    public function create(){

    	$branchNames=Branch::latest()->get();
    	$bankNames=Bank_info::latest()->get();

    	return view('deposite.create',['bankNames'=>$bankNames,'branchNames'=>$branchNames]);
    }


     public function findProductName1(Request $request){

        $data=Bank_info::select('accountnumber')->where('id',$request->id)->get();
        return response()->json($data);
    }


      public function store(Request $request){

         if($request->get('btnSubmit') == 'button1') {
             date_default_timezone_set('Asia/Dhaka');
        $currentDate = date("h:i:s",time());
        $newDate =date('Y-m-d');
        $customer = new Deposite_information();
        $customer->branch_id = $request->branch_id;
        $customer->bank_id = $request->bank_id;
        $customer->depositeBy = $request->depositeBy;
        $customer->accountnumber = $request->accountnumber;
        $customer->amount = $request->amount;
         $customer->status = $request->status;
           $customer->date =$newDate;
        $customer->save();

        //$customerId = $customer->amount;
        //Session::put('customerId',$customerId);
        //Session::put('depositeAmount',$customerId);

        $bankId=$customer->bank_id;
        $amount=$customer->amount;

        
     
        $totalView=DB::table('bank_infos')->where('id',$bankId)->value('amount');
        $update=$totalView+$amount;
         $prov=DB::table('bank_infos')->where('id',$bankId)->update(['amount'=>$update]);



       return redirect('/deposite');

   }else if($request->get('btnSubmit') == 'button2') {


  date_default_timezone_set('Asia/Dhaka');
        $currentDate = date("h:i:s",time());
        $newDate =date('Y-m-d');
        $customer = new Printm();
        $customer->branch_id = $request->branch_id;
        $customer->bank_id = $request->bank_id;
        $customer->depositeBy = $request->depositeBy;
        $customer->accountnumber = $request->accountnumber;
        $customer->amount = $request->amount;
         $customer->status = $request->status;
           $customer->date =$newDate;
        $customer->save();

        //$customerId = $customer->amount;
        //Session::put('customerId',$customerId);
        //Session::put('depositeAmount',$customerId);

        $bankId=$customer->id;
        $amount=$customer->amount;

        $info=Printm::Where('id',$bankId)->first();
             $pdf=PDF::loadView('deposite.print',['info'=>$info]);

            return $pdf->download('Money_receipt.pdf');

   }
    }

    public function print($id){

           $info=Deposite_information::Where('id',$id)->first();
             $pdf=PDF::loadView('deposite.print',['info'=>$info]);

            return $pdf->download('Money_receipt.pdf');

    }
}
