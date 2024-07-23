<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_berkala;
use App\Models\data_pegawai;

use Alert;

class BerkalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

          // confirm delete
          $title = 'Hapus Data!';
          $text = "Apakah Anda Yakin?";
          confirmDelete($title, $text);


          $data = data_berkala::with('DPegawai')->get();
          $dataPegawai = data_pegawai::all();
          return view('admin.berkala.index', compact('data','dataPegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nip' => 'required',
            'jabatan' => 'required|string',
            'berkalaakhir' => 'required|date',
            'berkaladatang' => 'required|date',
            'ket' => '',
        ],
        [
            'nip.required'=> 'NIP Harus Diisi!!',
            'jabatan.required'=> 'Jabatan Harus Diisi!!',
            'berkalaakhir.required'=> 'Berkala Akhir Harus Diisi!!',
            'berkaladatang.required'=> 'Berkala Datang Harus Diisi!!',
        ]);

        $save = data_berkala::create($validasi);
        if($save == true){
            Alert::success('Data berhasil Ditambahkan');
            return redirect()->route('berkala.index');
        }
        else{
            Alert::error('Data Gagal Ditambahkan');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = data_berkala::findorfail($id);
        $validasi = $request->validate([
            'jabatan' => 'required|string',
            'berkalaakhir' => 'required|date',
            'berkaladatang' => 'required|date',
            'ket' => '',
        ],
        [
            'nip.required'=> 'NIP Harus Diisi!!',
            'jabatan.required'=> 'Jabatan Harus Diisi!!',
            'berkalaakhir.required'=> 'Berkala Akhir Harus Diisi!!',
            'berkaladatang.required'=> 'Berkala Datang Harus Diisi!!',
        ]);

        $ubah = $data->update($validasi);
        if($ubah == true){
            Alert::success('Data berhasil Diubah');
            return redirect()->route('berkala.index');
        }
        else{
            Alert::error('Data Gagal Diubah');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $getID = data_berkala::findorfail($id);
        $hps = $getID->delete();
        if($hps == true){
            Alert::success('Data berhasil Dihapus');
            return redirect()->route('berkala.index');
        }
        else{
            Alert::error('Data Gagal Dihapus');
            return redirect()->back();
        }
    }
}
