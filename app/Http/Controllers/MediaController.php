<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\KategoriMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

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
    public function index_detail()
    {
        $media_detail = Media::with('user')->get(); // Load relasi user
        return view('media.dftMediaDetail', compact('media_detail'));
    }
    public function detail (Request $request, $id)
    {
        // $media_detail = Media::with('user')->findOrFail($id); // Ambil data berdasarkan ID dengan relasi user
        $media_detail = Media::findOrFail($id);
        return view('media.detailMedia', compact('media_detail'));
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori_media = \App\Models\KategoriMedia::all(); // Ambil semua kategori dari tabel kategori_media

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


        return view('media.tbhMedia', compact('kode_media', 'kategori_media'));
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
    
        $nomor_urut = $lastMedia ? ((int) substr($lastMedia->kode_media, -3)) + 1 : 1;
        $nomor_urut_padded = str_pad($nomor_urut, 3, '0', STR_PAD_LEFT);
        $kode_media = $prefix . $tahun_bulan . $nomor_urut_padded;
    
        $file = $request->file('file');
        $nama_file = $file->getClientOriginalName();
    
        // Cek apakah nama file sudah ada di database
        if (Media::where('nama_file', $nama_file)->exists()) {
            return redirect()->back()->withErrors([
                'file' => 'File dengan nama yang sama sudah ada. Harap gunakan file lain atau ubah nama file Anda sebelum mengunggah.',
            ]);
        }
    
        // Simpan file ke dalam storage
        if ($request->hasFile('file')) { 
            $path = $request->file('file')->store('uploads/media', 'public');
        } else {
            return redirect()->back()->withErrors([
                'file' => 'File harus diunggah.',
            ]);
        }
    
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
         if ($media->path) {
            // Hapus file dengan Storage Laravel
            Storage::disk('public')->delete($media->path);

            // Cek apakah file masih ada di `public/storage`
            $filePath = public_path('storage/' . $media->path);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
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

        if ($media->path) {
            // Hapus file dengan Storage Laravel
            Storage::disk('public')->delete($media->path);

            // Cek apakah file masih ada di `public/storage`
            $filePath = public_path('storage/' . $media->path);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }

        // Hapus data dari database
        $media->delete();

        alert()->success('Berhasil', 'Media berhasil dihapus.');
        return back();
    }

    public function streamMedia($id)
    {
        $media = Media::findOrFail($id);
        $path = storage_path("app/public/" . $media->path);

        return view('stream.streamViewMedia', compact('media', 'path'));
    }
    
}
