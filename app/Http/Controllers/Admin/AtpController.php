<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AtpSection;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AtpController extends Controller
{
    // ── INDEX ──────────────────────────────────────────────
    public function index(): View
    {
        $sections = AtpSection::orderBy('tipe')->orderBy('urutan')->paginate(15);
        return view('admin.atp.index', compact('sections'));
    }

    // ── CREATE ─────────────────────────────────────────────
    public function create(): View
    {
        return view('admin.atp.create');
    }

    // ── STORE ──────────────────────────────────────────────
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'tipe'        => 'required|in:cp,tp,timeline,topik',
            'topik'       => 'required|in:zakat,mawaris,haji',
            'judul'       => 'required|string|max:255',
            'sub_judul'   => 'nullable|string|max:255',
            'isi'         => 'required|string',
            'icon'        => 'nullable|string|max:10',
            'badge_style' => 'nullable|string|max:255',
            'minggu'      => 'nullable|string|max:100',
            'chips'       => 'nullable|string',   // comma-separated → disimpan JSON
            'tags'        => 'nullable|string',   // comma-separated → disimpan JSON
            'urutan'      => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        AtpSection::create([
            'tipe'        => $request->tipe,
            'topik'       => $request->topik,
            'judul'       => $request->judul,
            'sub_judul'   => $request->sub_judul,
            'isi'         => $request->isi,
            'icon'        => $request->icon,
            'badge_style' => $request->badge_style,
            'minggu'      => $request->minggu,
            // Simpan chips & tags sebagai JSON array dari input comma-separated
            'chips'       => $this->toJson($request->chips),
            'tags'        => $this->toJson($request->tags),
            'urutan'      => $request->urutan ?? 0,
            'is_active'   => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.atp.index')
            ->with('success', 'Section ATP berhasil ditambahkan!');
    }

    // ── EDIT ───────────────────────────────────────────────
    public function edit(AtpSection $atp): View
    {
        return view('admin.atp.edit', compact('atp'));
    }

    // ── UPDATE ─────────────────────────────────────────────
    public function update(Request $request, AtpSection $atp): RedirectResponse
    {
        $request->validate([
            'tipe'        => 'required|in:cp,tp,timeline,topik',
            'topik'       => 'required|in:zakat,mawaris,haji',
            'judul'       => 'required|string|max:255',
            'sub_judul'   => 'nullable|string|max:255',
            'isi'         => 'required|string',
            'icon'        => 'nullable|string|max:10',
            'badge_style' => 'nullable|string|max:255',
            'minggu'      => 'nullable|string|max:100',
            'chips'       => 'nullable|string',
            'tags'        => 'nullable|string',
            'urutan'      => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        $atp->update([
            'tipe'        => $request->tipe,
            'topik'       => $request->topik,
            'judul'       => $request->judul,
            'sub_judul'   => $request->sub_judul,
            'isi'         => $request->isi,
            'icon'        => $request->icon,
            'badge_style' => $request->badge_style,
            'minggu'      => $request->minggu,
            'chips'       => $this->toJson($request->chips),
            'tags'        => $this->toJson($request->tags),
            'urutan'      => $request->urutan ?? $atp->urutan,
            'is_active'   => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.atp.index')
            ->with('success', 'Section ATP berhasil diperbarui!');
    }

    // ── DESTROY ────────────────────────────────────────────
    public function destroy(AtpSection $atp): RedirectResponse
    {
        $atp->delete();
        return redirect()->route('admin.atp.index')
            ->with('success', 'Section ATP berhasil dihapus!');
    }

    // ── HELPER: comma-separated → JSON ────────────────────
    private function toJson(?string $input): ?string
    {
        if (!$input || trim($input) === '') return null;
        $arr = array_map('trim', explode(',', $input));
        $arr = array_filter($arr); // hapus elemen kosong
        return json_encode(array_values($arr));
    }
}
