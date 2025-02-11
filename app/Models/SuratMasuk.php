<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'surat_masuk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_surat',
        'kategori_surat_id',
        'nomor_surat',
        'nama_surat',
        'tanggal_surat',
        'tanggal_terima',
        'pengirim',
        'perihal',
        'kategori',
        'file_surat',
        'keterangan',
        'diupload_oleh',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_terima' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'diupload_oleh', 'id_user');
    }

    public function kategori_surat()
    {
        return $this->belongsTo(KategoriSurat::class, 'kategori_surat_id', 'id_kategori_surat');
    } 
}
