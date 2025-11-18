<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nim',
        'judul_project',
        'deskripsi',
        'tahun',
        'tahun_selesai',
        'kategori',
        'teknologi',
        'dosen_pembimbing',
        'cover_image',
        'galeri',
        'link_demo',
        'link_github',
        'status',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'tahun_selesai' => 'integer',
        'galeri' => 'array',
    ];

    /**
     * Relasi ke Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    // Scope for searching
    public function scopeSearch(Builder $query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('judul_project', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('dosen_pembimbing', 'like', "%{$search}%")
                  ->orWhere('teknologi', 'like', "%{$search}%");
        });
    }

    // Scope for filtering by tahun
    public function scopeFilterTahun(Builder $query, $tahun)
    {
        if ($tahun) {
            return $query->where('tahun', $tahun);
        }
        return $query;
    }

    // Scope for published only
    public function scopePublished(Builder $query)
    {
        return $query->where('status', 'Published');
    }

    // Custom method for handling file uploads
    public static function uploadFoto($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('projects', $filename, 'public');
    }
}
