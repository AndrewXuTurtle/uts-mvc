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
        'is_prestasi',
        'nama_mahasiswa',
        'nim',
        'program_studi',
        'tingkat_prestasi',
        'jenis_prestasi',
        'penyelenggara',
        'tanggal_prestasi',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tanggal_prestasi' => 'date',
        'is_prestasi' => 'boolean',
    ];

    // Custom method for handling file uploads
    public static function uploadGambar($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('berita', $filename, 'public');
    }

    // Scope untuk berita prestasi
    public function scopePrestasi($query)
    {
        return $query->where('is_prestasi', true);
    }

    // Scope untuk berita biasa (bukan prestasi)
    public function scopeBeritaBiasa($query)
    {
        return $query->where('is_prestasi', false);
    }

    // Scope berdasarkan tingkat prestasi
    public function scopeTingkatPrestasi($query, $tingkat)
    {
        return $query->where('tingkat_prestasi', $tingkat);
    }
}