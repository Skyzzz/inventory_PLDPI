<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMedia extends Model
{
    use HasFactory;
    protected $table = 'kategori_media';
    protected $primaryKey = 'id_kategori_media';
    protected $fillable = [
        'kode_kategori_media',
        'kategori_media'
    ];

    public function media()
    {
        return $this->hasMany(Media::class, 'kategori_media_id', 'id_kategori_media');
    }
}
