<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Roles;

class UserRolesController extends Controller
{
    //
    //addrole
    public function addrole(Request $request){
        $data = $request->validate([
            'rolename' => 'required'
        ]);
    
        $newRole = Roles::create($data);
    
        return redirect(route('admin'));
    }

  
}
