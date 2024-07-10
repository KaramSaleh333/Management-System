<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::orderby('salary' , 'DESC')->get();
        return view('employees.show' , compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $employees = [];
        if($request->search == 'option1' and $request->name){
            $employees = User::where('name' ,'like' ,"%$request->name%")->orderby('salary' , 'DESC')->get();
        }elseif($request->search == 'option2' and $request->user_name){
            $employees = User::where('user_name' ,'like' ,"%$request->user_name%")->orderby('salary' , 'DESC')->get();
        }elseif($request->search == 'option3' and $request->role){
            $employees = User::where('role' ,'like' ,"%$request->role%")->orderby('salary' , 'DESC')->get();
        }elseif($request->search == 'option4' and $request->salary){
            $employees = User::where('salary' ,'>=' ,$request->salary)->orderby('salary' , 'ASC')->get();
        }elseif($request->search == 'option5' and $request->created_at){
            $all_employees = User::orderby('salary' , 'DESC')->get();
            foreach($all_employees as $employee){
                if(date_format($employee->created_at , 'Y-m-d') == $request->created_at){
                    $employees [] = $employee;
                }
            }
        }elseif($request->search == 'option6' and $request->city){
            $employees = User::where('city' ,'like' ,"%$request->city%")->orderby('salary' , 'DESC')->get();
        }elseif($request->search == 'option7' and $request->telephone){
            $employees = User::where('telephone' ,'like' ,"%$request->telephone%")->orderby('salary' , 'DESC')->get();
        }else{
            return redirect()->route('employee.index');
        }

        return view('employees.show' , compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = User::find($id);
        return view('employees.edit' , compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required' , 'string' , 'max:255'],
            'salary' => ['required' , 'numeric'],
            'telephone' => ['required' , 'numeric'],
            'city' => ['required' , 'string' , 'max:255'],
        ],[
            'salary.numeric' => 'برجاء ادخال ارقام',
            'telephone.numeric' => 'برجاء ادخال ارقام'
       ]);
       $role = $request->role;
       if($request->role == 'other'){
           $request->validate([
               'other_role' =>['required' , 'string' , 'max:255' , Rule::notIn(['المالك'])]
           ],[
               'other_role.required'=> 'يجب ادخال المسمي الوظيفي',
               'other_role.not_in'=> "لا يمكنك تسجيل بيانات مالك اخر"
           ]);
           $role = $request->other_role;
       }
        $user = User::find($id);
        $arr = ['قبل'=>(array)json_decode($user)];
        $user->update([
            'name' => $request->name,
            'telephone'=> $request->telephone,
            'city'=> $request->city,
            'role' => $role,
            'salary' =>$request->salary,
        ]);

        $arr['بعد'] = (array)json_decode($user) ;
        $diff ['name'] = $user->name;
        $diff ['قبل'] = array_diff_assoc($arr['قبل'] , $arr['بعد']);
        $diff ['بعد'] = array_diff_assoc($arr['بعد'] , $arr['قبل']);

        Transaction::create([
            'agent_id'=>auth()->user()->id,
            'agent_name'=>auth()->user()->name,
            'transaction_name'=>'تعديل علي بيانات الموظف',
            'transaction_details'=>json_encode($diff),
        ]);

        return redirect(route('employee.index', absolute: false));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $diff ['قبل'] = [];
        $diff ['بعد'] = ["حذف بيانات الموظف => $user->name"];
        Transaction::create([
            'agent_id'=>auth()->user()->id,
            'agent_name'=>auth()->user()->name,
            'transaction_name'=>'حذف بيانات موظف',
            'transaction_details'=>json_encode($diff),
        ]);
        $user->delete();
        return redirect()->route('employee.index');
    }
}
