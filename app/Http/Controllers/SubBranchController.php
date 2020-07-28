<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use PDF;
use App\Branch;
use App\Receivemoney;
use App\Location;
use App\Money;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
class SubBranchController extends Controller
{
    public function index(){

    	$details=Money::latest()->get();
        
    	return view('subbranch.manage',['details'=>$details]);
    }

     public function indexp(){

        $details=Branch::latest()->get();
        
        return view('branch.profile.manage',['details'=>$details]);
    }


    public function create(){

    	return view('subbranch.create');
    }

    public function createp(){

        return view('branch.profile.add');
    }


    protected function audioUpload($request){
        $audiofile = $request->file('photo');
        $audioName = $audiofile->getClientOriginalName();
        $extension = $audiofile->getClientOriginalExtension();
        //$imageName = $productImage->getClientOriginalName();
       
        $directory = 'branch-profile/';
        $audioUrl = $directory.$audioName;
    
        $audiofile->move($directory, $audioUrl);

        //Image::make($productImage)->resize(300,300)->save($imageUrl);

       return  $audioName;
    }


     public function saveaudio($request, $audiofile){
        $customer = new Branch();
        $customer->photo =  $audiofile;
        $customer->name =  $request->name;
        $customer->user_id = $request->user_id;
        $customer->sub_branch_id = $request->sub_branch_id;
        $customer->detail = $request->name;
        $customer->branch_id = str_slug($request->name);
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->mstatus = $request->mstatus;
        $customer->add= Session::get('customerAddress');
        $customer->add_by = 1;
        $customer->fund_status = $request->fund_status;
        $customer->password = Hash::make($request->password);
        $customer->mpass =$request->password;
        $customer->save();

        //$customerId = $customer->id;
        //Session::put('customerId',$customerId);
        //Session::put('customerName',$customer->branch_id);
        //Session::put('customerAddress',$customer->add);
   //Session::put('customerStatus',$customer->add_by);
       return redirect('/user_profile');
    }

     public function storep(Request $request){
       
         $audiofile = $this->audioUpload($request);
        $this->saveaudio($request, $audiofile);

       return redirect('/user_profile');
    }


    public function store(Request $request){
        $customer = new Money();
        $customer->user_id = $request->user_id;
        $customer->sender_name = $request->sender_name;
        $customer->sender_nid = $request->sender_nid;
        $customer->sender_number = $request->sender_number;
        $customer->receiver_name = $request->receiver_name;
        $customer->receiver_number = $request->receiver_number;
        $customer->receiver_nid = $request->receiver_nid;
        $customer->save();

        //$customerId = $customer->id;
        //Session::put('customerId',$customerId);
        //Session::put('customerName',$customer->branch_id);

       return redirect('/sub_branch');
    }


     public function destroy($id)
    {
         Money::find($id)->delete();
         Toastr::warning('Successfully Deleted :)','Success');
         return redirect()->back();
    }


     public function edit($id)
    {
        $detail = Money::find($id);
        return view('subbranch.edit',['detail'=>$detail]);
    }
    public function editp($id)
    {
        $detail = Branch::find($id);
        return view('branch.profile.edit',['detail'=>$detail]);
    }
public function historyp($id)
    {
        $detail = Branch::where('id',$id)->first();
        return view('branch.profile.history',['detail'=>$detail]);
    }

   public function update(Request $request){
   	    $userId = $request->input('id');

    	$customer =Money::find($userId );
        $customer->user_id = $request->user_id;
        $customer->sender_name = $request->sender_name;
        $customer->sender_nid = $request->sender_nid;
        $customer->sender_number = $request->sender_number;
        $customer->receiver_name = $request->receiver_name;
        $customer->receiver_number = $request->receiver_number;
        $customer->receiver_nid = $request->receiver_nid;
        $customer->save();
   	     return redirect('/sub_branch')->with('message','Updated Successfully');
    }


     public function updatep(Request $request){
             $userId = $request->input('id');

            $customer = Branch::find($userId);
$customer->name =  $request->name;
        $customer->user_id = $request->user_id;
        $customer->sub_branch_id = $request->sub_branch_id;
        $customer->detail = $request->name;
        $customer->branch_id = str_slug($request->name);
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->mstatus = $request->mstatus;
        $customer->fund_status = $request->fund_status;
        $customer->add= Session::get('customerAddress');
        $customer->add_by = 1;
        $customer->mpass =$request->mpass;
        $customer->password = Hash::make($request->mpass);
        
         
 if($request->hasfile('photo')){
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('branch-profile/',$filename);
            $customer->photo = $filename;
        }

        $customer->save();
       
         Toastr::success('Successfully Updated :)','Success');
         return redirect('/user_profile');
     
    }


    public function inactive($id){
        $software = Branch::find($id);
        $software->mstatus = 0;
        $software->save();

        return redirect('/user_profile');
    }

    public function active($id){
        $software = Branch::find($id);
        $software->mstatus = 1;
        $software->save();

        return redirect('/user_profile');
    }


}
