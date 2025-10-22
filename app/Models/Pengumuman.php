<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'prioritas',
        'tanggal_mulai',
        'tanggal_selesai',
        'penulis',
        'aktif',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'aktif' => 'boolean',
    ];

    // Custom method for handling file uploads
    public static function uploadGambar($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('pengumuman', $filename, 'public');
    }

    // Scope untuk pengumuman aktif
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    // Scope untuk pengumuman yang masih berlaku
    public function scopeBerlaku($query)
    {
        return $query->where('tanggal_mulai', '<=', now())
                     ->where(function($q) {
                         $q->whereNull('tanggal_selesai')
                           ->orWhere('tanggal_selesai', '>=', now());
                     });
    }
}
