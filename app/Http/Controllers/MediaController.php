<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\KategoriMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Media::with('user')->get(); // Load relasi user
        return view('media.dftMedia', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $thn = Carbon::now()->year;
        $var = 'MD';
        $media_count = Media::count();

        if ($media_count == 0) {
            $awal = 10001;
            $kode_media = $var . $thn . $awal;
        } else {
            $last = Media::all()->last();
            $awal = (int)substr($last->kode_media, -5) + 1;
            $kode_media = $var . $thn . $awal;
        }

        $kategoriMedia = \App\Models\KategoriMedia::all(); // Ambil semua kategori dari tabel kategori_media

        return view('media.tbhMedia', compact('kode_media', 'kategoriMedia'));
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
            'file' => 'required|file|max:10240',
            'kategori_media_id' => 'required|exists:kategori_media,id_kategori_media',
            'kategori' => 'required|string',
        ]);
    
        $prefix = 'MD'; // Kode tetap untuk media
        $tahun_bulan = Carbon::now()->format('Ym'); // Tahun dan bulan dalam format YYYYMM
    
        // Ambil kode terakhir yang ada dalam database untuk bulan yang sama
        $lastMedia = Media::where('kode_media', 'LIKE', $prefix . $tahun_bulan . '%')
            ->orderBy('kode_media', 'desc')
            ->first();
    
        if ($lastMedia) {
            // Ambil angka terakhir dari kode_media, lalu tambahkan 1
            $lastNumber = (int) substr($lastMedia->kode_media, -3);
            $nomor_urut = $lastNumber + 1;
        } else {
            // Jika belum ada kode_media di bulan ini, mulai dari 1
            $nomor_urut = 1;
        }
    
        $nomor_urut_padded = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT); // Tambahkan leading zero
        $kode_media = $prefix . $tahun_bulan . $nomor_urut_padded;
    
        $file = $request->file('file');
        $nama_file = $file->getClientOriginalName();
    
        // Cek apakah nama file sudah ada di database
        if (Media::where('nama_file', $nama_file)->exists()) {
            return redirect()->back()->withErrors([
                'file' => 'File dengan nama yang sama sudah ada. Harap gunakan file lain atau ubah nama file Anda sebelum mengunggah.',
            ]);
        }
    
        $path = $file->storeAs('uploads/media', $file->getClientOriginalName(), 'public'); // Simpan file ke dalam storage
        $tipe_file = $file->getClientMimeType(); 
        $ukuran_file = $file->getSize();
    
        // Simpan data ke dalam database
        Media::create([
            'kategori_media_id' => $request->kategori_media_id,
            'kode_media' => $kode_media,
            'nama_file' => $nama_file,
            'tipe_file' => $tipe_file,
            'ukuran_file' => $ukuran_file,
            'kategori' => $request->kategori,
            'diupload_oleh' => auth()->user()->id_user,
            'path' => $path,
        ]);
    
        alert()->success('Berhasil', 'Media berhasil diunggah.');
        return redirect('/media');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy($id)
     {
         $media = Media::findOrFail($id);
 
         // Hapus file fisik dari storage jika ada
         if (Storage::exists($media->path)) {
             Storage::delete($media->path);
         }
 
         // Hapus data dari database
         $media->delete();
 
         // Redirect atau tampilkan notifikasi sukses
         alert()->success('Berhasil', 'Media berhasil dihapus.');
         return redirect('/media');
     }
     
    public function delete($id)
    {
        $media = Media::findOrFail($id);

        // Hapus file dari storage
        Storage::delete($media->path);

        // Hapus data dari database
        $media->delete();

        alert()->success('Berhasil', 'Media berhasil dihapus.');
        return back();
    }
}
