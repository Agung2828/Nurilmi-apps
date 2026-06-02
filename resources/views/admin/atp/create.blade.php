@extends('admin.layouts.admin')
@section('title', 'Tambah Section ATP')
@section('breadcrumb', '<a href="' . route('admin.atp.index') . '">ATP</a> › Tambah')

@section('admin-content')
    <div class="form-card">
        <form method="POST" action="{{ route('admin.atp.store') }}">
            @csrf
            <div class="form-grid">

                {{-- Tipe --}}
                <div class="form-group">
                    <label class="form-label">Tipe Section <span style="color:#f87171">*</span></label>
                    <select name="tipe" class="form-control" id="tipeSelect" required onchange="toggleFields()">
                        <option value="">— Pilih Tipe —</option>
                        <option value="cp" {{ old('tipe') == 'cp' ? 'selected' : '' }}>🎯 CP — Capaian
                            Pembelajaran</option>
                        <option value="tp" {{ old('tipe') == 'tp' ? 'selected' : '' }}>📌 TP — Tujuan Pembelajaran
                        </option>
                        <option value="timeline" {{ old('tipe') == 'timeline' ? 'selected' : '' }}>📅 Timeline — Alur
                            Pembelajaran</option>
                        <option value="topik" {{ old('tipe') == 'topik' ? 'selected' : '' }}>📋 Sub-Topik Detail
                        </option>
                    </select>
                    @error('tipe')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Topik --}}
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

                {{-- Judul --}}
                <div class="form-group full">
                    <label class="form-label">Judul <span style="color:#f87171">*</span></label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}"
                        placeholder="Judul utama section ini" required>
                    @error('judul')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Sub Judul --}}
                <div class="form-group full">
                    <label class="form-label">Sub Judul / Badge Label</label>
                    <input type="text" name="sub_judul" class="form-control" value="{{ old('sub_judul') }}"
                        placeholder="cth: CP — Zakat  |  TP 1 — Zakat  |  Pertemuan 1">
                    <div class="form-hint">Teks pada label kecil di atas judul</div>
                </div>

                {{-- Isi --}}
                <div class="form-group full">
                    <label class="form-label">Isi / Deskripsi <span style="color:#f87171">*</span></label>
                    <textarea name="isi" class="form-control" rows="5" placeholder="Deskripsi lengkap section ini..." required>{{ old('isi') }}</textarea>
                    @error('isi')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Minggu — khusus Timeline --}}
                <div class="form-group" id="fieldMinggu" style="display:none;">
                    <label class="form-label">Label Minggu / Pertemuan</label>
                    <input type="text" name="minggu" class="form-control" value="{{ old('minggu') }}"
                        placeholder="Pertemuan 1–2 · Zakat">
                    <div class="form-hint">Khusus tipe <b>Timeline</b></div>
                </div>

                {{-- Chips — khusus Timeline --}}
                <div class="form-group" id="fieldChips" style="display:none;">
                    <label class="form-label">Chips / Tag Metode</label>
                    <input type="text" name="chips" class="form-control" value="{{ old('chips') }}"
                        placeholder="Tatap Muka, Diskusi Kelompok, 2 × 2 JP">
                    <div class="form-hint">Pisahkan dengan koma. Khusus tipe <b>Timeline</b></div>
                </div>

                {{-- Tags — khusus TP --}}
                <div class="form-group full" id="fieldTags" style="display:none;">
                    <label class="form-label">Tags / Level Bloom</label>
                    <input type="text" name="tags" class="form-control" value="{{ old('tags') }}"
                        placeholder="C1 Mengingat, C2 Memahami">
                    <div class="form-hint">Pisahkan dengan koma. Khusus tipe <b>TP</b></div>
                </div>

                {{-- Urutan --}}
                <div class="form-group">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}"
                        min="0">
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;margin-top:.4rem;">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', true) ? 'checked' : '' }} style="width:16px;height:16px;">
                        <span style="font-size:.85rem;color:var(--text-main);">Aktif (tampil di halaman ATP)</span>
                    </label>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Simpan Section</button>
                <a href="{{ route('admin.atp.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleFields() {
            const tipe = document.getElementById('tipeSelect').value;
            document.getElementById('fieldMinggu').style.display = tipe === 'timeline' ? '' : 'none';
            document.getElementById('fieldChips').style.display = tipe === 'timeline' ? '' : 'none';
            document.getElementById('fieldTags').style.display = tipe === 'tp' ? '' : 'none';
        }
        document.addEventListener('DOMContentLoaded', toggleFields);
    </script>
@endpush
