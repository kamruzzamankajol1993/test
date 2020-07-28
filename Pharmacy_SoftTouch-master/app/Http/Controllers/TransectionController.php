<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use PDF;
use App\Sendmoney;
use App\Receivemoney;
use App\Location;
use Illuminate\Support\Facades\Auth;
class TransectionController extends Controller
{

	public function index(){
       
        $details = Auth::user()->sendmoneys()->latest()->paginate(10);
		return view('sendmoney.manage',['details'=>$details]);
	}

	public function create(){
        $locations = Location::latest()->get();
		return view('sendmoney.add',['locations'=>$locations]);
	}


	 public function store(Request $request){

        $this->validate($request,[
            'user_id' => 'required',
            'sender_name' => 'required',
            'sender_number' => 'required',
            'sender_location' => 'required',
            'amount' => 'required',
            'reciver_location' => 'required',
            'reciver_name' => 'required'
            
        ]);
        date_default_timezone_set('Asia/Dhaka');
        $currentDate = date("h:i:s",time());
        $newDate =date('Y-m-d');
        $reg = new Sendmoney();
        $reg->user_id = $request->user_id;
        $reg->pin = 'PHA-'.rand('10000000','99999999');
        $reg->sender_name = $request->sender_name;
        $reg->sender_number = $request->sender_number;
        $reg->sender_location = $request->sender_location;
        $reg->amount = $request->amount;
        $reg->status = "unpaid";
        $reg->reciver_location = $request->reciver_location;
        $reg->reciver_name = $request->reciver_name;
        $reg->date=$newDate;
        $reg->time= $currentDate;
        $reg->save();
        $regPin=$reg->pin;

        $rec = new Receivemoney();
        $rec->sender_name = $request->sender_name;
        $rec->sender_location = $request->sender_location;
        $rec->receiver_name = $request->reciver_name;
        $rec->receive_amount = $request->amount;
        //$rec->receiver_location = $request->receiver_location;
        $rec->pin =$regPin;
        $rec->save();
        Toastr::success('Successfully Saved :)' ,'Success');
        return redirect()->route('sendmoney');
    }

     public function destroy($id)
    {
         Sendmoney::find($id)->delete();
         Toastr::warning('Successfully Deleted :)','Success');
         return redirect()->back();
    }


    public function indexreceive(){
        $details =Receivemoney::latest()->get();
        return view('receivemoney.manage',['details'=>$details]);
    }

    public function editreceive($id){
       
        $detail=Receivemoney::find($id);
        return view('receivemoney.edit',['detail'=>$detail]);

    }

    public function showreceive($id){
       
        $detail=Receivemoney::find($id);
        return view('receivemoney.show',['detail'=>$detail]);

    }


     public function updatereceive(Request $request, $id){
         date_default_timezone_set('Asia/Dhaka');
        $currentDate = date("h:i:s",time());
        $newDate =date('Y-m-d');
        $video = Receivemoney::find($id);
        $video->receiver_name =$request->receiver_name ;
        //$video->user_id=$request->user_id;
        $video->receiver_number=$request->receiver_number;
        $video->reciver_nidnumber=$request->reciver_nidnumber;
        $video->status= 1;
        $video->date=$newDate;
        $video->time= $currentDate;
         if ($request->file('file')) {
            $photoName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path().'/upload', $photoName);
            $video->copy = $photoName;
        }

        $video->save();
        
        $sendMoney = DB::table('sendmoneys')->where('reciver_name',$request->receiver_name)->update(['status'=>'paid']);
       
         Toastr::success('Successfull:)','Success');
        return redirect()->route('receivemoney');
     
    }


      public function printreceive($id){
             $info=Receivemoney::find($id);
             $pdf=PDF::loadView('receivemoney.print',['info'=>$info]);

            return $pdf->stream('Money_receipt.pdf');
    }


    public function search(Request $request)
    {
        
        $from_date = $request->input('from');
        $to_date = $request->input('to');
       
         $details= Sendmoney::whereIn('status', [2,1])->where('get_status',0)->whereBetween('date', array($from_date, $to_date))->orderBy('id','desc') ->get();   
     
       


    return view('sendmoney.search')->with([
       
     'details'=>$details,
    
    ]);
    }

   public function searchreceive(Request $request)
    {
        
        $from_date = $request->input('from');
        $to_date = $request->input('to');
        
       
    $details= Receivemoney::where('status',5)->whereBetween('date', array($from_date, $to_date)) ->get();  
       
       


    return view('receivemoney.search')->with([
       
     'details'=>$details,
    
    ]);
    }


    public function storelocation(Request $request){

        $this->validate($request,[
            'location_name' => 'required',
     ]);

        $reg = new Location();
        $reg->location_name= $request->location_name;
        $reg->save();
        Toastr::success('Successfully Saved :)' ,'Success');
        return redirect()->route('sendmoney.create');
    }


     public function destroylocation($id)
    {
         Location::find($id)->delete();
         Toastr::warning('Successfully Deleted :)','Success');
         return redirect()->back();
    }
    
    
    public function re1($id){
        
        
        return redirect('/sub_branch');
    }
    
    public function re2($id){
        
        
        return redirect('/branch/sendmoney');
    }
    
    public function re3($id){
        
        
        return redirect('/branch/receivemoney');
    }
        
    
    
}
