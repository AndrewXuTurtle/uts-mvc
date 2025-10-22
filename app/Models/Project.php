<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use HasFactory;

    protected $table = 'tbl_project';
    protected $primaryKey = 'project_id';

    protected $fillable = [
        'judul_proyek',
        'deskripsi_singkat',
        'nama_mahasiswa',
        'nim_mahasiswa',
        'program_studi',
        'dosen_pembimbing',
        'tahun_selesai',
        'path_foto_utama',
        'path_foto_galeri',
        'keywords',
    ];

    protected $attributes = [
        'program_studi' => 'Teknik Perangkat Lunak',
    ];

    // Scope for searching
    public function scopeSearch(Builder $query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('judul_proyek', 'like', "%{$search}%")
                  ->orWhere('nama_mahasiswa', 'like', "%{$search}%")
                  ->orWhere('nim_mahasiswa', 'like', "%{$search}%")
                  ->orWhere('dosen_pembimbing', 'like', "%{$search}%")
                  ->orWhere('keywords', 'like', "%{$search}%");
        });
    }

    // Scope for filtering by tahun_selesai
    public function scopeFilterTahun(Builder $query, $tahun)
    {
        if ($tahun) {
            return $query->where('tahun_selesai', $tahun);
        }
        return $query;
    }

    // Custom method for handling file uploads
    public static function uploadFoto($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('projects', $filename, 'public');
    }
}
