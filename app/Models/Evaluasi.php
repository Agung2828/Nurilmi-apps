<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evaluasi extends Model
{
    protected $table = 'kuis';

    protected $fillable = [
        'judul',
        'topik',
        'kesulitan',
        'icon',
        'deskripsi',
        'durasi_menit',
        'skor_lulus',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi ke soal-soal
    public function soal(): HasMany
    {
        return $this->hasMany(Soal::class, 'kuis_id')->orderBy('urutan');
    }

    // Hitung jumlah soal
    public function jumlahSoal(): int
    {
        return $this->soal()->count();
    }

    // Label warna kesulitan
    public function badgeKesulitan(): string
    {
        return match ($this->kesulitan) {
            'mudah'  => 'diff-mudah',
            'sedang' => 'diff-sedang',
            'sulit'  => 'diff-sulit',
            default  => 'diff-mudah',
        };
    }

    // Scope aktif saja
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope filter topik
    public function scopeByTopik($query, string $topik)
    {
        return $query->where('topik', $topik);
    }
}
