<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required | email | min:5',
            'password' => 'required | min:8 | max:20'
        ]);

        $user = User::where('email', '=', $request->email)                        
                        ->whereIn('role_id', [9, 5])
                        ->where('user_status', '=', '1')
                        ->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put(['userId' => $user->id, 'userEmail' => $user->email, 'roleId' => $user->role_id]);
               
                return redirect('dashboard');
            } else {
                return back()->with('fail', 'Invalid password');
            }
        } else {
            return back()->with('fail', 'No account found for this email');
        }
    }

    public function logout(){
        if(session()->has('userId')){
            session()->flush();
            return redirect('/');
        }
    }
}
