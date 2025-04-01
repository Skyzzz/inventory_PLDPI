<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class KategoriSuratController extends Controller
{
    /**
     * Menampilkan daftar kategori surat.
     */
    public function index()
    {
        $kategoriSurat = KategoriSurat::all();
        $thn = Carbon::now()->year;
        $var = 'KS';
        $kts = KategoriSurat::count();

        $kode_ks = ($kts == 0) 
            ? $var . $thn . '10001' 
            : $var . $thn . ((int)substr(KategoriSurat::latest()->first()->kode_kategori_surat, -5) + 1);

        return view('kategori.dftKategoriSurat', compact('kategoriSurat', 'kode_ks'));
    }

    /**
     * Menyimpan kategori surat baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_kategori_surat' => 'required|unique:kategori_surat,kode_kategori_surat',
            'kategori_surat' => 'required|max:50|unique:kategori_surat,kategori_surat'
        ], [
            'kode_kategori_surat.required' => 'Kode kategori surat wajib diisi.',
            'kategori_surat.required' => 'Nama kategori surat wajib diisi.',
            'kategori_surat.unique' => 'Kategori surat sudah terdaftar!',
            'kategori_surat.max' => 'Nama kategori surat maksimal 50 karakter.'
        ]);

        try {
            KategoriSurat::create($request->only(['kode_kategori_surat', 'kategori_surat']));
            return back()->with('success', 'Kategori Surat Baru Berhasil Ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan kategori surat. Coba lagi!');
        }
    }

    /**
     * Mengupdate kategori surat yang ada.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_surat' => 'required|max:50|unique:kategori_surat,kategori_surat,' . $id . ',id_kategori_surat'
        ], [
            'kategori_surat.required' => 'Nama kategori surat wajib diisi.',
            'kategori_surat.unique' => 'Kategori surat sudah ada!',
            'kategori_surat.max' => 'Nama kategori surat maksimal 50 karakter.'
        ]);

        try {
            KategoriSurat::where('id_kategori_surat', $id)->update($request->only('kategori_surat'));
            return back()->with('success', 'Kategori Surat Berhasil Diedit.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengedit kategori surat. Coba lagi!');
        }
    }

    /**
     * Menghapus kategori surat.
     */
    public function destroy($id)
    {
        try {
            KategoriSurat::where('id_kategori_surat', $id)->delete();
            return back()->with('success', 'Kategori Surat Berhasil Dihapus.');
        } catch (QueryException $e) {
            return back()->with('error', 'Kategori Surat tidak dapat dihapus karena masih digunakan di tabel lain.');
        }
    }
}
