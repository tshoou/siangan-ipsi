<?php

namespace App\Http\Controllers;

use App\Models\Adkeu;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Sarpra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(){
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function loginSarpra(){
        return view('loginSarpra');
    }

    public function registerProcess(Request $request){
        // return $request;
        $isBem = $request->isBem == 1;
        $create = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama_lengkap,
            'password' => $request->password,
            'no_hp' => $request->no_telp,
            'email' => $request->email,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'BEM' => $isBem ? true : false
        ]);

        if($isBem){
            Adkeu::create([
                'nim' => $request->nim,
                'username' => $request->nim,
            ]);
        }

        Auth::login($create);

        if(Auth::user()->BEM){
            return redirect()->route('riwayat.index');
        }

        return redirect()->route('home');
    }

    public function loginProcess(Request $request){
        $user = Mahasiswa::where('nim', $request->nim)->where('password', $request->password)->first();

        if($user){
            Auth::login($user);
            if (Auth::user()->BEM) {
                return redirect()->route('riwayat.index');
            }
            return redirect()->route('home');
        } else {
            return redirect()->route('login');
        }
    }

    public function loginSarpraProcess(Request $request)
    {
        $user = Sarpra::where('username', $request->username)->where('password', $request->password)->first();

        if ($user) {
            Auth::guard('sarpra')->login($user);
            return redirect()->route('sarpra.riwayat.index');
        } else {
            return redirect()->route('loginSarpra');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
