<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pegawai.dftPegawai', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $thn = Carbon::now()->year;
        $var = 'PW';
        $bms = Pegawai::count();
        if ($bms == 0) {
            $awal = 10001;
            $kode_pegawai = $var.$thn.$awal;
            // BM2021001
        } else {
           $last = Pegawai::all()->last();
           $awal = (int)substr($last->kode_pegawai, -5) + 1;
           $kode_pegawai = $var.$thn.$awal;
        }

        return view('pegawai.tbhPegawai', compact('kode_pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'email' => 'required|email'
        ]);
    
        // Cek apakah pegawai dengan email yang sama sudah ada
        $existingPegawai = Pegawai::where('email', $request->email)->first();
    
        if ($existingPegawai) {
            alert()->error('Gagal', 'Email sudah terdaftar dalam sistem.');
            return redirect()->back()->withInput();
        }
    
        // Simpan pegawai jika belum ada
        $pegawai = new Pegawai();
        $pegawai->kode_pegawai = $request->kode_pegawai;
        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->email = $request->email;
        $pegawai->save();
    
        alert()->success('Berhasil', 'Pegawai Baru Berhasil Ditambahkan.');
        return redirect('/pegawai');
    }
    

    public function konfir(Request $request, $id)
    {
        $request->validate([
            'id_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'jabatan' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);
        // dd($request->all());

        $pegawai = new User;
        $pegawai->nama = $request->nama_pegawai;
        $pegawai->email = $request->email;
        $pegawai->password = bcrypt($request->password);
        $pegawai->role = $request->jabatan;
        $pegawai->save();

        alert()->success('Berhasil','Role Pegawai Berhasil Diperbaharui.');
        return redirect('/pegawai');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->get();
        // dd($pegawai);
        return view('pegawai.edtPegawai', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data_p = Pegawai::where('id_pegawai', $id)->first();
        $rules = [
            'kode_pegawai' => 'required',
            'nama_pegawai' => 'required',
        ];

        if ($request->email != $data_p->email) {
           $rules['email'] = 'required|email:dns|unique:pegawai';
        }

        $pegawai = $request->validate($rules);

        Pegawai::where('id_pegawai', $id)->update($pegawai);
        alert()->success('Berhasil','Data Pegawai Berhasil Diupdate.');
        return redirect('/pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pegawai::where('id_pegawai', $id)->delete();
        alert()->success('Berhasil','Data Pegawai Berhasil Dihapus.');
        return back();
    }
}
