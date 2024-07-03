<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;

use Session;
use Alert;

class AdminController extends Controller
{
    public function login_aksi(Request $request){

        // validasi inputan
        $validasiInput = $request->validate([
            'username' => 'required|string',
            'password' => 'required|min:5'
        ]);

        // masukan array data validasi
        $cek = array(
            'username'=>$validasiInput['username'],
            'password'=>sha1($validasiInput['password'])
        );

        // cek total
        $cekUser = user::where($cek)->count();
        if($cekUser == NULL){
            Session::flush();
            Alert::warning('ops!', 'Username Atau Password Anda Salah');
            return redirect()->to('/');
        }
        else{
            $getData = user::where($cek)->first();
            Session::push('cek', 1);
            Session::put('id', $getData['id']);
            Session::put('username', $getData['username']);

            Alert::success('Hore!','Anda berhasil login');
            return redirect()->to('/admin');
        }
    }

    public function logout(){
        Session::flush();
        Alert::success('Hore!',"Anda berhasil logout");
        return redirect()->to('/');
    }

    // Admin

    public function Dashboard(){
        return view('admin.dashboard');
    }

}
