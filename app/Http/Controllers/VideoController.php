<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $topik  = $request->get('topik', 'all');
        $search = $request->get('search');

        $query = Video::active()->orderBy('topik')->orderBy('urutan');

        if ($topik !== 'all') {
            $query->byTopik($topik);
        }

        if ($search) {
            $query->where('judul', 'like', "%{$search}%");
        }

        $videos = $query->get();

        // Statistik per topik
        $stats = [
            'zakat'   => Video::active()->byTopik('zakat')->count(),
            'mawaris' => Video::active()->byTopik('mawaris')->count(),
            'haji'    => Video::active()->byTopik('haji')->count(),
            'total'   => Video::active()->count(),
        ];

        return view('video.index', compact('videos', 'topik', 'search', 'stats'));
    }
}
