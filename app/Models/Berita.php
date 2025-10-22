<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'penulis',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Custom method for handling file uploads
    public static function uploadGambar($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('berita', $filename, 'public');
    }
}