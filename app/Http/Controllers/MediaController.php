<?php

namespace App\Http\Controllers;

use App\Models\Media;
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
        $media = Media::all();
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

        return view('media.tbhMedia', compact('kode_media'));
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
            'kategori' => 'nullable|string',
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads/media');
        $tipe_file = $file->getClientMimeType();
        $ukuran_file = $file->getSize();

        Media::create([
            'kode_media' => $request->kode_media,
            'nama_file' => $file->getClientOriginalName(),
            'tipe_file' => $tipe_file,
            'ukuran_file' => $ukuran_file,
            'kategori' => $request->kategori,
            'uploaded_by' => auth()->user()->nama,
            'tanggal_upload' => now(),
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
