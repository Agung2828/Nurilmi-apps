<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'topik',
        'judul',
        'sub_judul',
        'konten',
        'pdf',
        'badge',
        'urutan',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi: materi milik satu user (admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope: hanya yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope: filter berdasarkan topik
    public function scopeByTopik($query, $topik)
    {
        return $query->where('topik', $topik);
    }
}
