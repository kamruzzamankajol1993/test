<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Products;
use App\Purchase_Detail;
use App\Sales;
use App\Sales_Detail;
use App\Sales_Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $sales_master=Sales_Master::all();
//        $getLastId = sales::all()->last();
//
//        $print = DB::table('sales')
//            ->select(DB::raw('sales.quantity,orders.invoice_no,sales.info,products.p_id,products.p_discount,products.p_barcodeg,products.p_discount,sales.order_code,products.p_bname AS name, sales.price AS price,orders.created_at'))
//            ->join('products', 'products.p_id', '=', 'sales.product_id')
//            ->join('orders', 'orders.order_code', '=', 'sales.order_code')
//            ->where('sales.order_code', $getLastId['order_code'])
//            ->get();
//
//        $sales = DB::table('orders')
//            ->select(DB::raw('sales.order_code,products.p_id,orders.invoice_no ,products.p_discount, GROUP_CONCAT(products.p_bname SEPARATOR "," ) AS name,  SUM(sales.price * ( 100.0 - products.p_discount ) / 100.0) AS price , sales.created_at'))
//            ->join('sales', 'sales.order_code', '=', 'orders.order_code')
//            ->join('products', 'products.p_id', '=', 'sales.product_id')
//            ->groupBy('sales.order_code')
//            ->orderBy('orders.id', 'desc')
//            ->paginate(40);

        return view('sales.list', compact('sales_master'));
    }

    /**
     * Show the form for sale a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = DB::table('products')
            ->select('p_bname', 'p_id', 'p_price', 'p_icon', 'p_discount', 'p_seffect', 'p_desc')
            ->get();
        return view('sales.new_create', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data =array(
            'sales_master_id'=>str_random(15),
            'customer_id'=>$request->customer_id,
            'date'=>$request->date,
            'payment_type'=>$request->payment_type,
            'total_discount'=>$request->total_discount,
            'invoice_details'=>$request->invoice_details,
            'grand_total'=>$request->grand_total,

            'net_total'=>$request->net_total,
            'paid_amount'=>$request->paid_amount,
            'product_total_discount'=>$request->product_total_discount,
            'invoice_discount'=>$request->invoice_discount,
            'due'=>$request->due,
            'status'=>1,
            'sales_by'=>auth()->user()->id,
        );
        $sales_master= Sales_Master::create($data);
        $sales_master_id=$data['sales_master_id'];
        $length = count($request->product_id);
        $product=$request->product_id;
        $batch=$request->batch_id;

        $quantity=$request->quantity;
        $rate=$request->rate;
        $total_amount=$request->total_price;
        $discount=$request->discount;
        $dis_in_percent=$request->per_product_dis_percent;
        for ($i=0; $i < $length; $i++) {
            $product_quantity = $quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $product[$i];
            $total_price = $total_amount[$i];
            $batch_id=$batch[$i];
            $dis=$discount[$i];
            $dis_percent=$dis_in_percent[$i];
            $data1 = array(
                'sales_detail_id'=>	str_random(15),
                'sales_master_id'		=>	$sales_master_id,
                'product_id'		=>	$product_id,
                'quantity'			=>	$product_quantity,
                'rate'				=>	$product_rate,
                'total_price'		=>	$total_price,
                'discount'		=>	$dis,
                'batch_id'          =>  $batch_id,
                'per_product_dis_percent'=>  $dis_percent,
                'status'			=>	1
            );

            if(!empty($quantity))
            {
                $save=Sales_Detail::create($data1);
            }
        }
        if($save){
            session()->flash('success', 'Successful sale');
            return redirect()->route('sales.index');
        }

//        $this->validate($request, array(
//            'productID' => 'required|max:10',
//            'orderPrice' => 'required|max:10',
//            'orderQuantity' => 'required|max:10',
//        ));
//        $id = $request->input('productID');
//        $price = $request->input('orderPrice');
//        $order_info = $request->input('orderInfo');
//        $order_quantity = $request->input('orderQuantity');
//        $code = rand(5, 10000000000);

        //store $order_code to orders table
//        if (!empty(Orders::all()->last()->id)) {
//            $invoice = Orders::all()->last()->id;
//        } else {
//            $invoice = 0;
//        }
//        $order = new Orders();
//        $order->order_code = $code;
//        $order->invoice_no = date('Y') . '000' . $invoice;
//        $order->save();
//        $isdone = true;

        // check if there id and price then store in to sales table
//        if ($id && $price) {
//            foreach ($id as $key => $value) {
//                $sale = new Sales();
//                $sale->order_code = $code;
//                $sale->info = $order_info[$key];
//                $sale->price = $price[$key];
//                $sale->quantity = $order_quantity[$key];
//                $sale->product_id = $id[$key];
//                $sale->save();
//            }
//        }

        // session message and redirect

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
        $sales_master=Sales_Master::where('sales_master_id',$id)->first();
        return view('sales.edit',compact('sales_master'));
    }

    public function update(Request $request,$id){
        $data =array(
            'customer_id'=>$request->customer_id,
            'date'=>$request->date,
            'payment_type'=>$request->payment_type,
            'total_discount'=>$request->total_discount,
            'invoice_details'=>$request->invoice_details,
            'grand_total'=>$request->grand_total,

            'net_total'=>$request->net_total,
            'paid_amount'=>$request->paid_amount,
            'product_total_discount'=>$request->product_total_discount,
            'invoice_discount'=>$request->invoice_discount,
            'due'=>$request->due,
            'status'=>1,
            'sales_by'=>auth()->user()->id,
        );
        $sales_master= Sales_Master::where('sales_master_id',$id)->update($data);

        $length = count($request->product_id);
        $product=$request->product_id;
        $batch=$request->batch_id;

        $quantity=$request->quantity;
        $rate=$request->rate;
        $total_amount=$request->total_price;
        $discount=$request->discount;
        $sales_detail_array=$request->sales_detail_id;
        $dis_in_percent=$request->per_product_dis_percent;
        for ($i=0; $i < $length; $i++) {
            $product_quantity = $quantity[$i];
            $product_rate = $rate[$i];
            $product_id = $product[$i];
            $total_price = $total_amount[$i];
            $batch_id=$batch[$i];
            $dis=$discount[$i];
            $sales_detail_id=$sales_detail_array[$i];
            $dis_percent=$dis_in_percent[$i];
            $data1 = array(

                'product_id'		=>	$product_id,
                'quantity'			=>	$product_quantity,
                'rate'				=>	$product_rate,
                'total_price'		=>	$total_price,
                'discount'		=>	$dis,
                'batch_id'          =>  $batch_id,
                'per_product_dis_percent'=>  $dis_percent,
                'status'			=>	1
            );

            if(!empty($quantity))
            {
                $save=Sales_Detail::where('sales_detail_id',$sales_detail_id)->update($data1);
            }
        }
        if($save){
            session()->flash('success', 'Successful Updated');
            return redirect()->route('sales.index');
        }
    }

    public function show($id)
    {
        $sales_master=Sales_Master::where('sales_master_id',$id)->first();
        return view('sales.view',compact('sales_master'));
//        $sale = DB::table('sales')
//            ->join('products', 'products.p_id', '=', 'sales.product_id')
//            ->selectRAW('sum(sales.quantity) AS quantity, sales.product_id,sales.created_at,order_code,products.p_discount,sales.price AS price , sales.info AS info, products.p_bname AS name')
//            ->where('order_code', $id)
//            ->get();
//        return view('sales.show', ['sale' => $sale]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Sales_Detail::where('sales_master_id',$id)->delete();
        Sales_Master::where('sales_master_id',$id)->delete();
        session()->flash('success', 'Successfully Deleted');
        return redirect()->route('sales.index');
//        $this->validate($request, array(
//            'id' => 'numeric',
//        ));
//        if ($request->ajax()) {
//            $sale = Sales::where('order_code', $id);
//            $sale->delete($request->all());
//            return response(['msg' => 'Product deleted', 'status' => 'success']);
//        }
//        return response(['msg' => 'Failed deleting the product', 'status' => 'failed']);
    }

    /**
     * Search the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response Json
     */

    public function search(Request $request)
    {
        $number = $request->input('search');
        $this->validate($request, array(
            'search' => 'required|max:30',
        ));
        if ($number) {
            $sales = DB::table('sales')
                ->selectRAW(' orders.invoice_no,sales.order_code,products.p_gname AS name, sum(sales.price) AS price,orders.created_at')
                ->join('products', 'products.p_id', '=', 'sales.product_id')
                ->join('orders', 'orders.order_code', '=', 'sales.order_code')
                ->where('orders.invoice_no', 'like', "$number%")
                ->groupBy('sales.order_code')
                ->get();
            return response()->json($sales);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pdf($id)
    {
        if (is_numeric($id)) {
            if ($id === '0') {
                $sales = DB::table('orders')
                    ->selectRAW('orders.invoice_no ,GROUP_CONCAT(products.p_bname SEPARATOR "," ) AS name,  SUM(sales.price * ( 100.0 - products.p_discount ) / 100.0) AS price , sales.created_at')
                    ->join('sales', 'sales.order_code', '=', 'orders.order_code')
                    ->join('products', 'products.p_id', '=', 'sales.product_id')
                    ->groupBy('sales.order_code')
                    ->get();
            } elseif ($id === '1') {
                $sales = DB::table('orders')
                    ->selectRAW('orders.invoice_no ,GROUP_CONCAT(products.p_bname SEPARATOR "," ) AS name,  SUM(sales.price * ( 100.0 - products.p_discount ) / 100.0) AS price , sales.created_at')
                    ->join('sales', 'sales.order_code', '=', 'orders.order_code')
                    ->join('products', 'products.p_id', '=', 'sales.product_id')
                    ->groupBy('sales.order_code')
                    ->whereRaw('sales.created_at between date_sub(now(),INTERVAL 1 WEEK) and now()')
                    ->get();
            } elseif ($id === '2') {
                $sales = DB::table('orders')
                    ->selectRAW('orders.invoice_no ,GROUP_CONCAT(products.p_bname SEPARATOR "," ) AS name,  SUM(sales.price * ( 100.0 - products.p_discount ) / 100.0) AS price , sales.created_at')
                    ->join('sales', 'sales.order_code', '=', 'orders.order_code')
                    ->join('products', 'products.p_id', '=', 'sales.product_id')
                    ->groupBy('sales.order_code')
                    ->whereRaw('sales.created_at between date_sub(now(),INTERVAL 1 MONTH) and now()')
                    ->get();
            } elseif ($id === '3') {
                $sales = DB::table('orders')
                    ->selectRAW('orders.invoice_no ,GROUP_CONCAT(products.p_bname SEPARATOR "," ) AS name,  SUM(sales.price * ( 100.0 - products.p_discount ) / 100.0) AS price , sales.created_at')
                    ->join('sales', 'sales.order_code', '=', 'orders.order_code')
                    ->join('products', 'products.p_id', '=', 'sales.product_id')
                    ->groupBy('sales.order_code')
                    ->whereRaw('sales.created_at between date_sub(now(),INTERVAL 6 MONTH) and now()')
                    ->get();
            } elseif ($id === '4') {
                $sales = DB::table('orders')
                    ->selectRAW('orders.invoice_no ,GROUP_CONCAT(products.p_bname SEPARATOR "," ) AS name,  SUM(sales.price * ( 100.0 - products.p_discount ) / 100.0) AS price , sales.created_at')
                    ->join('sales', 'sales.order_code', '=', 'orders.order_code')
                    ->join('products', 'products.p_id', '=', 'sales.product_id')
                    ->groupBy('sales.order_code')
                    ->whereRaw('sales.created_at between date_sub(now(),INTERVAL 1 YEAR) and now()')
                    ->get();
            }

            $pdf = PDF::loadView('sales.pdf', ['sales' => $sales]);
            return $pdf->download('sales.pdf');
        }
    }

    public function getInvoice($id)
    {
        $print = DB::table('sales')
            ->selectRAW('sales.quantity,orders.invoice_no,sales.info,products.p_id,products.p_discount,products.p_barcodeg,products.p_discount,sales.order_code,products.p_bname AS name, sales.price AS price,orders.created_at')
            ->join('products', 'products.p_id', '=', 'sales.product_id')
            ->join('orders', 'orders.order_code', '=', 'sales.order_code')
            ->where('sales.order_code', $id)
            ->get();
        return view('sales.invoice', ['print' => $print]);
    }

    public function autoCompleteProductSearch(Request $request){
        $product=Products::where('p_bname', 'like', $request->term.'%')
            ->get();
        if(!$product->isEmpty()){
            foreach ($product as $r){
                $json_product[]=array('label'=>$r->p_bname,'value'=>$r->p_id);
            }
        }else{
            $json_product[]='No Medicine Found';
        }

        echo json_encode($json_product);
    }

    public function get_data_of_selected_item(Request $request){


        $batch = Purchase_Detail::where('product_id',$request->product_id)->groupBy('batch_id')->get();
        $product=Products::where('p_id',$request->product_id)->first();
        $html = "";
        if ($batch->isEmpty()) {
            $html .="<option>"."No Product Purchased !"."</option>";
        }else{
            // Select option created for product
            $html .="<select name=\"batch_id[]\"   class=\"batch_id_1 my-form-control custom_input_m_t\" id=\"batch_id_1\" required=\"required\">";
            $html .= "<option>"."Select Batch"."</option>";
            foreach ($batch as $r) {
                $html .="<option value=".$r->batch_id.">".$r->batch_id."</option>";
            }
            $html .="</select>";
        }
        $data=array('p_price'=>$product->p_price,'unit'=>'PCS','batch'=>$html);

        echo json_encode($data);
    }

    public function get_product_by_batch_id(Request $request){
        $batch = Purchase_Detail::select('expire_date')->where('batch_id',$request->batch_id)->groupBy('batch_id')->first();
        $purchase_by_batch = Purchase_Detail::where('batch_id',$request->batch_id)->sum('quantity');
        $sale_by_batch = DB::table('sales_details')->where('batch_id',$request->batch_id)->sum('quantity');
        $avg = $purchase_by_batch - $sale_by_batch;
        $data=array('expire'=>$batch->expire_date,'avg'=>$avg);

        echo json_encode($data);
    }
}
