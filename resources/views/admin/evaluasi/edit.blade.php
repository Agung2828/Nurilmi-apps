@extends('admin.layouts.admin')
@section('title', 'Edit Paket Kuis')
@section('breadcrumb', '<a href="' . route('admin.evaluasi.index') . '">Evaluasi</a> › Edit')

@section('admin-content')
    <div class="form-card">
        <form method="POST" action="{{ route('admin.evaluasi.update', $evaluasi) }}">
            @csrf @method('PUT')
            <div class="form-grid">

                <div class="form-group full">
                    <label class="form-label">Judul Paket Kuis <span style="color:#f87171">*</span></label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $evaluasi->judul) }}"
                        required>
                    @error('judul')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Topik <span style="color:#f87171">*</span></label>
                    <select name="topik" class="form-control" required>
                        <option value="zakat" {{ old('topik', $evaluasi->topik) == 'zakat' ? 'selected' : '' }}>🤲 Zakat
                        </option>
                        <option value="mawaris" {{ old('topik', $evaluasi->topik) == 'mawaris' ? 'selected' : '' }}>⚖️
                            Mawaris</option>
                        <option value="haji" {{ old('topik', $evaluasi->topik) == 'haji' ? 'selected' : '' }}>🕋 Haji
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tingkat Kesulitan <span style="color:#f87171">*</span></label>
                    <select name="kesulitan" class="form-control" required>
                        <option value="mudah" {{ old('kesulitan', $evaluasi->kesulitan) == 'mudah' ? 'selected' : '' }}>✅
                            Mudah</option>
                        <option value="sedang" {{ old('kesulitan', $evaluasi->kesulitan) == 'sedang' ? 'selected' : '' }}>⚡
                            Sedang</option>
                        <option value="sulit" {{ old('kesulitan', $evaluasi->kesulitan) == 'sulit' ? 'selected' : '' }}>🔥
                            Sulit</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Icon (Emoji)</label>
                    <input type="text" name="icon" class="form-control" value="{{ old('icon', $evaluasi->icon) }}"
                        maxlength="10">
                </div>

                <div class="form-group">
                    <label class="form-label">Durasi (menit) <span style="color:#f87171">*</span></label>
                    <input type="number" name="durasi_menit" class="form-control"
                        value="{{ old('durasi_menit', $evaluasi->durasi_menit) }}" min="1" max="180" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Skor Kelulusan</label>
                    <input type="number" name="skor_lulus" class="form-control"
                        value="{{ old('skor_lulus', $evaluasi->skor_lulus) }}" min="1" max="100" required>
                </div>

                <div class="form-group full">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $evaluasi->deskripsi) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control"
                        value="{{ old('urutan', $evaluasi->urutan) }}" min="0">
                </div>

                <div class="form-group" style="justify-content:center;">
                    <label class="form-label">Status</label>
                    <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;margin-top:.4rem;">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $evaluasi->is_active) ? 'checked' : '' }} style="width:16px;height:16px;">
                        <span style="font-size:.85rem;color:var(--text-main);">Aktif</span>
                    </label>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Perbarui</button>
                <a href="{{ route('admin.evaluasi.soal.index', $evaluasi) }}" class="btn-cancel">
                    📋 Kelola Soal ({{ $soal->count() }})
                </a>
                <a href="{{ route('admin.evaluasi.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>

    {{-- Preview soal mini --}}
    @if ($soal->count())
        <div class="admin-card" style="margin-top:1.5rem;">
            <div class="admin-card-header">
                <div class="admin-card-title">📋 Soal dalam Paket Ini ({{ $soal->count() }})</div>
                <a href="{{ route('admin.evaluasi.soal.create', $evaluasi) }}" class="btn-add">➕ Tambah Soal</a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($soal as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="max-width:400px;">{{ Str::limit($s->pertanyaan, 80) }}</td>
                                <td><span class="badge badge-active">{{ strtoupper($s->jawaban_benar) }}</span></td>
                                <td>
                                    <div class="td-actions">
                                        <a href="{{ route('admin.soal.edit', $s) }}" class="btn-edit">✏️ Edit</a>
                                        <form method="POST" action="{{ route('admin.soal.destroy', $s) }}"
                                            onsubmit="return confirm('Hapus soal ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-delete">🗑️</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
