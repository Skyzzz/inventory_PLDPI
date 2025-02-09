<?php

namespace App\Http\Controllers;

use App\Models\KategoriMedia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KategoriMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoriMedia = KategoriMedia::all();
        $thn = Carbon::now()->year;
        $var = 'KM';
        $kts = KategoriMedia::count();
        if ($kts == 0) {
            $awal = 10001;
            $kode_km = $var.$thn.$awal;
        } else {
            $last = KategoriMedia::all()->last();
            $awal = (int)substr($last->kode_kategori_media, -5) + 1;
            $kode_km = $var.$thn.$awal;
        }
        return view('kategori.dftKategoriMedia', compact('kategoriMedia', 'kode_km'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kategoriMedia = $request->validate([
            'kode_kategori_media' => 'required',
            'kategori_media' => 'required'
        ]);

        KategoriMedia::create($kategoriMedia);
        alert()->success('Berhasil','Kategori Media Baru Berhasil Ditambahkan.');
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
        $validate = $request->validate(['kategori_media' => 'required']);
        KategoriMedia::where('id_kategori_media', $id)->update($validate);
        alert()->success('Berhasil','Kategori Media Berhasil Diedit.');
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
        KategoriMedia::where('id_kategori_media', $id)->delete();
        alert()->success('Berhasil','Kategori Media Berhasil Dihapus.');
        return back();
    }
}
