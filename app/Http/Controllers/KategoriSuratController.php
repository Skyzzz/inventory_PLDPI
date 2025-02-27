<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KategoriSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoriSurat = KategoriSurat::all();
        $thn = Carbon::now()->year;
        $var = 'KS';
        $kts = KategoriSurat::count();
        if ($kts == 0) {
            $awal = 10001;
            $kode_ks = $var.$thn.$awal;
        } else {
            $last = KategoriSurat::all()->last();
            $awal = (int)substr($last->kode_kategori_surat, -5) + 1;
            $kode_ks = $var.$thn.$awal;
        }
        return view('kategori.dftKategoriSurat', compact('kategoriSurat', 'kode_ks'));
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
            'kode_kategori_surat' => 'required',
            'kategori_surat' => 'required'
        ]);
    
        // Cek apakah kategori surat sudah ada di database
        $existingKategoriSurat = KategoriSurat::where('kategori_surat', $request->kategori_surat)->first();
    
        if ($existingKategoriSurat) {
            alert()->error('Gagal', 'Kategori Surat sudah terdaftar dalam sistem.');
            return back()->withInput();
        }
    
        // Simpan kategori surat jika belum ada
        $kategoriSurat = new KategoriSurat();
        $kategoriSurat->kode_kategori_surat = $request->kode_kategori_surat;
        $kategoriSurat->kategori_surat = $request->kategori_surat;
        $kategoriSurat->save();
    
        alert()->success('Berhasil', 'Kategori Surat Baru Berhasil Ditambahkan.');
        return back();
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
        $validate = $request->validate(['kategori_surat' => 'required']);
        KategoriSurat::where('id_kategori_surat', $id)->update($validate);
        alert()->success('Berhasil', 'Kategori Surat Berhasil Diedit.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KategoriSurat::where('id_kategori_surat', $id)->delete();
        alert()->success('Berhasil', 'Kategori Surat Berhasil Dihapus.');
        return back();
    }
}
