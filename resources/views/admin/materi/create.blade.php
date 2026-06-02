@extends('admin.layouts.admin')
@section('title', 'Tambah Materi')
@section('breadcrumb', '<a href="' . route('admin.materi.index') . '">Materi</a> › Tambah')

@section('admin-content')
    <div class="form-card">
        <form method="POST" action="{{ route('admin.materi.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Topik *</label>
                    <select name="topik" class="form-control" required>
                        <option value="">-- Pilih Topik --</option>
                        <option value="zakat" {{ old('topik') == 'zakat' ? 'selected' : '' }}>🤲 Zakat</option>
                        <option value="mawaris" {{ old('topik') == 'mawaris' ? 'selected' : '' }}>⚖️ Mawaris</option>
                        <option value="haji" {{ old('topik') == 'haji' ? 'selected' : '' }}>🕋 Haji</option>
                    </select>
                    @error('topik')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Urutan</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
                </div>

                <div class="form-group full">
                    <label class="form-label">Judul Materi *</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required
                        placeholder="contoh: Pengertian & Dalil Zakat">
                    @error('judul')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">Sub Judul</label>
                    <input type="text" name="sub_judul" class="form-control" value="{{ old('sub_judul') }}"
                        placeholder="contoh: Definisi, landasan syar'i, dan sejarah zakat">
                </div>

                <div class="form-group">
                    <label class="form-label">Badge / Pertemuan</label>
                    <input type="text" name="badge" class="form-control" value="{{ old('badge') }}"
                        placeholder="contoh: Pertemuan 1">
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>✅ Aktif</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>❌ Nonaktif</option>
                    </select>
                </div>

                <div class="form-group full">
                    <label class="form-label">Konten Materi * (HTML diperbolehkan)</label>
                    <textarea name="konten" class="form-control" style="min-height:200px;" required
                        placeholder="Tulis konten materi di sini...">{{ old('konten') }}</textarea>
                    @error('konten')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">File PDF (opsional, maks 10MB)</label>
                    <input type="file" name="pdf" class="form-control" accept=".pdf">
                    <div class="form-hint">Format: PDF. Maksimal 10 MB.</div>
                    @error('pdf')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Simpan Materi</button>
                <a href="{{ route('admin.materi.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
@endsection
