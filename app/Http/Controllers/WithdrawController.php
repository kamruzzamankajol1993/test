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
use App\Withdraw_amount;
class WithdrawController extends Controller
{
    public function manage(){

    	$details=Withdraw_amount::latest()->get();
        $bankNames=Bank_info::latest()->get();
        $checkNames=Check_detail::latest()->get();
        $Check_page_nos=Check_page_no::latest()->get();
    	return view('withdraw.manage',['details'=>$details,'bankNames'=>$bankNames,'checkNames'=>$checkNames,'Check_page_nos'=>$Check_page_nos]);
    }


    public function create(){

    	$branchNames=Branch::latest()->get();
    	$bankNames=Bank_info::latest()->get();

    	return view('deposite.create',['bankNames'=>$bankNames,'branchNames'=>$branchNames]);
    }


     public function search(Request $request)
    {
        
        $search_txt = $request->input('from');
        $details =Check_page_no::Where('checkpage_no', 'like', '%'.$search_txt.'%')
                 
                 ->get();
       
    $bankNames=Bank_info::latest()->get();
        $checkNames=Check_detail::latest()->get();
        $Check_page_nos=Check_page_no::latest()->get();

    return view('withdraw.search',['details'=>$details,'bankNames'=>$bankNames,'checkNames'=>$checkNames,'Check_page_nos'=>$Check_page_nos]);
    }


     public function store(Request $request){

          $mainStatus = $request->input('status');

          if($mainStatus == 1){
             $mainBankId = $request->input('bank_id');
         $sendAmount = $request->input('amount');

        $mainAmount=Bank_info::where('id',$mainBankId)->value('amount');

        if($sendAmount <= $mainAmount){


            date_default_timezone_set('Asia/Dhaka');
        $currentDate = date("h:i:s",time());
        $newDate =date('Y-m-d');
        $reg = new Withdraw_amount();
        $reg->branch_id = Session::get('customerId');
        $reg->bank_id = $request->bank_id;
        $reg->check_id = $request->check_id;
         $reg->checkpage_no = $request->checkpage_no;
        $reg->amount = $request->amount;
        $reg->date=$newDate;
        $reg->signature = $request->signature;
        $reg->barreidBy = $request->barreidBy;
        $reg->desi = $request->desi;
        $reg->save();
        $mainId=$reg->id;
        $checkPageno=$reg->checkpage_no;
        $amount=$reg->amount;

        
        $bankId=DB::table('withdraw_amounts')->where('id',$mainId)->value('bank_id');
        $totalView=Bank_info::where('id',$bankId)->value('amount');
        $update=$totalView-$amount;
         $prov=DB::table('bank_infos')->where('id',$bankId)->update(['amount'=>$update]);


         $deletePage=DB::table('check_page_nos')->where('checkpage_no',$checkPageno)->update(['status'=>1]);
         
            Toastr::success('Successfull:)' ,'success');
        return redirect()->route('withdraw');

        }else{
           Toastr::error('Please Try Again:)' ,'error');
        return redirect()->route('withdraw');

        }

          }else{


            $mainPage = $request->input('checkpage_no');


         $deletePage=DB::table('check_page_nos')->where('checkpage_no',$mainPage)->update(['status'=>3]);
                      Toastr::error('Check Rejected:)' ,'error');
        return redirect()->route('withdraw');

          }

       

    

  } 
}
