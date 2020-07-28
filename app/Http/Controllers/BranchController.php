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
class BranchController extends Controller
{
  
  public function all(){

         $details = Sendmoney::whereIn('status', [2,1])->where('get_status',0)->orderBy('id','desc')->get();
        $details1 = Receivemoney::where('status',5)->orderBy('id','desc')->get();

       
        return view('branch.sendmoney.allhistory',['details'=>$details,'details1'=>$details1]);


    }
  
  
  
    public function index(){

    	$details= Branch::latest()->paginate(10);
        
    	return view('branch.manage',['details'=>$details]);
    }


    public function create(){

    	return view('branch.create');
    }


    public function store(Request $request){
        $customer = new Branch();
        $customer->user_id = $request->user_id;
        $customer->detail = $request->detail;
        $customer->branch_id = str_slug($request->detail);
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->add = $request->add;
        $customer->add_by = $request->add_by;
        $customer->sub_branch_id = $customer->id;
        $customer->password = Hash::make($request->password);
        $customer->mpass =$request->password;
        $customer->save();

        $customerId = $customer->id;
        Session::put('customerId',$customerId);
        Session::put('customerName',$customer->branch_id);
        Session::put('customerAddress',$customer->add);

       return redirect('/branch');
    }

    public function login(Request $request){
         $customer = Branch::where('email',$request->email)->where('mstatus',1)->first();
        if(password_verify($request->password,$customer->password)){

            Session::put('customerId',$customer->id);
            Session::put('customerFund',$customer->fund_status);
            Session::put('customerAmount',$customer->amout);
            Session::put('customerEmail',$customer->email);
            Session::put('customerPass',$customer->pass);
            Session::put('customerName',$customer->branch_id);
            Session::put('customerAddress',$customer->add);
            Session::put('customerUser',$customer->sub_branch_id);
            Session::put('customerStatus',$customer->add_by);
            return redirect('/branch/dashboard');
        } else {
            return redirect('/branch')->with('message','Incorrect Password');
        }
    }


    public function blogin(){

    	return view('branch.login');
    }

    public function dashboard(){


    	return view('branch.dashboard');

    }

    public function blogout()
     {
         Auth::logout();
       Session::flush();
     return redirect('/branch_login');
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
        return view('branch.edit',['detail'=>$detail]);
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
        $customer->add_by = $request->add_by;
        $customer->sub_branch_id = $customer->id;
        $customer->password = Hash::make($request->password);
        $customer->save();
   	     return redirect('/branch')->with('message','Updated Successfully');
    }


    public function history($add)
    {
        $details = Sendmoney::where('sender_location',$add)->get();
        $details1 = Receivemoney::where('receiver_location',$add)->get();

        $branchName=Branch::where('add',$add)->distinct('add')->value('add');
        return view('branch.history',['details'=>$details,'details1'=>$details1,'branchName'=>$branchName]);
    }
}
