<?php namespace App\Http\Controllers;

use Alert;
use App\Models\data_pegawai;
use App\Models\data_pangkat;
use App\Models\data_berkala;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;

class PegawaiController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {

        // confirm delete
        $title='Hapus Data!';
        $text="Apakah Anda Yakin?";
        confirmDelete($title, $text);

        $data = data_pegawai::orderBy('nama', 'ASC')->get();

        if($data==null) {
            return view('admin.pegawai.index');
        }

        else {
            return view('admin.pegawai.index', compact('data'));
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });

        $validasi=$request->validate([ 'nip'=> 'required|string|max:25|without_spaces',
            'nama'=> 'required|string|max:100',
            'nohp'=> 'required|min:12|max:13',
            'alamat'=> 'required',
            'pasfoto'=> 'nullable|image|mimes:jpg,jpeg|max:1000'
            ],
            [
            'nip.without_spaces'=> 'NIP Tidak Perlu Spasi',
            'nip.required'=> 'NIP Harus Diisi!!',
            'nama.required'=> 'Nama Harus Diisi!!',
            'nohp.required'=> 'No HP Harus Diisi!!',
            'alamat.required'=> 'Alamat Harus Diisi!!',
            'nohp.min'=> 'No HP Minimal 12 Angka',
            'nohp.max'=> 'No HP Maksimal 13 Angka',
            'pasfoto.mimes'=> 'Foto harus Format Jpg atau Jpeg',
            'pasfoto.max'=> 'Foto Maksimal 1MB'
            ]);

        $cekNIP=data_pegawai::where('nip', $validasi['nip'])->count();
        if($cekNIP >=1) {
            return redirect()->back()->withErrors('Nip Sudah Ada');
        }

        else {
            if($request->file('pasfoto')) {
                // jika ada foto
                // $penamaan = time() . '-' . $request->nama . '.' . $request->pasfoto->extension();
                $penamaan=$request->file('pasfoto')->store('assets/foto',
                    'public'
                );

                $saveInputan=data_pegawai::create([ 'nip'=> $validasi['nip'],
                        'nama'=> $validasi['nama'],
                        'nohp'=> $validasi['nohp'],
                        'alamat'=> $validasi['alamat'],
                        'pasfoto'=> $penamaan]);

                if($saveInputan==true) {
                    Alert::success('Data Berhasil Ditambah');
                    return redirect()->route('pegawai.index');
                }

                else {
                    Alert::error('Gagal');
                    return redirect()->back();
                }

            }

            else {
                // jika tidak ada foto
                $saveInputan=data_pegawai::create([ 'nip'=> $validasi['nip'],
                        'nama'=> $validasi['nama'],
                        'nohp'=> $validasi['nohp'],
                        'alamat'=> $validasi['alamat'],
                        'pasfoto'=> NULL]);

                if($saveInputan==true) {
                    Alert::success('Data Berhasil Ditambah');
                    return redirect()->route('pegawai.index');
                }

                else {
                    Alert::error('Gagal');
                    return redirect()->back();
                }
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $data=data_pegawai::with('data_pangkat', 'data_berkala')->findorfail($id);

        return view('admin.pegawai.show', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {

        $getID=data_pegawai::findorfail($id);

        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });

        $validasi=$request->validate([ 'nip'=> 'required|string|max:25|without_spaces',
            'nama'=> 'required|string|max:100',
            'nohp'=> 'required|min:12|max:13',
            'alamat'=> 'required',
            'pasfoto'=> 'nullable|image|mimes:jpg,jpeg|max:1000'
            ],
            [
            'nip.without_spaces'=> 'NIP Tidak Perlu Spasi',
            'nip.required'=> 'NIP Harus Diisi!!',
            'nama.required'=> 'Nama Harus Diisi!!',
            'nohp.required'=> 'No HP Harus Diisi!!',
            'alamat.required'=> 'Alamat Harus Diisi!!',
            'nohp.min'=> 'No HP Minimal 12 Angka',
            'nohp.max'=> 'No HP Maksimal 13 Angka',
            'pasfoto.mimes'=> 'Foto harus Format Jpg atau Jpeg',
            'pasfoto.max'=> 'Foto Maksimal 1MB'
            ]);



        // if($request->file('pasfoto')) {
        if($request->file('pasfoto')) {
            // jika ada foto
            // $penamaan = time() . '-' . $request->nama . '.' . $request->pasfoto->extension();

            if($request->pasfotolama == null){
                $penamaan=$request->file('pasfoto')->store('assets/foto',
                'public'
            );

                $updateInputan=$getID->update([ 'nip'=> $validasi['nip'],
                'nama'=> $validasi['nama'],
                'nohp'=> $validasi['nohp'],
                'alamat'=> $validasi['alamat'],
                'pasfoto'=> $penamaan]);

                if($updateInputan==true) {
                    Alert::success('Data Berhasil Diubah');
                    return redirect()->route('pegawai.index');
                }
                else {
                    Alert::error('Gagal');
                    return redirect()->back();
                }
            }
            else{
                $hpsfotolama=Storage::disk('public')->delete($request->pasfotolama);
                $penamaan=$request->file('pasfoto')->store('assets/foto',
                    'public'
                );

                $updateInputan=$getID->update([ 'nip'=> $validasi['nip'],
                    'nama'=> $validasi['nama'],
                    'nohp'=> $validasi['nohp'],
                    'alamat'=> $validasi['alamat'],
                    'pasfoto'=> $penamaan]);

                if($updateInputan==true) {
                    Alert::success('Data Berhasil Diubah');
                    return redirect()->route('pegawai.index');
                }

                else {
                    Alert::error('Gagal');
                    return redirect()->back();
                }
            }

        }

        else {
            // jika tidak ada foto
            $updateInputan=$getID->update([ 'nip'=> $validasi['nip'],
                'nama'=> $validasi['nama'],
                'nohp'=> $validasi['nohp'],
                'alamat'=> $validasi['alamat'],
                ]);

            if($updateInputan==true) {
                Alert::success('Data Berhasil Diubah');
                return redirect()->route('pegawai.index');
            }

            else {
                Alert::error('Gagal');
                return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $getID = data_pegawai::findorfail($id);
        $nip = $getID->nip;
        $getPangkat = data_pangkat::where('nip', $nip);
        $getBerkala = data_berkala::where('nip', $nip);

        if($getID->pasfoto == NULL){
            $getPangkat->delete();
            $getBerkala->delete();
            $getID->delete();
        }
        else{
            $hpsfotolama=Storage::disk('public')->delete($getID->pasfoto);
            $getPangkat->delete();
            $getBerkala->delete();
            $getID->delete();
        }

        Alert::success('Data Berhasil Dihapus');
        return redirect()->back();
    }
}
