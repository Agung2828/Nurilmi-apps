@extends('admin.layouts.admin')
@section('title', 'Edit Materi')
@section('breadcrumb', '<a href="' . route('admin.materi.index') . '">Materi</a> › Edit')

@section('admin-content')
    <div class="form-card">
        <form method="POST" action="{{ route('admin.materi.update', $materi) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Topik *</label>
                    <select name="topik" class="form-control" required>
                        <option value="zakat" {{ $materi->topik == 'zakat' ? 'selected' : '' }}>🤲 Zakat</option>
                        <option value="mawaris" {{ $materi->topik == 'mawaris' ? 'selected' : '' }}>⚖️ Mawaris</option>
                        <option value="haji" {{ $materi->topik == 'haji' ? 'selected' : '' }}>🕋 Haji</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Urutan</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $materi->urutan) }}"
                        min="0">
                </div>

                <div class="form-group full">
                    <label class="form-label">Judul Materi *</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $materi->judul) }}"
                        required>
                    @error('judul')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">Sub Judul</label>
                    <input type="text" name="sub_judul" class="form-control"
                        value="{{ old('sub_judul', $materi->sub_judul) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Badge / Pertemuan</label>
                    <input type="text" name="badge" class="form-control" value="{{ old('badge', $materi->badge) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" {{ $materi->is_active ? 'selected' : '' }}>✅ Aktif</option>
                        <option value="0" {{ !$materi->is_active ? 'selected' : '' }}>❌ Nonaktif</option>
                    </select>
                </div>

                <div class="form-group full">
                    <label class="form-label">Konten Materi *</label>
                    <textarea name="konten" class="form-control" style="min-height:200px;" required>{{ old('konten', $materi->konten) }}</textarea>
                    @error('konten')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">File PDF (kosongkan jika tidak diganti)</label>
                    @if ($materi->pdf)
                        <div class="current-pdf">📄 File saat ini: <a href="{{ asset('storage/' . $materi->pdf) }}"
                                target="_blank" style="color:var(--emerald-ll);">{{ basename($materi->pdf) }}</a></div>
                    @endif
                    <input type="file" name="pdf" class="form-control" accept=".pdf" style="margin-top:.4rem;">
                    <div class="form-hint">Upload file baru untuk mengganti. Maks 10 MB.</div>
                    @error('pdf')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Perbarui Materi</button>
                <a href="{{ route('admin.materi.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
@endsection
