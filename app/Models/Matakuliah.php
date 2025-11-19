<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';
    protected $primaryKey = 'mk_id';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'program_studi',
        'kurikulum_tahun',
        'deskripsi_singkat',
        'status_wajib',
    ];

    protected $attributes = [
        'program_studi' => 'Teknik Perangkat Lunak',
    ];

    // Scope for searching
    public function scopeSearch(Builder $query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('nama_mk', 'like', "%{$search}%")
                  ->orWhere('kode_mk', 'like', "%{$search}%")
                  ->orWhere('deskripsi_singkat', 'like', "%{$search}%");
        });
    }

    // Scope for filtering by semester
    public function scopeFilterSemester(Builder $query, $semester)
    {
        if ($semester) {
            return $query->where('semester', $semester);
        }
        return $query;
    }

    // Scope for filtering by kurikulum_tahun
    public function scopeFilterKurikulumTahun(Builder $query, $tahun)
    {
        if ($tahun) {
            return $query->where('kurikulum_tahun', $tahun);
        }
        return $query;
    }
}
