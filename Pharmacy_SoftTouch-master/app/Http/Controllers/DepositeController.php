<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Bank_info;
use App\Check_detail;
use App\Check_page_no;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use App\Branch;
use App\Deposite_information;
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
        $customer = new Deposite_information();
        $customer->branch_id = $request->branch_id;
        $customer->bank_id = $request->bank_id;
        $customer->depositeBy = $request->depositeBy;
        $customer->accountnumber = $request->accountnumber;
       $customer->amount = $request->amount;
        $customer->save();

        //$customerId = $customer->id;
        //Session::put('customerId',$customerId);
        //Session::put('customerName',$customer->branch_id);

       return redirect('/deposite');
    }
}
