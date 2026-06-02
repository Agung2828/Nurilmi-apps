<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use Illuminate\View\View;

class EvaluasiController extends Controller
{
    public function index(): View
    {
        $kuis = Evaluasi::active()
            ->with(['soal' => fn($q) => $q->orderBy('urutan')])
            ->orderBy('urutan')
            ->get();

        $totalSoal  = $kuis->sum(fn($k) => $k->soal->count());
        $totalPaket = $kuis->count();

        return view('evaluasi.index', compact('kuis', 'totalSoal', 'totalPaket'));
    }
}
