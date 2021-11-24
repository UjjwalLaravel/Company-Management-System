<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;

class LoginController extends Controller {

    public function login() {
       if(!session()->has('url.intended'))
    {
        session(['url.intended' => url()->previous()]);
    }
    return view('auth.login');  
    }

    public function user_login_in(Request $request) {
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->attempt(request(['email', 'password']))) {
            return redirect()->to('/');
        } else {
            return redirect()->back()->with('warning', 'invalid credential');
        }
    }

    public function check_login_user(Request $request) {



        $user = User::where('email', $request->em)->count();
        return $user;
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    public function signup() {
        return view('auth/signup');
    }

    public function signup_user(Request $request) {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'contact' => 'required|numeric',
//             'confirmmation_password' => 'required',
        ]);

        $values = array('name' => $request->name, 'email' => $request->email, 'contact' => $request->contact, 'password' => Hash::make($request->password));
        //DB::table('users')->insert($values);
        User::insert($values);
        return redirect()->to('/')->with('success','You have successfully singup please signin! ');
    }

    

}
