<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang_keluar = BarangKeluar::all();
        return view('barang.barang keluar.dftBarangKeluar', compact('barang_keluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        $pegawai = Pegawai::all();

        $thn = Carbon::now()->year;
        $var = 'BK';
        $bms = BarangKeluar::count();
        if ($bms == 0) {
            $awal = 10001;
            $kode_bk = $var.$thn.$awal;
            // BK2021001
        } else {
           $last = BarangKeluar::all()->last();
           $awal = (int)substr($last->kode_bk, -5) + 1;
           $kode_bk = $var.$thn.$awal;
        }
        return view('barang.barang keluar.tbhBarangKeluar', compact('kode_bk', 'barang', 'pegawai'));
    }

    public function get_barang($id)
    {
        $data_bk = Barang::where('id_barang', $id)->first();

        return response()->json([
            'data_bk' => $data_bk,
        ]);

        // return view('barang.barang keluar.tbhBarangKeluar', compact('kode_bk', 'barang', 'pegawai', 'id', 'jml_barang'));
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
            'nama_pegawai' => 'required',
            'tgl_keluar' => 'required|date|before_or_equal:today',
            'nama_barang' => 'required',
            'keterangan' => 'nullable',
        ], [
            'tgl_keluar.required' => 'Kolom tanggal keluar wajib diisi.',
            'tgl_keluar.date' => 'Format Tanggal Salah',
            'tgl_keluar.before_or_equal' => 'Tanggal Keluar Tidak Boleh Lebih Dari Hari Ini',
        ]);
    
        $kode_bk = $request->kode_bk;
        $nama_pegawai = $request->nama_pegawai;
        $tgl = $request->tgl_keluar;
        $nama_barang = $request->nama_barang;
        $id_barang = $request->id_barang;
        $jumlah = $request->jml;
        $satuan = $request->satuan;
        $keterangan = $request->keterangan;
    
        foreach ($jumlah as $key => $value) {
            if ($value == 0) {
                continue;
            }
    
            // Ambil data barang
            $dt_barang = Barang::where('id_barang', $id_barang[$key])->first();
    
            if (!$dt_barang) {
                alert()->error('Gagal', 'Barang tidak ditemukan.');
                return back();
            }
    
            // Ambil barang_masuk berdasarkan barang_id
            $dt_barang_masuk = BarangMasuk::where('barang_id', $id_barang[$key])->first();
    
            if (!$dt_barang_masuk) {
                alert()->error('Gagal', 'Data Barang Masuk tidak ditemukan.');
                return back();
            }
    
            // Cek stok
            if ($jumlah[$key] > $dt_barang->jumlah) {
                alert()->error('Gagal', 'Jumlah Barang Melebihi Stok.');
                return back();
            }
    
            // Update stok barang
            Barang::where('id_barang', $id_barang[$key])->update([
                'jumlah' => $dt_barang->jumlah - $jumlah[$key]
            ]);
    
            // Insert ke tabel barang_keluar
            BarangKeluar::insert([
                'kode_bk' => $kode_bk,
                'pegawai_id' => $nama_pegawai,
                'barang_id' => $id_barang[$key],
                'barang_masuk_id' => $dt_barang_masuk->id_barang_masuk, // ini diambil dari tabel barang_masuk
                'jumlah' => $jumlah[$key],
                'satuan' => $satuan[$key],
                'tanggal' => $tgl,
                'keterangan' => $keterangan,
            ]);
        }
    
        alert()->success('Berhasil', 'Data Barang Keluar Berhasil Ditambahkan.');
        return redirect('/barang_keluar');
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
        //
    }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function destroy($id)
    {
        // Cek apakah data barang_keluar dengan ID tertentu ada
        $barangKeluar = BarangKeluar::findOrFail($id);
      
        // Kembalikan jumlah stok barang sebelum menghapus data barang keluar
        $barang = Barang::where('id_barang', $barangKeluar->barang_id)->first();
        if ($barang) {
            $barang->update([
                'jumlah' => $barang->jumlah + $barangKeluar->jumlah
            ]);
        }

        // Hapus data barang keluar
        $barangKeluar->delete();

        alert()->success('Berhasil', 'Data berhasil dihapus.');
        return back();
    }
}