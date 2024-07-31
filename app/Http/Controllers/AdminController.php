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

    public function IndexPassword(){
        return view('admin.UbahPassword.edit');
    }
    public function UbahPassword(Request $request){
        $validasi = $request->validate([
            'passwordLama' => 'required|min:5',
            'passwordBaru' => 'required|min:5|required_with:konfirmasipassword|same:konfirmasipassword',
            'konfirmasipassword' => 'required|min:5'
        ],
        [
            'passwordLama.required'=> 'Password Lama Harus Diisi!!',
            'passwordBaru.required'=> 'Password Baru Harus Diisi!!',
            'konfirmasipassword.required'=> 'Konfirmasi Password Harus Diisi!!',
            'passwordLama.min'=> 'minimal 5 Angka',
            'passwordBaru.min'=> 'minimal 5 Angka',
            'konfirmasipassword.min'=> 'minimal 5 Angka',
            'passwordBaru.required_with'=> 'Harus sama konfirmasi Password',
            'passwordBaru.same'=> 'Harus sama konfirmasi Password'
        ]
        );

        // ambil sesi
        $id = session('id');

        // dari database
        $cekid = user::findorfail($id);
        $pass = $cekid->password;

        // ubah ke sha1 request passwordlama
        $hashpass = sha1($validasi['passwordLama']);
        if($pass == $hashpass){
            $update = $cekid->update([
                'password' => sha1($validasi['passwordBaru'])
            ]);
            if($update == true){
                session::flush();
                Alert::success('Password Berhasil Diubah');
                return redirect()->to('/');
            }
            else{
                Alert::error('Password Gagal Diubah');
                return redirect()->back();
            }
        }
        else{
            Alert::error('Password Lama Tidak Sama Dengan Record Database');
            return redirect()->back();
        }

        // $id = session('id');
        // $cekid = user::findorfail($id);
        // if($cek)
    }
}
