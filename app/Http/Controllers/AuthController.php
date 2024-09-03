<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        $user = User::where('username', $credentials['username'])->first();

        if(!$user){
            Session::flash('status','gagal melakukan login');
            Session::flash('message', 'username tidak ditemukan');
            return redirect('/login');
        }
        if(!Hash::check($credentials['password'], $user->password)){
            Session::flash('status','gagal melakukan login');
            Session::flash('message', 'password tidak sesuai');
            return redirect('/login');
        }

        if (Auth::attempt($credentials)){
            if(Auth::user()->status != 'active'){
                Session::flash('status','gagal melakukan login');
                Session::flash('message', 'akun belum active');
                return redirect('/login');
            }
            $request->session()->regenerate();
            if(Auth::user()->role_id == '1'){
                return redirect()->route('dashboard');
            }
            if(Auth::user()->role_id == '3'){
                return redirect('/profile');
            }
        }
        Session::flash('status','failed');
        Session::flash('message', 'invalid');
        return redirect('/login');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
