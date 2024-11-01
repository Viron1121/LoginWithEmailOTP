<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    //
    public function loginpost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');

     

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
          
           
            if ($user->userType === 'admin') {
                return redirect('/admin');
            } else {  
                return redirect('/index');
            }
        }
        
        return redirect()->back()->withInput()->withErrors([
            'login_error' => 'Invalid email or password'
        ]);

        
    }
    
}
