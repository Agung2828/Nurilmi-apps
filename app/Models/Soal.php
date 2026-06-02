<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Soal extends Model
{
    protected $table = 'soal';

    protected $fillable = [
        'kuis_id',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'jawaban_benar',
        'pembahasan',
        'urutan',
    ];

    // Relasi ke evaluasi (tabel: kuis, foreign key: kuis_id)
    public function evaluasi(): BelongsTo
    {
        return $this->belongsTo(Evaluasi::class, 'kuis_id');
    }

    // Ambil semua opsi sebagai array ['a' => '...', 'b' => '...', ...]
    public function getOpsiArray(): array
    {
        return [
            'a' => $this->opsi_a,
            'b' => $this->opsi_b,
            'c' => $this->opsi_c,
            'd' => $this->opsi_d,
        ];
    }
}
