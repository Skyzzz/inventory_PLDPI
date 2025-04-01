<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pemasok;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.dftBarang', compact('barang'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $supplier = Pemasok::all();

        $thn = Carbon::now()->year;
        $var = 'BF';
        $bms = Barang::count();
        if ($bms == 0) {
            $awal = 10001;
            $kode_b = $var.$thn.$awal;
            // BM2021001
        } else {
           $last = Barang::all()->last();
           $awal = (int)substr($last->kode_barang, -5) + 1;
           $kode_b = $var.$thn.$awal;
        }

        return view('barang.tbhBarang', compact('kategori', 'supplier', 'kode_b'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'kategori_id' => 'required',
            'pemasok_id' => 'required',
            'nama' =>'required',
            'satuan' => 'required',
            'harga_ambil' => 'required',
            'gambar' => 'nullable|mimes:jpg,jpeg,png' // Buat gambar opsional
        ]);
    
        // **Menghapus "Rp" dan format angka dari harga_ambil**
        $harga = str_replace(['Rp', '.', ','], '', $request->harga_ambil); 
        $hargaBersih = (int) $harga; // Ubah ke integer agar tidak ada karakter lain
    
        $barang = new Barang;
        $barang->kode_barang = $request->kode_barang;
        $barang->kategori_id = $request->kategori_id;
        $barang->pemasok_id = $request->pemasok_id;
        $barang->nama = $request->nama;
        $barang->jumlah = 0;
        $barang->satuan = $request->satuan;
        $barang->harga_ambil = $hargaBersih; // Simpan harga dalam format angka bersih
    
        // Cek apakah ada gambar yang diunggah
        if ($request->hasFile('gambar')) {
            $gm = $request->file('gambar');
            $namaFile = $gm->getClientOriginalName();
            $gm->move(public_path('/Image'), $namaFile);
            $barang->gambar = $namaFile;
        } else {
            $barang->gambar = 'default.png'; 
        }
    
        $barang->save();
    
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        return redirect('/barang');
    }

    public function edit($id)
{
    // Ambil satu data barang
    $barang = Barang::findOrFail($id);

    $kategori = Kategori::all();
    $supplier = Pemasok::all();

    return view('barang.edtBarang', compact('barang', 'kategori', 'supplier'));
}

public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'kode_barang' => 'required',
        'kategori_id' => 'required',
        'pemasok_id' => 'required',
        'nama' => 'required',
        'satuan' => 'required',
        'harga_ambil' => 'required',
        'gambar' => 'nullable|mimes:jpg,jpeg,png'
    ]);

    // Ambil data barang yang akan diperbarui
    $barang = Barang::findOrFail($id);

    // Menghilangkan format Rp dan koma dari harga
    $harga = str_replace(['Rp', '.', ','], '', $request->harga_ambil);

    // Simpan perubahan data
    $barang->kode_barang = $request->kode_barang;
    $barang->kategori_id = $request->kategori_id;
    $barang->pemasok_id = $request->pemasok_id;
    $barang->nama = $request->nama;
    $barang->satuan = $request->satuan;
    $barang->harga_ambil = (int) $harga; // Pastikan disimpan sebagai angka

    // Jika ada file gambar baru, update gambar
    if ($request->hasFile('gambar')) {
        $gm = $request->file('gambar');
        $namaFile = $gm->getClientOriginalName();
        $gm->move(public_path('/Image'), $namaFile);
        $barang->gambar = $namaFile;
    }

    // Simpan perubahan ke database
    $barang->save();

    alert()->success('Berhasil', 'Data Barang Berhasil Diupdate.');
    return redirect('/barang');
}

    public function destroy($id)
    {
        Barang::where('id_barang', $id)->delete();
        alert()->success('Berhasil','Barang Berhasil Dihapus.');
        return back();
    }
}
