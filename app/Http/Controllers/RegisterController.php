<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    //
    public function sendOTP(Request $request)
    {
        $email = 'email';
        $otp = rand(1000, 9999); 
        
      
        Mail::to($email)->send(new OTPMail($otp));
        
        session(['otp' => $otp]);
    
        return $otp; 
    }


    public function storeotp(Request $request)
    {
    $data = $request->validate([
        'lastname' => 'required',
        'firstname' => 'required',
        'middlename' => 'required',
        'email' => 'required',
        'password' => 'required',
        'usertype' => 'nullable',
        'otp' => 'required'
    ]);

   
    if ($request->input('otp') !== session('otp')) {
        return redirect()->back()->withErrors(['otp' => 'Invalid OTP']);
    }

  
    $data['password'] = Hash::make($data['password']);
    $newUser = Users::create($data);

    
    session()->forget('otp');

    return redirect(route('login'))->with('success', 'User created successfully. Please log in.');
}
    
}
