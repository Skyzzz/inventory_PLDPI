<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suratKeluar = SuratKeluar::orderBy('tanggal_keluar', 'desc')->get();
        return view('surat.surat keluar.dftSuratKeluar', compact('suratKeluar'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     public function create()
     {
         $thn = Carbon::now()->year;  // Ambil tahun saat ini
         $var = 'SK';  // Prefix untuk Surat Keluar
         $surat_count = SuratKeluar::whereYear('tanggal_keluar', Carbon::now()->year)
                                   ->whereMonth('tanggal_keluar', Carbon::now()->month)
                                   ->count();  // Hitung jumlah surat yang dikeluar di bulan dan tahun ini
     
         // Jika belum ada surat pada bulan dan tahun ini, mulai dengan nomor urut 001
         if ($surat_count == 0) {
             $awal = 1;
             $kode_surat = $var . $thn . str_pad($awal, 3, '0', STR_PAD_LEFT);  // Format SMYYYYMM001
         } else {
             // Ambil surat terakhir untuk bulan dan tahun ini
             $last = SuratKeluar::whereYear('tanggal_keluar', Carbon::now()->year)
                               ->whereMonth('tanggal_keluar', Carbon::now()->month)
                               ->orderByDesc('kode_surat')
                               ->first();
             $awal = (int)substr($last->kode_surat, -3) + 1;  // Ambil urutan dari 3 digit terakhir
             $kode_surat = $var . $thn . str_pad($awal, 3, '0', STR_PAD_LEFT);  // Format SMYYYYMMxxx
         }
     
         $kategori_surat = \App\Models\KategoriSurat::all();

         return view('surat.surat keluar.tbhSuratKeluar', compact('kode_surat', 'kategori_surat')); 
     }

     public function store(Request $request)
     {
         $request->validate([
             'kategori_surat_id' => 'required|exists:kategori_surat,id_kategori_surat',
             'nomor_surat' => 'required|string|max:255',
             'nama_surat' => 'required|string|max:255',
             'tanggal_surat' => 'required|date',
             'tanggal_keluar' => 'required|date',
             'pengirim' => 'required|string|max:255',
             'perihal' => 'required|string|max:255',
             'kategori' => 'nullable|string|max:255',
             'file_surat' => 'nullable|file|mimes:pdf|max:10240',
             'keterangan' => 'nullable|string',
         ]);
     
         $prefix = 'SM'; // Kode tetap untuk Surat Keluar
         $tahun_bulan = Carbon::now()->format('Ym'); // Tahun dan bulan dalam format YYYYMM
     
         // Ambil kode surat terakhir untuk bulan yang sama
         $lastSurat = SuratKeluar::where('kode_surat', 'LIKE', $prefix . $tahun_bulan . '%')
             ->orderBy('kode_surat', 'desc')
             ->first();
     
         if ($lastSurat) {
             // Ambil angka terakhir dari kode_surat, lalu tambahkan 1
             $lastNumber = (int) substr($lastSurat->kode_surat, -3);
             $nomor_urut = $lastNumber + 1;
         } else {
             // Jika belum ada surat untuk bulan ini, mulai dari 1
             $nomor_urut = 1;
         }
     
         $nomor_urut_padded = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT); // Tambahkan leading zero
         $kode_surat = $prefix . $tahun_bulan . $nomor_urut_padded; // Format SMYYYYMMxxx
     
         // Cek apakah ada file yang diupload
         $filePath = null;
         if ($request->hasFile('file_surat')) {
             $filePath = $request->file('file_surat')->store('uploads/surat_keluar', 'public');
         }
     
         // Simpan data surat keluar ke database
         SuratKeluar::create([
             'kode_surat' => $kode_surat,
             'kategori_surat_id' => $request->kategori_surat_id,
             'nomor_surat' => $request->nomor_surat,
             'nama_surat' => $request->nama_surat,
             'tanggal_surat' => $request->tanggal_surat,
             'tanggal_keluar' => $request->tanggal_keluar,
             'pengirim' => $request->pengirim,
             'perihal' => $request->perihal,
             'kategori' => $request->kategori,
             'file_surat' => $filePath,
             'keterangan' => $request->keterangan,
             'diupload_oleh' => auth()->user()->id_user,
         ]);
     
         alert()->success('Berhasil', 'Surat keluar berhasil ditambahkan.');
         return redirect('/surat_keluar');
     }     

         /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);
        $kategori_surat = \App\Models\KategoriSurat::all();

        return view('surat.surat keluar.edtSuratKeluar', compact('suratKeluar', 'kategori_surat'));
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
        // Validasi request
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'nama_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tanggal_keluar' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'file_surat' => 'nullable|file|mimes:pdf|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        // Mencari data surat keluar berdasarkan ID
        $suratKeluar = SuratKeluar::findOrFail($id);

        // Menyimpan path file yang lama sebelum diganti
        $filePath = $suratKeluar->file_surat;

        // Cek jika ada file baru yang di-upload
        if ($request->hasFile('file_surat')) {
            // Hapus file lama jika ada
            if ($filePath && Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            // Simpan file baru
            $filePath = $request->file('file_surat')->store('uploads/surat_keluar');
        }

        // Update data surat keluar
        $suratKeluar->update([
            'nomor_surat' => $request->nomor_surat,
            'nama_surat' => $request->nama_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_keluar' => $request->tanggal_keluar,
            'pengirim' => $request->pengirim,
            'perihal' => $request->perihal,
            'kategori' => $request->kategori,
            'file_surat' => $filePath,
            'keterangan' => $request->keterangan,
        ]);

        // Menampilkan pesan sukses dan mengalihkan ke halaman daftar surat keluar
        alert()->success('Berhasil', 'Surat keluar berhasil diperbarui.');
        return redirect('/surat_keluar');
    }

         /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);

        if ($suratKeluar->file_surat && Storage::exists($suratKeluar->file_surat)) {
            Storage::delete($suratKeluar->file_surat);
        }

        $suratKeluar->delete();

        alert()->success('Berhasil', 'Surat keluar berhasil dihapus.');
        return back();
    }
}
