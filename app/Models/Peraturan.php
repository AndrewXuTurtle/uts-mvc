<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Peraturan extends Model
{
    use HasFactory;

    protected $table = 'peraturan';

    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'jenis',
        'file_path',
        'file_name',
        'file_size',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'file_size' => 'integer',
        'urutan' => 'integer',
    ];

    /**
     * Get full file URL
     */
    public function getFileUrlAttribute()
    {
        return Storage::url($this->file_path);
    }

    /**
     * Get human readable file size
     */
    public function getFileSizeFormattedAttribute()
    {
        if (!$this->file_size) return 'N/A';
        
        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->file_size;
        $unit = 0;
        
        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }
        
        return round($size, 2) . ' ' . $units[$unit];
    }

    /**
     * Scope for filtering by kategori
     */
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope for filtering by jenis
     */
    public function scopeJenis($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }

    /**
     * Scope for active only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordering
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('kategori')->orderBy('urutan')->orderBy('judul');
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%");
        });
    }

    /**
     * Get badge color by kategori
     */
    public function getKategoriBadgeAttribute()
    {
        return match($this->kategori) {
            'Akademik' => 'primary',
            'Kemahasiswaan' => 'success',
            'Administratif' => 'warning',
            'Keuangan' => 'info',
            default => 'secondary'
        };
    }
}
