<?php

namespace App\Http\Controllers;

use App\Purchase_Master;
use App\Purchase_Detail;
use App\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase_master= Purchase_Master::all();

       return view('purchase.list',compact('purchase_master'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $product = DB::table('products')
//            ->select('p_bname', 'p_id', 'p_price', 'p_icon', 'p_discount', 'p_seffect', 'p_desc')
//            ->get();
        $supplier=Suppliers::pluck('name','id');

        return view('purchase.create',compact('supplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data =array(
            'purchase_master_id'=>date('YmdHis'),
            'chalan_no'=>$request->chalan_no,
            'supplier_id'=>$request->supplier_id,
            'purchase_date'=>$request->purchase_date,
            'purchase_details'=>$request->purchase_details,
            'grand_total'=>$request->grand_total,
            'payment_type'=>$request->payment_type,
            'status'=>1,
        );
      $purchase_master= Purchase_Master::create($data);
      $purchase_master_id=$data['purchase_master_id'];
      $length = count($request->product_id);
        $product=$request->product_id;
        $batch=$request->batch_id;
        $expire=$request->expire_date;
        $quantity=$request->quantity;
        $rate=$request->rate;
        $total_amount=$request->total_amount;
        for ($i=0; $i < $length; $i++) {
            $product_quantity = $quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $product[$i];
            $total_price = $total_amount[$i];
            $batch_id=$batch[$i];
            $expire_date=$expire[$i];

            $data1 = array(
                'purchase_details_id'=>	str_random(15),
                'purchase_master_id'		=>	$purchase_master_id,
                'product_id'		=>	$product_id,
                'quantity'			=>	$product_quantity,
                'rate'				=>	$product_rate,
                'total_amount'		=>	$total_price,
                'batch_id'          =>  $batch_id,
                'expire_date'      =>  $expire_date,
                'status'			=>	1
            );

            if(!empty($quantity))
            {
                Purchase_Detail::create($data1);
            }
        }
            return redirect(route('purchase.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase_master = Purchase_Master::where('purchase_master_id',$id)->first();
        $supplier=Suppliers::pluck('name','id');

        return view('purchase.show',compact('purchase_master','supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase_master = Purchase_Master::where('purchase_master_id',$id)->first();
        $supplier=Suppliers::pluck('name','id');

        return view('purchase.edit',compact('purchase_master','supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data =array(
            'chalan_no'=>$request->chalan_no,
            'supplier_id'=>$request->supplier_id,
            'purchase_date'=>$request->purchase_date,
            'purchase_details'=>$request->purchase_details,
            'grand_total'=>$request->grand_total,
            'payment_type'=>$request->payment_type,
            'status'=>1,
        );
        $purchase_master= Purchase_Master::where('purchase_master_id',$id)->update($data);

        $length = count($request->product_id);
        $product=$request->product_id;
        $purchase_details_id=$request->purchase_details_id;
        $batch=$request->batch_id;
        $expire=$request->expire_date;
        $quantity=$request->quantity;
        $rate=$request->rate;
        $total_amount=$request->total_amount;
        for ($i=0; $i < $length; $i++) {
            $product_quantity = $quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $product[$i];
            $total_price = $total_amount[$i];
            $batch_id=$batch[$i];
            $expire_date=$expire[$i];
            $purchase_d_id=$purchase_details_id[$i];
            $data1 = array(
                'product_id'		=>	$product_id,
                'quantity'			=>	$product_quantity,
                'rate'				=>	$product_rate,
                'total_amount'		=>	$total_price,
                'batch_id'          =>  $batch_id,
                'expire_date'      =>  $expire_date,
                'status'			=>	1
            );

            if(!empty($quantity))
            {
                Purchase_Detail::where('purchase_details_id',$purchase_d_id)->update($data1);
            }
        }

        return redirect(route('purchase.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Purchase_Detail::where('purchase_master_id',$id)->delete();
       Purchase_Master::where('purchase_master_id',$id)->delete();
       return redirect()->back();
    }
}
