<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_barang_keluar';
    protected $fillable = [
        'barang_id',
        'pegawai_id',
        'barang_masuk_id',
        'kode_bk',
        'jumlah',
        'satuan',
        'satuan',
        'tanggal',
        'keterangan'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function barang_m()
    {
        return $this->belongsTo(BarangMasuk::class, 'barang_masuk_id');
    }
}
