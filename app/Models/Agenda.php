<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'penyelenggara',
        'kategori',
        'gambar',
        'aktif',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'aktif' => 'boolean',
    ];

    // Custom method for handling file uploads
    public static function uploadGambar($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('agenda', $filename, 'public');
    }

    // Scope untuk agenda aktif
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    // Scope untuk agenda mendatang
    public function scopeMendatang($query)
    {
        return $query->where('tanggal_mulai', '>=', now());
    }

    // Scope untuk agenda berdasarkan kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}
