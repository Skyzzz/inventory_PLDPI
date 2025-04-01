<?php

namespace App\Http\Controllers;

use App\Models\KategoriMedia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class KategoriMediaController extends Controller
{
    public function index()
    {
        $kategoriMedia = KategoriMedia::all();
        $thn = Carbon::now()->year;
        $var = 'KM';
        $kts = KategoriMedia::count();
        if ($kts == 0) {
            $awal = 10001;
            $kode_km = $var . $thn . $awal;
        } else {
            $last = KategoriMedia::latest()->first();
            $awal = (int)substr($last->kode_kategori_media, -5) + 1;
            $kode_km = $var . $thn . $awal;
        }
        return view('kategori.dftKategoriMedia', compact('kategoriMedia', 'kode_km'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kategori_media' => 'required',
            'kategori_media' => 'required|max:50|unique:kategori_media,kategori_media'
        ], [
            'kode_kategori_media.required' => 'Kode kategori media wajib diisi.',
            'kategori_media.required' => 'Nama kategori media wajib diisi.',
            'kategori_media.unique' => 'Kategori media sudah ada!',
            'kategori_media.max' => 'Nama kategori media maksimal 50 karakter.'
        ]);

        try {
            KategoriMedia::create($request->only(['kode_kategori_media', 'kategori_media']));
            return redirect()->back()->with('success', 'Kategori Media Baru Berhasil Ditambahkan.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan kategori media. Coba lagi!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_media' => 'required|max:50|unique:kategori_media,kategori_media,' . $id . ',id_kategori_media'
        ], [
            'kategori_media.required' => 'Nama kategori media wajib diisi.',
            'kategori_media.unique' => 'Kategori media sudah ada!',
            'kategori_media.max' => 'Nama kategori media maksimal 50 karakter.'
        ]);

        try {
            KategoriMedia::where('id_kategori_media', $id)->update(['kategori_media' => $request->kategori_media]);
            return redirect()->back()->with('success', 'Kategori Media berhasil diperbarui.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate kategori media.');
        }
    }

    public function destroy($id)
    {
        try {
            KategoriMedia::where('id_kategori_media', $id)->delete();
            return redirect()->back()->with('success', 'Kategori Media Berhasil Dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Kategori Media tidak dapat dihapus karena masih digunakan di tabel lain.');
        }
    }
}
