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
class BranchtransectionController extends Controller
{
    public function index(){

    $details=Sendmoney::whereIn('status', [2,1])->where('get_status',0)->orderBy('id','desc')->get();
       $bName =Branch::select('add')->get();  
    	return view('branch.sendmoney.manage',['bName'=>$bName,'details'=>$details]);
    }


    public function search(Request $request)
    {
        
        $search_txt = $request->input('from');
        $details =Money::Where('sender_number', 'like', '%'.$search_txt.'%')
                 ->orwhere('sender_nid', 'like', '%'.$search_txt.'%')
                 ->get();
       
   $bName =DB::table('branches')->distinct('add')->get(['add']);

    return view('branch.sendmoney.search')->with([
       
     'details'=>$details,
    'bName'=>$bName
    ]);
    }


     public function store(Request $request){
          $sendAmount = $request->input('amount');
          $totalAmount  = Session::get('customerAmount');
          $fundStatus = Session::get('customerFund');
          
          if($fundStatus == 1){
              
              $this->validate($request,[
            
            'sender_name' => 'required',
            'sender_number' => 'required',
            'sender_location' => 'required',
            'amount' => 'required',
            'receiver_location' => 'required',
            'receiver_name' => 'required'
            
        ]);
        date_default_timezone_set('Asia/Dhaka');
        $currentDate = date("h:i:s",time());
        $newDate =date('Y-m-d');
        $reg = new Sendmoney();
        $reg->cost = $request->cost;
        $reg->pin = 'ATC-'.rand('10000000','99999999');
        $reg->sender_name = $request->sender_name;
        $reg->sender_number = $request->sender_number;
        $reg->sender_location = $request->sender_location;
        $reg->sender_nid = $request->sender_nid;
        $reg->amount = $request->amount;
        $reg->status = 8;
        $reg->receiver_location = $request->receiver_location;
        $reg->receiver_number = $request->receiver_number;
        $reg->receiver_name = $request->receiver_name;
        $reg->receiver_nid = $request->receiver_nid;
        $reg->date=$newDate;
        $reg->time= $currentDate;
        $reg->branch_id = Session::get('customerId');
        $reg->save();
        $regPin=$reg->pin;

        
     

         $prov=DB::table('sendmoneys')->where('pin',$regPin)->first();
            Toastr::warning('Please Print Receipt Before Sending Money:)' ,'Warning');
        return view('branch.sendmoney.reveiew',['prov'=>$prov]);
              
          }else{
              
              
               if($sendAmount <= $totalAmount){
              
                $this->validate($request,[
            
            'sender_name' => 'required',
            'sender_number' => 'required',
            'sender_location' => 'required',
            'amount' => 'required',
            'receiver_location' => 'required',
            'receiver_name' => 'required'
            
        ]);
        date_default_timezone_set('Asia/Dhaka');
        $currentDate = date("h:i:s",time());
        $newDate =date('Y-m-d');
        $reg = new Sendmoney();
        $reg->cost = $request->cost;
        $reg->pin = 'ATC-'.rand('10000000','99999999');
        $reg->sender_name = $request->sender_name;
        $reg->sender_number = $request->sender_number;
        $reg->sender_location = $request->sender_location;
        $reg->sender_nid = $request->sender_nid;
        $reg->amount = $request->amount;
        $reg->status = 8;
        $reg->receiver_location = $request->receiver_location;
        $reg->receiver_number = $request->receiver_number;
        $reg->receiver_name = $request->receiver_name;
        $reg->receiver_nid = $request->receiver_nid;
        $reg->date=$newDate;
        $reg->time= $currentDate;
        $reg->branch_id = Session::get('customerId');
        $reg->save();
        $regPin=$reg->pin;

        
     

         $prov=DB::table('sendmoneys')->where('pin',$regPin)->first();
            Toastr::warning('Please Print Receipt Before Sending Money:)' ,'Warning');
        return view('branch.sendmoney.reveiew',['prov'=>$prov]);
          }else{
              
            Toastr::success('You should add less amount than your available amount :)' ,'Success');
        //return redirect()->route('branch.sendmoney');
        return redirect()->back();
          }
              
          }
          
         
       

    
      

  } 

    


