<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nim',
        'nama',
        'email',
        'no_hp',
        'jenis_kelamin',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'tahun_masuk',
        'kelas',
        'foto',
        'status',
        'tahun_lulus',
        'prodi'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tahun_masuk' => 'integer',
        'tahun_lulus' => 'integer',
    ];

    /**
     * Relasi ke Alumni
     */
    public function alumni()
    {
        return $this->hasOne(Alumni::class, 'nim', 'nim');
    }

    /**
     * Relasi ke Projects
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'nim', 'nim');
    }

    /**
     * Relasi ke Penelitian (many-to-many)
     */
    public function penelitians()
    {
        return $this->belongsToMany(Penelitian::class, 'penelitian_mahasiswa', 'nim', 'penelitian_id', 'nim', 'id')
                    ->withPivot('peran')
                    ->withTimestamps();
    }

    /**
     * Relasi ke PKM (many-to-many)
     */
    public function pkms()
    {
        return $this->belongsToMany(PKM::class, 'pkm_mahasiswa', 'nim', 'pkm_id', 'nim', 'id')
                    ->withPivot('peran')
                    ->withTimestamps();
    }

    /**
     * Check if mahasiswa sudah lulus berdasarkan tahun masuk + 4 tahun
     */
    public function isEligibleForGraduation()
    {
        $expectedGraduationYear = $this->tahun_masuk + 4;
        $currentYear = date('Y');
        return $currentYear >= $expectedGraduationYear;
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeColor()
    {
        return match($this->status) {
            'Aktif' => 'success',
            'Lulus' => 'primary',
            'Cuti' => 'warning',
            'DO' => 'danger',
            default => 'secondary'
        };
    }

    // Custom method for handling file uploads
    public static function uploadFoto($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('mahasiswa', $filename, 'public');
    }
}
