<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    // Halaman materi (user & guest bisa akses)
    public function index(Request $request)
    {
        $topik  = $request->get('topik', 'all');
        $search = $request->get('search');

        $query = Materi::active()->orderBy('topik')->orderBy('urutan');

        if ($topik !== 'all') {
            $query->byTopik($topik);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        $materis = $query->get()->groupBy('topik');

        return view('materi.index', compact('materis', 'topik', 'search'));
    }

    // Detail satu materi
    public function show(Materi $materi)
    {
        if (!$materi->is_active) {
            abort(404);
        }
        return view('materi.show', compact('materi'));
    }
}