    public function indexreceive(){
        $branchId=Session::get('customerId');
        $details=Receivemoney::where('status',5)->Where('branch_id',$branchId)->orderBy('date','desc')->get();
    	return view('branch.receivemoney.manage',['details'=>$details]);
    }


    public function searchreceive(Request $request)
    {
        $search_txt = $request->input('from');
       
         
        $details =Receivemoney::where('status','unpaid')->Where('pin', 'like', '%'.$search_txt.'%')
                // ->orwhere('receiver_location', 'like', '%'.$search_txt.'%')
                 ->get();
       
  

    return view('branch.receivemoney.search')->with([
       
     'details'=>$details
   
    ]);
    }


    public function updatereceive(Request $request){
        if($request->get('btnSubmit') == 'button1') {
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
        $rec->get_status =2;
        $rec->receiver_number = $request->receiver_number;
        $rec->receiver_name = $request->receiver_name;
        $rec->receiver_nid = $request->receiver_nid;
        $rec->date=$newDate;
        $rec->time= $currentDate;
         if ($request->file('file')) {
            $photoName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path().'/upload', $photoName);
            $rec->nidcopy = $photoName;
        }

        $rec->save();
        $pinNum=$rec->pin;
        

             $info=Receivemoney::Where('pin',$pinNum)->first();
             $pdf=PDF::loadView('branch.receivemoney.print',['info'=>$info]);

            return $pdf->download('Money_receipt.pdf');
       
         //Toastr::success('Successfull:)','Success');
        //return redirect()->route('branch.receivemoney');
        }else if($request->get('btnSubmit') == 'button2') {
            
            
            
            $userId = $request->input('id');
            
            $getValue =Receivemoney::where('id',$userId)->value('get_status');
            
            if($getValue == 2){
                
                $rec = Receivemoney::find($userId);
        $rec->pin = $request->pin;
         $rec->amount = $request->amount;
        $rec->status = 5;
        $rec->save();
        $pinNum=$rec->pin;
        $rAmount=$rec->amount;
        $sendMoney = DB::table('sendmoneys')->where('pin',$pinNum)->update(['status'=>1,'user_id'=>Session::get('customerAddress')]);
        
        $bSt1=DB::table('receivemoneys')->where('pin',$pinNum)->value('branch_id');
        $bSt=DB::table('branches')->where('id',$bSt1)->value('fund_status');
        
        if($bSt == 1){
            
            
            
             Toastr::success('Successfull:)','Success');
        return redirect()->route('branch.receivemoney');
            
        }else{
             $bId=DB::table('receivemoneys')->where('pin',$pinNum)->value('branch_id');
        $bAmount=DB::table('branches')->where('id',$bId)->value('amout');
        
        $update=$bAmount+$rAmount;
        Db::table('branches')->where('id',$bId)->update(['amout'=>$update]);
        Session::put('customerAmount',$update);
        
        Toastr::success('Successfull:)','Success');
        return redirect()->route('branch.receivemoney');
            
        }
        
       
                
            }else{
                
               Toastr::warning('Please Print First:)','danger');
        return redirect()->route('branch.receivemoney'); 
            }
            
        
            
        }
     
    }

     public function updatereceivestatus(Request $request){
        $userId = $request->input('id');
        $rec = Receivemoney::find($userId);
        $rec->status = $request->status;
        $rec->save();
        Toastr::success('Successfull:)','Success');
        return redirect()->route('branch.receivemoney');
     }



        public function edit($id){
       
        $prov=Sendmoney::find($id);
        return view('branch.sendmoney.edit',['prov'=>$prov]);

    }

    public function update(Request $request){

date_default_timezone_set('Asia/Dhaka');
        $currentDate = date("h:i:s",time());
        $newDate =date('Y-m-d');
        $rec = new Receivemoney();
        $rec->cost = $request->cost;
        $rec->pin = $request->pin;
        $rec->sender_name = $request->sender_name;
        $rec->sender_number = $request->sender_number;
        $rec->sender_location = $request->sender_location;
        $rec->sender_nid = $request->sender_nid;
        $rec->amount = $request->amount;
        $rec->status = "unpaid";
        $rec->receiver_location = $request->receiver_location;
        $rec->receiver_name = $request->receiver_name;
        $rec->receiver_nid = $request->receiver_nid;
        $rec->date=$newDate;
        $rec->time= $currentDate;
        $rec->branch_id = Session::get('customerId');
        $rec->save();
        $sendMoney = DB::table('sendmoneys')->where('receiver_nid',$request->receiver_nid)->update(['status'=>"unpaid"]);
        Toastr::success('Successfully Saved :)' ,'Success');
        return redirect()->route('branch.sendmoney');

    }

    public function storeprint($id){

 $sendMoney = DB::table('sendmoneys')->where('id',$id)->update(['status'=>"9"]);
             $info=Sendmoney::Where('id',$id)->first();
             $pdf=PDF::loadView('branch.sendmoney.print',['info'=>$info]);

             //return Redirect::to('/branch/sendmoney');
           
            return $pdf->download('Money_receipt.pdf');


    }


    public function supdate(Request $request){
        
         $fundStatus = Session::get('customerFund');
          
          if($fundStatus == 1){
              
              date_default_timezone_set('Asia/Dhaka');
        $currentDate = date("h:i:s",time());
        $newDate =date('Y-m-d');
        $rec = new Receivemoney();
        $rec->cost = $request->cost;
        $rec->pin = $request->pin;
        $rec->sender_name = $request->sender_name;
        $rec->sender_number = $request->sender_number;
        $rec->sender_location = $request->sender_location;
        $rec->sender_nid = $request->sender_nid;
        $rec->amount = $request->amount;
        $rec->status = "unpaid";
        $rec->receiver_location = $request->receiver_location;
        $rec->receiver_name = $request->receiver_name;
        $rec->receiver_nid = $request->receiver_nid;
        $rec->receiver_number = $request->receiver_number;
        $rec->date=$newDate;
        $rec->time= $currentDate;
        $rec->branch_id = Session::get('customerId');
        $rec->save();
        $regPin = $rec->pin;
       $sendMoney = DB::table('sendmoneys')->where('pin',$regPin)->update(['get_status'=>0]);
         
        Toastr::success('Successully Send :)' ,'Success');
        return redirect('/branch/sendmoney');
              
          }else{
              
              
                date_default_timezone_set('Asia/Dhaka');
        $currentDate = date("h:i:s",time());
        $newDate =date('Y-m-d');
        $rec = new Receivemoney();
        $rec->cost = $request->cost;
        $rec->pin = $request->pin;
        $rec->sender_name = $request->sender_name;
        $rec->sender_number = $request->sender_number;
        $rec->sender_location = $request->sender_location;
        $rec->sender_nid = $request->sender_nid;
        $rec->amount = $request->amount;
        $rec->status = "unpaid";
        $rec->receiver_location = $request->receiver_location;
        $rec->receiver_name = $request->receiver_name;
        $rec->receiver_nid = $request->receiver_nid;
        $rec->receiver_number = $request->receiver_number;
        $rec->date=$newDate;
        $rec->time= $currentDate;
        $rec->branch_id = Session::get('customerId');
        $rec->save();
        $regPin = $rec->pin;
        $bId= $rec->branch_id;
        $amount=$rec->amount;
       $sendMoney = DB::table('sendmoneys')->where('pin',$regPin)->update(['get_status'=>0]);
       
       
        $totalView=DB::table('branches')->where('id',$bId)->value('amout');
        $update=$totalView-$amount;
        Db::table('branches')->where('id',$bId)->update(['amout'=>$update]);
        
        $psession = Session::get('customerAmount');
        //Session::flash('customerAmount',$psession );
        Session::put('customerAmount',$update);
         
        Toastr::success('Successully Send :)' ,'Success');
        return redirect('/branch/sendmoney');
              
              
          }
      
    }

    public function bsupdate(Request $request){

 $sendMoney = DB::table('sendmoneys')->where('id',$request->id)->update(['status'=>$request->status]);
 $info=Sendmoney::Where('id',$request->id)->first();
$pdf=PDF::loadView('branch.sendmoney.print',['info'=>$info]);

             //return Redirect::to('/branch/sendmoney');
           
          return $pdf->download('Money_receipt.pdf');


    }

    public function supdate1($id){



        $prov=Sendmoney::Where('id',$id)->first();
        //Toastr::success(' Se:)' ,'Success');
        return view ('branch.sendmoney.mainsend',['prov'=>$prov]);
    }
}
