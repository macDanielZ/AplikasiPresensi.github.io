<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{   
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    public function login(){
        if(Auth::check()){
            // dd('asd');
            $user = auth()->user();
            $jabatan = $user->jabatan;
            if($jabatan == 'Karyawan'){
                return redirect()->route('k_presensi');
            } elseif ($jabatan == 'Admin'){
                return redirect()->route('admin.index');
            } elseif ($jabatan == 'Manajemen'){
                return redirect()->route('manajemen');

            }
        }
        return view('login');
    }

    public function autentikasi(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
           
            $user = Auth::user();
            $jabatan = $user->jabatan;
            if($jabatan == 'Karyawan'){
                return redirect()->route('k_presensi');
            } elseif ($jabatan == 'Admin'){
                return redirect()->route('admin.index');
            } elseif ($jabatan == 'Manajemen') {
                return redirect()->route('manajemen');
            }
        } else {
           
            return view('login')->with('error', 'Password / Username Salah');
        }
    }
}
