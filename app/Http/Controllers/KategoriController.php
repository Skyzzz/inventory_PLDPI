<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        $thn = Carbon::now()->year;
        $var = 'KT';
        $kts = Kategori::count();
        if ($kts == 0) {
            $awal = 10001;
            $kode_kt = $var.$thn.$awal;
            // kt2021001
        } else {
           $last = Kategori::all()->last();
           $awal = (int)substr($last->kode_kategori, -5) + 1;
           $kode_kt = $var.$thn.$awal;
        }
        return view('kategori.dftKategori', compact('kategori', 'kode_kt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'kode_kategori' => 'required',
            'kategori' => 'required|max:50|unique:kategori,kategori'
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kategori.required' => 'Nama kategori wajib diisi.',
            'kategori.unique' => 'Kategori sudah ada!',
            'kategori.max' => 'Nama kategori maksimal 50 karakter.'
        ]);
    
        try {
            Kategori::create($request->only(['kode_kategori', 'kategori']));
            return redirect()->back()->with('success', 'Kategori Baru Berhasil Ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan kategori. Coba lagi!');
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([
            'kategori' => 'required|max:50|unique:kategori,kategori,' . $id . ',id_kategori'
        ], [
            'kategori.required' => 'Nama kategori wajib diisi.',
            'kategori.unique' => 'Kategori sudah ada!',
            'kategori.max' => 'Nama kategori maksimal 50 karakter.'
        ]);
    
        try {
            Kategori::where('id_kategori', $id)->update([
                'kategori' => $request->kategori
            ]);
            return redirect()->back()->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Gagal mengupdate kategori.', 'error_id' => $id]);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
         try {
             Kategori::where('id_kategori', $id)->delete();
             alert()->success('Berhasil','Kategori Berhasil Dihapus.');
         } catch (QueryException $e) {
             alert()->error('Gagal', 'Kategori tidak dapat dihapus karena masih digunakan di tabel lain.');
         }
         return back();
     }
     
    
}
