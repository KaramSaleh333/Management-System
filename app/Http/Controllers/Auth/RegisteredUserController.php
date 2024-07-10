<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255' ,'unique:'.User::class],
            'role' => ['required' , 'string' , 'max:255'],
            'salary' => ['required' , 'numeric'],
            'telephone' => ['required' , 'numeric'],
            'city' => ['required' , 'string' , 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],[
            'salary.numeric' => 'برجاء ادخال ارقام',
            'telephone.numeric' => 'برجاء ادخال ارقام',
            'password.confirmed' => 'تأكيد الباسورد خطأ'
        ]);

        $role = $request->role;
        if($request->role == 'other'){
            $request->validate([
                'other_role' =>['required' , 'string' , 'max:255' , Rule::notIn(['المالك'])]
            ],[
                'other_role.required'=> 'يجب ادخال المسمي الوظيفي',
                'other_role.not_in'=> "لا يمكنك تسجيل بيانات مالك اخر",
            ]);
            $role = $request->other_role;
        }

        $user = User::create([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'telephone'=> $request->telephone,
            'city'=> $request->city,
            'role' => $role,
            'salary' =>$request->salary,
            'password' => Hash::make($request->password),
        ]);
        
        $diff ['قبل'] = [];
        $diff ['بعد'] = ["اضافة بيانات الموظف => $user->name"];
        
        Transaction::create([
            'agent_id'=>auth()->user()->id,
            'agent_name'=>auth()->user()->name,
            'transaction_name'=>'اضافة بيانات موظف',
            'transaction_details'=>json_encode($diff),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect(route('employee.index', absolute: false));
    }
}
