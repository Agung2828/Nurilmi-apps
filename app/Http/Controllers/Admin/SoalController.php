<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluasi;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SoalController extends Controller
{
    public function index(Evaluasi $evaluasi): View
    {
        $soal = $evaluasi->soal()->orderBy('urutan')->paginate(15);
        return view('admin.soal.index', compact('evaluasi', 'soal'));
    }

    public function create(Evaluasi $evaluasi): View
    {
        return view('admin.soal.create', compact('evaluasi'));
    }

    public function store(Request $request, Evaluasi $evaluasi): RedirectResponse
    {
        $request->validate([
            'pertanyaan'    => 'required|string',
            'opsi_a'        => 'required|string|max:500',
            'opsi_b'        => 'required|string|max:500',
            'opsi_c'        => 'required|string|max:500',
            'opsi_d'        => 'required|string|max:500',
            'jawaban_benar' => 'required|in:a,b,c,d',
            'pembahasan'    => 'nullable|string',
            'urutan'        => 'nullable|integer',
        ]);

        $evaluasi->soal()->create([
            'pertanyaan'    => $request->pertanyaan,
            'opsi_a'        => $request->opsi_a,
            'opsi_b'        => $request->opsi_b,
            'opsi_c'        => $request->opsi_c,
            'opsi_d'        => $request->opsi_d,
            'jawaban_benar' => $request->jawaban_benar,
            'pembahasan'    => $request->pembahasan,
            'urutan'        => $request->urutan ?? $evaluasi->soal()->count(),
        ]);

        if ($request->has('save_and_add')) {
            return redirect()->route('admin.evaluasi.soal.create', $evaluasi)
                ->with('success', 'Soal berhasil ditambahkan! Tambah soal berikutnya.');
        }

        return redirect()->route('admin.evaluasi.soal.index', $evaluasi)
            ->with('success', 'Soal berhasil ditambahkan!');
    }

    public function edit(Evaluasi $evaluasi, Soal $soal): View
    {
        return view('admin.soal.edit', compact('evaluasi', 'soal'));
    }

    public function update(Request $request, Evaluasi $evaluasi, Soal $soal): RedirectResponse
    {
        $request->validate([
            'pertanyaan'    => 'required|string',
            'opsi_a'        => 'required|string|max:500',
            'opsi_b'        => 'required|string|max:500',
            'opsi_c'        => 'required|string|max:500',
            'opsi_d'        => 'required|string|max:500',
            'jawaban_benar' => 'required|in:a,b,c,d',
            'pembahasan'    => 'nullable|string',
            'urutan'        => 'nullable|integer',
        ]);

        $soal->update([
            'pertanyaan'    => $request->pertanyaan,
            'opsi_a'        => $request->opsi_a,
            'opsi_b'        => $request->opsi_b,
            'opsi_c'        => $request->opsi_c,
            'opsi_d'        => $request->opsi_d,
            'jawaban_benar' => $request->jawaban_benar,
            'pembahasan'    => $request->pembahasan,
            'urutan'        => $request->urutan ?? $soal->urutan,
        ]);

        return redirect()->route('admin.evaluasi.soal.index', $evaluasi)
            ->with('success', 'Soal berhasil diperbarui!');
    }

    public function destroy(Evaluasi $evaluasi, Soal $soal): RedirectResponse
    {
        $soal->delete();
        return redirect()->route('admin.evaluasi.soal.index', $evaluasi)
            ->with('success', 'Soal berhasil dihapus!');
    }
}
