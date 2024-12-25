<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratkeluar extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'surat_keluar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_surat',
        'nomor_surat',
        'tanggal_surat',
        'tanggal_keluar',
        'pengirim',
        'perihal',
        'kategori',
        'sifat',
        'file_surat',
        'keterangan',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_keluar' => 'date',
    ];
}