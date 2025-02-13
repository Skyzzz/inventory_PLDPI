<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\KategoriSurat;
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
    public function index_detail()
    {
        $suratMasuk = SuratMasuk::orderBy('tanggal_terima', 'desc')->get();
        return view('surat.surat masuk.dftSuratMasukDetail', compact('suratMasuk'));
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
                               ->orderByDesc('kode_surat')
                               ->first();
             $awal = (int)substr($last->kode_surat, -3) + 1;  // Ambil urutan dari 3 digit terakhir
             $kode_surat = $var . $thn . str_pad($awal, 3, '0', STR_PAD_LEFT);  // Format SMYYYYMMxxx
         }
     
         $kategori_surat = \App\Models\KategoriSurat::all();

         return view('surat.surat masuk.tbhSuratMasuk', compact('kode_surat', 'kategori_surat'));
     }
     
     public function store(Request $request)
     {
         $request->validate([
             'kategori_surat_id' => 'required|exists:kategori_surat,id_kategori_surat',
             'nomor_surat' => 'required|string|max:255',
             'tanggal_surat' => 'required|date',
             'tanggal_keluar' => 'required|date',
             'pengirim' => 'required|string|max:255',
             'perihal' => 'required|string|max:255',
             'kategori' => 'nullable|string|max:255',
             'file_surat' => 'nullable|file|mimes:pdf|max:10240',
             'keterangan' => 'nullable|string',
         ]);
     
         $prefix = 'SK'; // Kode tetap untuk Surat Keluar
         $tahun_bulan = Carbon::now()->format('Ym'); // Tahun dan bulan dalam format YYYYMM
     
         // Ambil kode surat terakhir untuk bulan yang sama
         $lastSurat = SuratKeluar::where('kode_surat', 'LIKE', $prefix . $tahun_bulan . '%')
             ->orderBy('kode_surat', 'desc')
             ->first();
     
         $nomor_urut = $lastSurat ? ((int) substr($lastSurat->kode_surat, -3)) + 1 : 1;
         $nomor_urut_padded = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
         $kode_surat = $prefix . $tahun_bulan . $nomor_urut_padded;
     
         // Cek apakah ada file yang diunggah
         $filePath = null;
         $nama_surat = $request->nama_surat; // Default dari input jika tidak ada file
     
         if ($request->hasFile('file_surat')) {
             $file = $request->file('file_surat');
             $nama_surat = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Ambil nama file tanpa ekstensi
     
             // Cek apakah nama surat sudah ada di database
             if (SuratKeluar::where('nama_surat', $nama_surat)->exists()) {
                 return redirect()->back()->withErrors([
                     'file_surat' => 'Surat dengan nama yang sama sudah ada. Harap gunakan nama file lain atau ubah nama surat sebelum mengunggah.',
                 ]);
             }
     
             // Simpan file ke storage
             $filePath = $file->store('uploads/surat_keluar', 'public');
         } else {
             // Jika tidak ada file, pastikan nama_surat tidak duplikat dari input manual
             if (SuratKeluar::where('nama_surat', $nama_surat)->exists()) {
                 return redirect()->back()->withErrors([
                     'nama_surat' => 'Nama surat sudah ada. Harap gunakan nama yang berbeda.',
                 ]);
             }
         }
     
         // Simpan data surat keluar ke database
         SuratKeluar::create([
             'kode_surat' => $kode_surat,
             'kategori_surat_id' => $request->kategori_surat_id,
             'nomor_surat' => $request->nomor_surat,
             'nama_surat' => $nama_surat, // Nama surat diambil dari file atau input manual
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
        $kategori_surat = \App\Models\KategoriSurat::all();
        return view('surat.surat masuk.edtSuratMasuk', compact('suratMasuk', 'kategori_surat'))->with([
            'selectedKategori' => $suratMasuk->kategori
        ]);
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
            'tanggal_terima' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
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
            'nama_surat' => $request->nama_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_terima' => $request->tanggal_terima,
            'pengirim' => $request->pengirim,
            'perihal' => $request->perihal,
            'kategori' => $request->kategori,
            'file_surat' => $filePath,
            'keterangan' => $request->keterangan,
        ]);

        // Menampilkan pesan sukses dan mengalihkan ke halaman daftar surat masuk
        alert()->success('Berhasil', 'Surat masuk berhasil diperbarui.');
        return redirect('/surat_masuk');
    }

    /**
     * Detail the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail (Request $request, $id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        $kategori_surat = \App\Models\KategoriSurat::all();
        return view('surat.surat masuk.detailSuratMasuk', compact('suratMasuk', 'kategori_surat'))->with([
            'selectedKategori' => $suratMasuk->kategori
        ]);
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

        if ($suratMasuk->file_surat) {
            // Hapus file dengan Storage Laravel
            Storage::disk('public')->delete($suratMasuk->file_surat);

            // Cek apakah file masih ada di `public/storage`
            $filePath = public_path('storage/' . $suratMasuk->file_surat);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }

        $suratMasuk->delete();

        alert()->success('Berhasil', 'Surat masuk berhasil dihapus.');
        return back();
    }

    public function streamSuratMasuk($id)
    {
        $surat_masuk = SuratMasuk::findOrFail($id);
        $path = storage_path("app/public/" . $surat_masuk->file_surat);

        return view('stream.streamViewSuratMasuk', compact('surat_masuk', 'path'));
    }
}
