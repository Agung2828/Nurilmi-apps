<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluasi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EvaluasiController extends Controller
{
    public function index(): View
    {
        $kuis = Evaluasi::withCount('soal')->orderBy('urutan')->paginate(10);
        return view('admin.evaluasi.index', compact('kuis'));
    }

    public function create(): View
    {
        return view('admin.evaluasi.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'topik'        => 'required|in:zakat,mawaris,haji',
            'kesulitan'    => 'required|in:mudah,sedang,sulit',
            'icon'         => 'nullable|string|max:10',
            'deskripsi'    => 'nullable|string',
            'durasi_menit' => 'required|integer|min:1|max:180',
            'skor_lulus'   => 'required|integer|min:1|max:100',
            'urutan'       => 'nullable|integer',
            'is_active'    => 'nullable|boolean',
        ]);

        Evaluasi::create([
            'judul'        => $request->judul,
            'topik'        => $request->topik,
            'kesulitan'    => $request->kesulitan,
            'icon'         => $request->icon ?? '📝',
            'deskripsi'    => $request->deskripsi,
            'durasi_menit' => $request->durasi_menit,
            'skor_lulus'   => $request->skor_lulus,
            'urutan'       => $request->urutan ?? 0,
            'is_active'    => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.evaluasi.index')
            ->with('success', 'Paket evaluasi berhasil ditambahkan!');
    }

    public function edit(Evaluasi $evaluasi): View
    {
        $soal = $evaluasi->soal()->orderBy('urutan')->get();
        return view('admin.evaluasi.edit', compact('evaluasi', 'soal'));
    }

    public function update(Request $request, Evaluasi $evaluasi): RedirectResponse
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'topik'        => 'required|in:zakat,mawaris,haji',
            'kesulitan'    => 'required|in:mudah,sedang,sulit',
            'icon'         => 'nullable|string|max:10',
            'deskripsi'    => 'nullable|string',
            'durasi_menit' => 'required|integer|min:1|max:180',
            'skor_lulus'   => 'required|integer|min:1|max:100',
            'urutan'       => 'nullable|integer',
            'is_active'    => 'nullable|boolean',
        ]);

        $evaluasi->update([
            'judul'        => $request->judul,
            'topik'        => $request->topik,
            'kesulitan'    => $request->kesulitan,
            'icon'         => $request->icon ?? '📝',
            'deskripsi'    => $request->deskripsi,
            'durasi_menit' => $request->durasi_menit,
            'skor_lulus'   => $request->skor_lulus,
            'urutan'       => $request->urutan ?? 0,
            'is_active'    => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.evaluasi.index')
            ->with('success', 'Paket evaluasi berhasil diperbarui!');
    }

    public function destroy(Evaluasi $evaluasi): RedirectResponse
    {
        $evaluasi->delete();
        return redirect()->route('admin.evaluasi.index')
            ->with('success', 'Paket evaluasi berhasil dihapus!');
    }
}
