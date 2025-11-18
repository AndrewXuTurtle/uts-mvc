<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PKM extends Model
{
    use HasFactory;

    protected $table = 'pkm';

    protected $fillable = [
        'judul_pkm',
        'deskripsi',
        'tahun',
        'jenis_pkm',
        'status',
        'dana',
        'pencapaian',
        'file_dokumen',
        'dosen_pembimbing_id',
    ];

    protected $casts = [
        'dana' => 'decimal:2',
        'tahun' => 'integer',
    ];

    /**
     * Relationship with Dosen pembimbing
     */
    public function dosenPembimbing()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_id');
    }

    /**
     * Alias for dosenPembimbing (for backward compatibility)
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_id');
    }

    /**
     * Get dosen attribute (for backward compatibility with views)
     * This allows using $pkm->dosen in views that expect a relationship
     */
    public function getDosenAttribute()
    {
        // Return as collection to support ->count() and foreach in views
        $pembimbing = $this->dosenPembimbing;
        return $pembimbing ? collect([$pembimbing]) : collect([]);
    }

    /**
     * Relationship with Mahasiswa (Many-to-Many)
     */
    public function mahasiswas(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'pkm_mahasiswa', 'pkm_id', 'nim', 'id', 'nim')
                    ->withPivot('peran')
                    ->withTimestamps();
    }

    /**
     * Alias for mahasiswas (for backward compatibility)
     */
    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'pkm_mahasiswa', 'pkm_id', 'nim', 'id', 'nim')
                    ->withPivot('peran')
                    ->withTimestamps();
    }

    /**
     * Scope for filtering by status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for filtering by tahun
     */
    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    /**
     * Scope for search functionality
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('judul_pkm', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%")
              ->orWhere('jenis_pkm', 'like', "%{$search}%");
        });
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'Proposal' => 'secondary',
            'Didanai' => 'primary',
            'Selesai' => 'success',
            'Ditolak' => 'danger',
            default => 'secondary'
        };
    }
}