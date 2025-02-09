<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSurat extends Model
{
    use HasFactory;
    protected $table = 'kategori_surat';
    protected $primaryKey = 'id_kategori_surat';
    protected $fillable = [
        'kode_kategori_surat',
        'kategori_surat'
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }

    public function suratmasuk()
    {
        return $this->hasMany(SuratMasuk::class);
    }
    
    public function suratkeluar()
    {
        return $this->hasMany(Suratkeluar::class);
    }
}
