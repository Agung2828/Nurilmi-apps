@extends('admin.layouts.admin')
@section('title', 'Tambah Paket Kuis')
@section('breadcrumb', '<a href="' . route('admin.evaluasi.index') . '">Evaluasi</a> › Tambah')

@section('admin-content')
    <div class="form-card">
        <form method="POST" action="{{ route('admin.evaluasi.store') }}">
            @csrf
            <div class="form-grid">

                <div class="form-group full">
                    <label class="form-label">Judul Paket Kuis <span style="color:#f87171">*</span></label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}"
                        placeholder="Contoh: Zakat — Konsep Dasar" required>
                    @error('judul')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Topik <span style="color:#f87171">*</span></label>
                    <select name="topik" class="form-control" required>
                        <option value="">— Pilih Topik —</option>
                        <option value="zakat" {{ old('topik') == 'zakat' ? 'selected' : '' }}>🤲 Zakat</option>
                        <option value="mawaris" {{ old('topik') == 'mawaris' ? 'selected' : '' }}>⚖️ Mawaris</option>
                        <option value="haji" {{ old('topik') == 'haji' ? 'selected' : '' }}>🕋 Haji</option>
                    </select>
                    @error('topik')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Tingkat Kesulitan <span style="color:#f87171">*</span></label>
                    <select name="kesulitan" class="form-control" required>
                        <option value="">— Pilih Kesulitan —</option>
                        <option value="mudah" {{ old('kesulitan') == 'mudah' ? 'selected' : '' }}>✅ Mudah</option>
                        <option value="sedang" {{ old('kesulitan') == 'sedang' ? 'selected' : '' }}>⚡ Sedang</option>
                        <option value="sulit" {{ old('kesulitan') == 'sulit' ? 'selected' : '' }}>🔥 Sulit</option>
                    </select>
                    @error('kesulitan')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Icon (Emoji)</label>
                    <input type="text" name="icon" class="form-control" value="{{ old('icon', '📝') }}"
                        maxlength="10" placeholder="📝">
                </div>

                <div class="form-group">
                    <label class="form-label">Durasi (menit) <span style="color:#f87171">*</span></label>
                    <input type="number" name="durasi_menit" class="form-control" value="{{ old('durasi_menit', 20) }}"
                        min="1" max="180" required>
                    @error('durasi_menit')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Skor Kelulusan <span style="color:#f87171">*</span></label>
                    <input type="number" name="skor_lulus" class="form-control" value="{{ old('skor_lulus', 75) }}"
                        min="1" max="100" required>
                    @error('skor_lulus')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi singkat paket kuis ini...">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}"
                        min="0">
                </div>

                <div class="form-group" style="justify-content:center;">
                    <label class="form-label">Status</label>
                    <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;margin-top:.4rem;">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', true) ? 'checked' : '' }} style="width:16px;height:16px;">
                        <span style="font-size:.85rem;color:var(--text-main);">Aktif</span>
                    </label>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Simpan</button>
                <a href="{{ route('admin.evaluasi.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
@endsection
