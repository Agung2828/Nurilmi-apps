<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtpSection extends Model
{
    protected $table = 'atp_sections';

    protected $fillable = [
        'tipe',
        'topik',
        'judul',
        'sub_judul',
        'isi',
        'icon',
        'badge_style',
        'minggu',
        'chips',
        'tags',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Chips & tags disimpan sebagai JSON string, decode otomatis
    public function getChipsArrayAttribute(): array
    {
        if (!$this->chips) return [];
        $decoded = json_decode($this->chips, true);
        return is_array($decoded) ? $decoded : [];
    }

    public function getTagsArrayAttribute(): array
    {
        if (!$this->tags) return [];
        $decoded = json_decode($this->tags, true);
        return is_array($decoded) ? $decoded : [];
    }

    // Scope per tipe
    public function scopeOfTipe($query, string $tipe)
    {
        return $query->where('tipe', $tipe)->orderBy('urutan');
    }

    // Scope per topik
    public function scopeOfTopik($query, string $topik)
    {
        return $query->where('topik', $topik)->orderBy('urutan');
    }

    // Scope aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Label tipe untuk tampilan admin
    public function labelTipe(): string
    {
        return match ($this->tipe) {
            'cp'       => 'Capaian Pembelajaran',
            'tp'       => 'Tujuan Pembelajaran',
            'timeline' => 'Alur / Timeline',
            'topik'    => 'Sub-Topik Detail',
            default    => ucfirst($this->tipe),
        };
    }

    // Badge class topik
    public function badgeTopik(): string
    {
        return match ($this->topik) {
            'zakat'   => 'badge-z',
            'mawaris' => 'badge-m',
            'haji'    => 'badge-h',
            default   => '',
        };
    }
}
