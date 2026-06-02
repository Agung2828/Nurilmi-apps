<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materis = Materi::with('user')
            ->orderBy('topik')
            ->orderBy('urutan')
            ->paginate(15);
        return view('admin.materi.index', compact('materis'));
    }

    public function create()
    {
        return view('admin.materi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'topik'     => 'required|in:zakat,mawaris,haji',
            'judul'     => 'required|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'konten'    => 'required|string',
            'badge'     => 'nullable|string|max:100',
            'urutan'    => 'nullable|integer',
            'pdf'       => 'nullable|file|mimes:pdf|max:10240',
            'is_active' => 'boolean',
        ]);

        // Upload PDF jika ada
        if ($request->hasFile('pdf')) {
            $validated['pdf'] = $request->file('pdf')
                ->store('materi/pdf', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['is_active'] = $request->boolean('is_active', true);

        Materi::create($validated);

        return redirect()->route('admin.materi.index')
            ->with('success', 'Materi berhasil ditambahkan!');
    }

    public function edit(Materi $materi)
    {
        return view('admin.materi.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        $validated = $request->validate([
            'topik'     => 'required|in:zakat,mawaris,haji',
            'judul'     => 'required|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'konten'    => 'required|string',
            'badge'     => 'nullable|string|max:100',
            'urutan'    => 'nullable|integer',
            'pdf'       => 'nullable|file|mimes:pdf|max:10240',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('pdf')) {
            // Hapus PDF lama
            if ($materi->pdf) {
                Storage::disk('public')->delete($materi->pdf);
            }
            $validated['pdf'] = $request->file('pdf')
                ->store('materi/pdf', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $materi->update($validated);

        return redirect()->route('admin.materi.index')
            ->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->pdf) {
            Storage::disk('public')->delete($materi->pdf);
        }
        $materi->delete();

        return redirect()->route('admin.materi.index')
            ->with('success', 'Materi berhasil dihapus!');
    }
}
