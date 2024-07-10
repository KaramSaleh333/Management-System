<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderby('id' , 'DESC')->get();
        return view('transactions.show' , compact('transactions'));
    }

    public function search(Request $request)
    {
        $transactions = [];
        if($request->search == 'option1' and $request->name){
            $transactions = Transaction::where('agent_name' ,'like' ,"%$request->name%")->orderby('id' , 'DESC')->get();
        }elseif($request->search == 'option2' and $request->type){
            $transactions = Transaction::where('transaction_name' ,'like' ,"%$request->type%")->orderby('id' , 'DESC')->get();
        }elseif($request->search == 'option3' and $request->created_at){
            $all_transactions = Transaction::orderby('id' , 'DESC')->get();
            foreach($all_transactions as $transaction){
                if(date_format($transaction->created_at , 'Y-m-d') == $request->created_at){
                    $transactions [] = $transaction;
                }
            }
        }else{
            return redirect()->route('transaction.index');
        }
        return view('transactions.show' , compact('transactions'));
    }
    public function deleted_bill($bill)
    {
        $bill  = json_decode(base64_decode($bill));
        return view('transactions.deleted_bill' , compact('bill'));
    }
}
