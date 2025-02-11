<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel
    // Kolom yang bisa diisi melalui mass assignment
    protected $fillable = [
        'kategori_media_id',
        'kode_media',
        'nama_file',
        'tipe_file',
        'ukuran_file',
        'path',
        'kategori',
        'diupload_oleh',
        'path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'diupload_oleh', 'id_user');
    }

    public function kategori_media()
    {
        return $this->belongsTo(KategoriMedia::class, 'kategori_media_id', 'id_kategori_media');
    }    
}
