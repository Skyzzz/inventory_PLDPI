<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasok = Pemasok::all();
        return view('pemasok.dftPemasok', compact('pemasok'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pemasok.tbhPemasok');
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
            'nama' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'alamat' => ['required', 'regex:/^[a-zA-Z0-9\s.,\-\/#()]+$/'],
            'email' => 'required|email',
            'telepon' => 'required|numeric|digits_between:10,15|unique:pemasok,telepon'
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.regex' => 'Nama hanya boleh mengandung huruf.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.regex' => 'Alamat hanya boleh mengandung huruf, angka, dan karakter khusus.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'telepon.required' => 'Telepon wajib diisi.',
            'telepon.numeric' => 'Telepon harus berupa angka.',
            'telepon.digits_between' => 'Telepon harus terdiri dari 10 hingga 15 digit.',
            'telepon.unique' => 'Telepon sudah digunakan oleh pemasok lain.'
        ]);
    
        // Cek apakah pemasok dengan email atau telepon yang sama sudah ada
        $existingPemasok = Pemasok::where('email', $request->email)
                                  ->orWhere('telepon', $request->telepon)
                                  ->first();
    
        if ($existingPemasok) {
            alert()->error('Gagal', 'Email atau Telepon sudah terdaftar dalam sistem.');
            return redirect()->back()->withInput();
        }
    
        // Simpan pemasok jika belum ada
        $pemasok = new Pemasok();
        $pemasok->nama = $request->nama;
        $pemasok->alamat = $request->alamat;
        $pemasok->email = $request->email;
        $pemasok->telepon = $request->telepon;
        $pemasok->save();
    
        alert()->success('Berhasil', 'Supplier Baru Berhasil Ditambahkan.');
        return redirect('/pemasok');
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
        $pemasok = Pemasok::where('id_pemasok', $id)->get();
        return view('pemasok.edtPemasok', compact('pemasok'));
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
        $pemasok = Pemasok::where('id_pemasok', $id)->firstOrFail(); // Menggunakan firstOrFail() agar langsung error jika tidak ditemukan
        
        $rules = [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ];
    
        if ($request->email != $pemasok->email) {
            $rules['email'] = 'required|email|unique:pemasok,email';
        }
    
        if ($request->telepon != $pemasok->telepon) {
            $rules['telepon'] = 'required|numeric|digits_between:10,15|unique:pemasok,telepon';
        }
    
        $validatedData = $request->validate($rules);
    
        // Perbarui data pemasok
        $pemasok->update($validatedData);
    
        alert()->success('Berhasil', 'Supplier Berhasil Diedit.');
        return redirect('/pemasok');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pemasok::where('id_pemasok', $id)->delete();
        alert()->success('Berhasil','Supplier Berhasil Dihapus.');
        return back();
    }
}
