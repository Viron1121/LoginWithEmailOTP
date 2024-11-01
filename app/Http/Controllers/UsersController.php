<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Roles;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    

    public function login(){
        return view('CreateAccount/login');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login')->with('success', 'You have been successfully logged out.');
    }

    

    public function register(){
        return view('CreateAccount/register');
    }

    public function users(){
        $Users = Users::all();
        return view('CreateAccount/users', ['Users' => $Users]);
    }

    public function edit(Users $editusers, Roles $editroles){
        $Roles = Roles::all();
        return view('Action/editusers', ['Users' => $editusers, 'Roles' => $Roles]);
    }

    public function index(){
      
        $Users = Users::all();

        $totalUsers = Users::count();
      
        return view('CreateAccount/index', ['totalUsers' => $totalUsers]);
    }

    public function admin(){
        $Roles = Roles::all();
        $Users = Users::all();

        $totalUsers = Users::count();
        $totalRoles = Roles::count();
       
        return view('CreateAccount/admin', ['Roles' => $Roles, 'Users' => $Users, 'totalUsers' => $totalUsers, 'totalRoles' => $totalRoles]);
    }

   



     //update data on database
     public function update(Users $updateusers, Request $request ){
        $data = $request->validate([
                 'lastname' => 'required',
                 'firstname' => 'required',
                 'middlename' => 'required',
                 'email' => 'required',
                 'password' => 'required',
                 'usertype' => 'nullable'
           
        ]);
        $data['password'] = Hash::make($data['password']);
        $updateusers->update($data);
 
        return redirect(route('users'))->with('success', 'User updated successfully');
     }

       //delete data on database
    public function delete(Users $delete){
        $delete->delete();
        return redirect(route('users'))->with('success', 'User deleted successfully');
      
     }

     

    //input data on database
    public function store(Request $request){
    
        $data = $request->validate([
                 'lastname' => 'required',
                 'firstname' => 'required',
                 'middlename' => 'required',
                 'email' => 'required',
                 'password' => 'required',
                 'usertype' => 'nullable'
        ]);
        $data['password'] = Hash::make($data['password']);
        $newProduct = Users::create($data);
        
        return redirect(route('login'));
     }

     //addrole
     public function addrole(Request $request){
        $data = $request->validate([
            'rolename' => 'required'
        ]);
    
        $newRole = Roles::create($data);
    
        return redirect(route('/login'));
    }
     
    //sending otp
    public function sendOTP(Request $request)
    {
        $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirmpassword' => 'required',
            'usertype' => 'required',
        ]);
    
        $existingUser = Users::where('email', $request->input('email'))->first();
    
        if ($request->password == $request->confirmpassword) {
            $password = $request['password'] = Hash::make($request['password']);
            $rand = rand(1000, 9999);
            $email = $request->input('email');
    
            // Check if email already exists in the database
            if ($existingUser) {
               
                return redirect()->back()->withInput()->withErrors([
                    'error' => 'Email already exists. Please use a different email address.',
                ]);
            }
    
            // Session the attributes only when the passwords match and email is unique
            $request->session()->put('otp_attributes', [
                'lastname' => $request->input('lastname'),
                'firstname' => $request->input('firstname'),
                'middlename' => $request->input('middlename'),
                'email' => $email,
                'password' =>  $password,
                'usertype' => $request->input('usertype'),
                'otp' => $rand,
            ]);
    
            // Send OTP email
            Mail::to($email)->send(new OTPMail($rand));
            
            return redirect('/otp');
        } else {
            $sound = 'notmatched';
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Password not matched',
            ]);
        }
    }


 //Verify otp
 public function verifyotp()
    {
       
       
        return view('otp');
    }


    public function verifysendotp(Request $request)
    {
        
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $userInputOtp = $request->input('otp');
        $storedOtp = $request->session()->get('otp_attributes.otp');

        // Check if OTP matches
        if ($userInputOtp == $storedOtp) {
          
            $userAttributes = $request->session()->get('otp_attributes', []);

          
            Users::create($userAttributes);

            
            $request->session()->forget('otp_attributes');

            return redirect()->route('login')->with('message', 'Account has been added successfully');
        }

        return view('otp', ['error' => 'Invalid OTP']);
    }
    
}

    
     


     

