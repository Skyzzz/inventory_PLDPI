<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel
    public $timestamps = false; // Tidak menggunakan created_at dan updated_at

    // Kolom yang bisa diisi melalui mass assignment
    protected $fillable = [
        'nama_file',
        'tipe_file',
        'ukuran_file',
        'path',
        'kategori',
        'uploaded_by',
        'tanggal_upload',
    ];
}
