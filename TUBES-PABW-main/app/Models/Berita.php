<?php

namespace App\Models;

use Illuminate\Support\Facades\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar'
    ];

    public function comments()
    {
        return $this->hasMany(BeritaComment::class, 'berita_id');
    }

    public function likes()
    {
        return $this->hasMany(BeritaLike::class, 'berita_id');
    }
}
