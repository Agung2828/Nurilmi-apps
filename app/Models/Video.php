<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'topik',
        'judul',
        'deskripsi',
        'youtube_id',
        'video_type',   // 'youtube' atau 'file'
        'video_path',   // path file jika upload
        'durasi',
        'seri',
        'urutan',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Thumbnail: YouTube pakai API thumbnail, file pakai placeholder/icon
     */
    public function getThumbnailAttribute(): string
    {
        if ($this->video_type === 'file') {
            return asset('images/video-placeholder.png'); // siapkan gambar placeholder
        }
        return "https://img.youtube.com/vi/{$this->youtube_id}/hqdefault.jpg";
    }

    /**
     * URL untuk memutar video (embed atau file langsung)
     */
    public function getEmbedUrlAttribute(): string
    {
        if ($this->video_type === 'file') {
            return asset('storage/' . $this->video_path);
        }
        return "https://www.youtube.com/embed/{$this->youtube_id}";
    }

    /**
     * Apakah video ini dari YouTube?
     */
    public function isYoutube(): bool
    {
        return $this->video_type === 'youtube';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByTopik($query, $topik)
    {
        return $query->where('topik', $topik);
    }
}
