<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use QRcode;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class ProductsController extends Controller
{
    public function __construct()
    {
        include ('phpqrcode/qrlib.php');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();
        return view('products.show' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|max:255',
            'image'=> 'required',
            'amount'=> 'required|numeric|min:1',
            'price'=> 'required|numeric|min:1',
        ],[
            'price.numeric'=>'يجب ادخال ارقام فقط'
        ]);


        $image_name = $request->image->getClientOriginalName();
        $image_path = $request->image->storeAs('products' , $image_name , 'only_public');
        $qr_image_path = $request->image->storeAs('qrcode' , $image_name , 'only_public');


        $product = Products::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'amount'=>$request->amount,
            'image_path'=>$image_path ,
            'qr_image_path'=>$qr_image_path,
        ]);

        QRcode::png((string) $product->id , "images/qrcode/$image_name");

        $diff ['قبل'] = [];
        $diff ['بعد'] = ["اضافة بيانات المنتج => $product->id"];

        Transaction::create([
            'agent_id'=>auth()->user()->id,
            'agent_name'=>auth()->user()->name,
            'transaction_name'=>'اضافة بيانات منتج',
            'transaction_details'=>json_encode($diff),
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Products::find($id);
        return view('products.print' , compact('product'));
    }

    public function search(Request $request)
    {
        $products = [];
        if($request->search == 'option1' and $request->id){
            $products = Products::where('id' ,$request->id)->get();
        }elseif($request->search == 'option2' and $request->name){
            $products = Products::where('name' ,'like' ,"%$request->name%")->orderby('id' , 'DESC')->get();
        }elseif($request->search == 'option3' and $request->price){
            $products = Products::where('price' ,$request->price)->orderby('id' , 'DESC')->get();
        }elseif($request->search == 'option4' and $request->amount){
            $products = Products::where('amount' ,'>=' ,$request->amount)->get();
        }else{
            return redirect()->route('products.index');
        }

        return view('products.show' , compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if(auth()->user()->role != 'المالك' && auth()->user()->role != 'محاسب' ){
            return redirect()->back();
        }
        $product = Products::find($id);
        return view("products.edit" , compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    {

        $request->validate([
            'name'=> 'required|max:255',
            'amount'=> 'required|numeric|min:1',
            'price'=> 'required|numeric|min:1',
        ],[
            'price.numeric' => 'يجب ادخال ارقام فقط'
        ]);

        $product = Products::find($id);
        $arr = ['قبل'=>(array)json_decode($product)];
        $product->name = $request->name;
        $product->amount = $request->amount;
        $product->price = $request->price;
        if($request->image){
            $image_name = $request->image->getClientOriginalName();
            $image_path = $request->image->storeAs('products' , $image_name , 'only_public');
            File::delete(public_path('images/'.$product->image_path));
            $product->image_path = $image_path;
        }
        $product->save();

        $arr['بعد'] = (array)json_decode($product) ;
        $diff ['name'] = $product->id;
        $diff ['قبل'] = array_diff_assoc($arr['قبل'] , $arr['بعد']);
        $diff ['بعد'] = array_diff_assoc($arr['بعد'] , $arr['قبل']);

        Transaction::create([
            'agent_id'=>auth()->user()->id,
            'agent_name'=>auth()->user()->name,
            'transaction_name'=>'تعديل علي بيانات المنتج',
            'transaction_details'=>json_encode($diff),
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Products::find($id);

        $diff ['قبل'] = [];
        $diff ['بعد'] = ["حذف بيانات المنتج => $product->name"];
        Transaction::create([
            'agent_id'=>auth()->user()->id,
            'agent_name'=>auth()->user()->name,
            'transaction_name'=>'حذف بيانات منتج',
            'transaction_details'=>json_encode($diff),
        ]);

        Products::where('id' , $id)->delete();
        File::delete(public_path('images/'.$product->image_path));
        File::delete(public_path('images/'.$product->qr_image_path));
        return redirect()->route('products.index');
    }
}
