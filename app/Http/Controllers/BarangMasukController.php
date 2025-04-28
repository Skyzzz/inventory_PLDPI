<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\Pemasok;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang_masuk = BarangMasuk::all();
        return view('barang.barang masuk.dftBarangMasuk', compact('barang_masuk'));
    }


    public function create()
    {
        $supplier = Pemasok::orderBy('nama', 'asc')->get();

        $thn = Carbon::now()->year;
        $var = 'BM';
        $bms = BarangMasuk::count();
        if ($bms == 0) {
            $awal = 10001;
            $kode_bm = $var.$thn.$awal;
            // BM2021001
        } else {
           $last = BarangMasuk::all()->last();
           $awal = (int)substr($last->kode_bm, -5) + 1;
           $kode_bm = $var.$thn.$awal;
        }

        return view('barang.barang masuk.tbhBarangMasuk', compact('supplier', 'kode_bm'));

    }

    public function get_barang($id)
    {
        $supplier = Pemasok::orderBy('nama', 'asc')->get();
        $produk = Barang::where('pemasok_id', $id)->get();
        // dd($produk);

        $thn = Carbon::now()->year;
        $var = 'BM';
        $bms = BarangMasuk::count();
        if ($bms == 0) {
            $awal = 10001;
            $kode_bm = $var.$thn.$awal;
            // BM2021001
        } else {
           $last = BarangMasuk::all()->last();
           $awal = (int)substr($last->kode_bm, -5) + 1;
           $kode_bm = $var.$thn.$awal;
        }

        return view('barang.barang masuk.tbhBarangMasuk', compact('supplier', 'kode_bm', 'produk', 'id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_masuk' => 'required|date|before_or_equal:today',
            'supplier' => 'required',
        ], [
            'tgl_masuk.required' => 'Kolom tanggal masuk wajib diisi.',
            'tgl_masuk.date' => 'Format Tanggal tidak valid',
            'tgl_masuk.before_or_equal' => 'Tanggal masuk tidak boleh lebih dari hari ini',
        ]);
    
        $kode_bm = $request->kode_bm;
        $id_barang = $request->id_barang; // ID barang yang dipilih dari input
        $supplier = $request->supplier;
        $kategori_id = $request->kategori_id;
        $barang_id = $request->barang_id; // Barang ID yang dipilih
        $nama_barang = $request->nama;
        $harga_ambil = $request->harga_ambil;
        $jumlah = $request->jumlah;
        $tgl = $request->tgl_masuk;
        $satuan = $request->satuan;
    
        foreach ($jumlah as $key => $value) {
            if ($value == 0) {
                continue;
            }
    
            // Ambil data produk dari tabel Barang menggunakan id_barang yang valid
            $dt_produk = Barang::where('id_barang', $id_barang[$key])->first();
    
            // Pastikan produk ditemukan
            if ($dt_produk) {
                // Update jumlah barang di tabel Barang
                Barang::where('id_barang', $id_barang[$key])->update([
                    'jumlah' => $dt_produk->jumlah + $jumlah[$key]
                ]);
    
                // Insert data barang masuk ke tabel barang_masuk
                BarangMasuk::insert([
                    'kode_bm' => $kode_bm,
                    'kategori_id' => $kategori_id[$key],
                    'pemasok_id' => $supplier,
                    'barang_id' => $dt_produk->id_barang, // Ambil barang_id yang sesuai dari tabel barang
                    'nama' => $nama_barang[$key],
                    'jumlah' => $jumlah[$key],
                    'satuan' => $satuan[$key],
                    'harga' => $harga_ambil[$key],
                    'tot_pengeluaran' => $harga_ambil[$key] * $jumlah[$key],
                    'tanggal' => $tgl,
                ]);
            }
        }
    
        alert()->success('Berhasil','Data Barang Berhasil Ditambahkan.');
        return redirect('/barang_masuk');
    }
    

    public function edit($id)
    {
       $barang = BarangMasuk::where('id_barang_masuk', $id)->get();

       return view('');
    }

    public function destroy($id)
    {
        try {
            BarangMasuk::where('id_barang_masuk', $id)->delete();
            alert()->success('Berhasil', 'Data Barang Masuk Berhasil Dihapus.');
            return back();
        } catch (QueryException $e) {
            alert()->error('Gagal', 'Data Barang Masuk tidak dapat dihapus karena masih digunakan di tabel lain.');
            return back();
        }
    }

}
