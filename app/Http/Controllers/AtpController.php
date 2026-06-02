<?php

namespace App\Http\Controllers;

use App\Models\AtpSection;
use Illuminate\View\View;

class AtpController extends Controller
{
    public function index(): View
    {
        // Ambil semua section aktif, group by tipe
        $cp       = AtpSection::active()->ofTipe('cp')->get();
        $tp       = AtpSection::active()->ofTipe('tp')->get();
        $timeline = AtpSection::active()->ofTipe('timeline')->get();

        // Topik tabs: zakat, mawaris, haji — masing-masing ambil sub-topik
        $topikZakat   = AtpSection::active()->ofTipe('topik')->ofTopik('zakat')->get();
        $topikMawaris = AtpSection::active()->ofTipe('topik')->ofTopik('mawaris')->get();
        $topikHaji    = AtpSection::active()->ofTipe('topik')->ofTopik('haji')->get();

        return view('ATP.index', compact(
            'cp',
            'tp',
            'timeline',
            'topikZakat',
            'topikMawaris',
            'topikHaji'
        ));
    }
}
