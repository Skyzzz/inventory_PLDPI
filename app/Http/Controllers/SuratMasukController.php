<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suratMasuk = SuratMasuk::orderBy('tanggal_terima', 'desc')->get();
        return view('surat.surat masuk.dftSuratMasuk', compact('suratMasuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     public function create()
     {
         $thn = Carbon::now()->year;  // Ambil tahun saat ini
         $var = 'SM';  // Prefix untuk Surat Masuk
         $surat_count = SuratMasuk::whereYear('tanggal_terima', Carbon::now()->year)
                                   ->whereMonth('tanggal_terima', Carbon::now()->month)
                                   ->count();  // Hitung jumlah surat yang diterima di bulan dan tahun ini
     
         // Jika belum ada surat pada bulan dan tahun ini, mulai dengan nomor urut 001
         if ($surat_count == 0) {
             $awal = 1;
             $kode_surat = $var . $thn . str_pad($awal, 3, '0', STR_PAD_LEFT);  // Format SMYYYYMM001
         } else {
             // Ambil surat terakhir untuk bulan dan tahun ini
             $last = SuratMasuk::whereYear('tanggal_terima', Carbon::now()->year)
                               ->whereMonth('tanggal_terima', Carbon::now()->month)
                               ->orderByDesc('id_surat')
                               ->first();
             $awal = (int)substr($last->id_surat, -3) + 1;  // Ambil urutan dari 3 digit terakhir
             $kode_surat = $var . $thn . str_pad($awal, 3, '0', STR_PAD_LEFT);  // Format SMYYYYMMxxx
         }
     
         return view('surat.surat masuk.tbhSuratMasuk', compact('kode_surat'));
     }
     
     public function store(Request $request)
     {
         $request->validate([
             'nomor_surat' => 'required|string|max:255',
             'tanggal_surat' => 'required|date',
             'tanggal_terima' => 'required|date',
             'pengirim' => 'required|string|max:255',
             'perihal' => 'required|string|max:255',
             'kategori' => 'nullable|string|max:255',
             'sifat' => 'nullable|string|max:50',
             'file_surat' => 'nullable|file|mimes:pdf|max:10240',
             'keterangan' => 'nullable|string',
         ]);
     
         $thn = Carbon::now()->year;
         $var = 'SM';  // Kode tetap untuk Surat Masuk
         $tahun_bulan = Carbon::now()->format('Ym');  // Tahun dan bulan dalam format YYYYMM
         $nomor_urut = SuratMasuk::where('id_surat', 'LIKE', $var . $tahun_bulan . '%')->count() + 1;  // Hitung nomor urut berdasarkan bulan aktif
         $nomor_urut_padded = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);  // Tambahkan leading zero
     
         $kode_surat = $var . $tahun_bulan . $nomor_urut_padded;  // Format SMYYYYMMxxx
     
         // Cek apakah ada file yang diupload
         $filePath = null;
         if ($request->hasFile('file_surat')) {
             $filePath = $request->file('file_surat')->store('uploads/surat_masuk');
         }
     
         // Simpan data surat masuk ke database
         SuratMasuk::create([
             'id_surat' => $kode_surat,
             'nomor_surat' => $request->nomor_surat,
             'tanggal_surat' => $request->tanggal_surat,
             'tanggal_terima' => $request->tanggal_terima,
             'pengirim' => $request->pengirim,
             'perihal' => $request->perihal,
             'kategori' => $request->kategori,
             'sifat' => $request->sifat,
             'file_surat' => $filePath,
             'keterangan' => $request->keterangan,
         ]);
     
         alert()->success('Berhasil', 'Surat masuk berhasil ditambahkan.');
         return redirect('/surat_masuk');
     }
     
    

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $suratMasuk = SuratMasuk::findOrFail($id);
    //     return view('surat_masuk.show', compact('suratMasuk'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        return view('surat.surat masuk.edtSuratMasuk', compact('suratMasuk'));
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
            'tanggal_surat' => 'required|date',
            'tanggal_terima' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'sifat' => 'nullable|string|max:50',
            'file_surat' => 'nullable|file|mimes:pdf|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        // Mencari data surat masuk berdasarkan ID
        $suratMasuk = SuratMasuk::findOrFail($id);

        // Menyimpan path file yang lama sebelum diganti
        $filePath = $suratMasuk->file_surat;

        // Cek jika ada file baru yang di-upload
        if ($request->hasFile('file_surat')) {
            // Hapus file lama jika ada
            if ($filePath && Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            // Simpan file baru
            $filePath = $request->file('file_surat')->store('uploads/surat_masuk');
        }

        // Update data surat masuk
        $suratMasuk->update([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_terima' => $request->tanggal_terima,
            'pengirim' => $request->pengirim,
            'perihal' => $request->perihal,
            'kategori' => $request->kategori,
            'sifat' => $request->sifat,
            'file_surat' => $filePath,
            'keterangan' => $request->keterangan,
        ]);

        // Menampilkan pesan sukses dan mengalihkan ke halaman daftar surat masuk
        alert()->success('Berhasil', 'Surat masuk berhasil diperbarui.');
        return redirect('/surat_masuk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);

        if ($suratMasuk->file_surat && Storage::exists($suratMasuk->file_surat)) {
            Storage::delete($suratMasuk->file_surat);
        }

        $suratMasuk->delete();

        alert()->success('Berhasil', 'Surat masuk berhasil dihapus.');
        return back();
    }
}
