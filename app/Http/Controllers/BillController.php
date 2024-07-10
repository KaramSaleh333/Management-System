<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Products;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\ViewServiceProvider;


class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $session = Session::get('invoice');
        return view('bills.index_page' , compact('session'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('bills.create' , compact('id'));
    }

    public function add_product(Request $request , $id)
    {
        $product = Products::find($id);

        $request->validate([
            'amount'=>"required|numeric|min:1.00|max:$product->amount"
        ] , [
            'amount.max'=>" لا يتوفر من المنتج الا $product->amount قطع",
        ]);

        if(! session()->get('invoice')){
            session()->put('invoice' , []);
        }

        $arr = session()->get('invoice') ;
        $arr ["product$product->id"] = ['id'=>$product->id ,'name'=>$product->name ,'price'=>$product->price ,'amount'=>$request->amount];
        session()->put('invoice' , $arr);


        return redirect()->route('Bill.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($total_price)
    {
        if(session()->get('invoice') == null){
            return redirect()->route('Bill.index');
        }
        $bill = Bill::create([
            'agent_name'=> auth()->user()->name,
            'agent_id'=> auth()->user()->id,
            'products_details'=> json_encode(session()->get('invoice')),
            'total_paid'=> $total_price,
        ]);

        foreach(session()->get('invoice') as $product){
            $pro = Products::find($product['id']);
            $pro->update([
                'amount'=>$pro->amount - $product['amount']
            ]);
        }
        session()->forget('invoice');

        $diff ['قبل'] = [];
        $diff ['بعد'] = ["انشاء فاتورة جديد => $bill->id"];

        Transaction::create([
            'agent_id'=>auth()->user()->id,
            'agent_name'=>auth()->user()->name,
            'transaction_name'=>'انشاء فاتورة جديدة',
            'transaction_details'=>json_encode($diff),
        ]);

        return redirect()->route('Bill.show' , $bill->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bill = Bill::find($id);
        return view('bills.print' , compact('bill'));
    }
    public function search(Request $request)
    {
        $bills = [];
        if($request->search == 'option1' and $request->agent_name){
            $bills = Bill::where('agent_name' ,'like' ,"%$request->agent_name%")->orderby('id' , 'DESC')->get();
        }elseif($request->search == 'option2' and $request->id){
            $bills = Bill::where('id' ,$request->id)->get();
        }elseif($request->search == 'option3' and $request->created_at){
            $all_bills = Bill::orderby('id' , 'DESC')->get();
            foreach($all_bills as $bill){
                if(date_format($bill->created_at , 'Y-m-d') == $request->created_at){
                    $bills [] = $bill;
                }
            }
        }elseif($request->search == 'option4' and $request->total_paid){
            $bills = Bill::where('total_paid' ,$request->total_paid)->orderby('id' , 'DESC')->get();
        }else{
            return redirect()->route('show_all');
        }
        return view('bills.show' , compact('bills'));
    }

    public function show_all()
    {
        if(auth()->user()->role == 'المالك' || auth()->user()->role == 'محاسب'){
            $bills = Bill::orderBy('id', 'DESC')->get();
            $dayincome =Bill::whereDay('created_at', now()->day)->sum('total_paid');
            $monthincome =Bill::whereMonth('created_at', now()->month)->sum('total_paid');
            $yearincome =Bill::whereYear('created_at', now()->year)->sum('total_paid');
            return view('bills.show' , compact('bills' , 'dayincome' , 'monthincome' , 'yearincome'));
        }

        $bills = Bill::where('agent_id' , auth()->user()->id)->orderBy('id', 'DESC')->get();
        return view('bills.show' , compact('bills'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    public function delete_bill($id)
    {
        $bill = Bill::find($id);
        foreach(json_decode($bill->products_details) as $product){
            $product_db = Products::find($product->id);
            if($product_db){
                $product_db->update([
                    'amount'=>$product_db->amount + $product->amount
                ]);
            }

        }

        $diff ['قبل'] = [];
        $diff ['بعد'] = ["حذف بيانات الفاتورة => $bill->id"];
        Transaction::create([
            'agent_id'=>auth()->user()->id,
            'agent_name'=>auth()->user()->name,
            'transaction_name'=>'حذف بيانات فاتورة',
            'transaction_details'=>json_encode($diff),
            'bill_details'=>json_encode($bill)
        ]);
        $bill->delete();
        return redirect()->route('show_all');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($session_index)
    {
        $arr = [];
        foreach( session()->get('invoice') as $key=>$product){
            if($key == $session_index){
                continue;
            }
            $arr[$key] = $product;
        }

        session()->put('invoice' , $arr);
        return redirect()->route('Bill.index');
    }

    public function delete_all()
    {
        session()->forget('invoice');
        return redirect()->route('Bill.index');
    }
}
