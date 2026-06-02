@extends('admin.layouts.admin')
@section('title', 'Edit Section ATP')
@section('breadcrumb', '<a href="' . route('admin.atp.index') . '">ATP</a> › Edit')

@section('admin-content')
    <div class="form-card">
        <form method="POST" action="{{ route('admin.atp.update', $atp) }}">
            @csrf @method('PUT')
            <div class="form-grid">

                {{-- Tipe --}}
                <div class="form-group">
                    <label class="form-label">Tipe Section <span style="color:#f87171">*</span></label>
                    <select name="tipe" class="form-control" id="tipeSelect" required onchange="toggleFields()">
                        <option value="cp" {{ old('tipe', $atp->tipe) == 'cp' ? 'selected' : '' }}>🎯 CP — Capaian
                            Pembelajaran</option>
                        <option value="tp" {{ old('tipe', $atp->tipe) == 'tp' ? 'selected' : '' }}>📌 TP — Tujuan
                            Pembelajaran</option>
                        <option value="timeline" {{ old('tipe', $atp->tipe) == 'timeline' ? 'selected' : '' }}>📅 Timeline
                        </option>
                        <option value="topik" {{ old('tipe', $atp->tipe) == 'topik' ? 'selected' : '' }}>📋 Sub-Topik
                            Detail</option>
                    </select>
                    @error('tipe')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Topik --}}
                <div class="form-group">
                    <label class="form-label">Topik <span style="color:#f87171">*</span></label>
                    <select name="topik" class="form-control" required>
                        <option value="zakat" {{ old('topik', $atp->topik) == 'zakat' ? 'selected' : '' }}>🤲 Zakat
                        </option>
                        <option value="mawaris" {{ old('topik', $atp->topik) == 'mawaris' ? 'selected' : '' }}>⚖️ Mawaris
                        </option>
                        <option value="haji" {{ old('topik', $atp->topik) == 'haji' ? 'selected' : '' }}>🕋 Haji
                        </option>
                    </select>
                </div>

                {{-- Judul --}}
                <div class="form-group full">
                    <label class="form-label">Judul <span style="color:#f87171">*</span></label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $atp->judul) }}"
                        required>
                    @error('judul')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Sub Judul --}}
                <div class="form-group full">
                    <label class="form-label">Sub Judul / Badge Label</label>
                    <input type="text" name="sub_judul" class="form-control"
                        value="{{ old('sub_judul', $atp->sub_judul) }}"
                        placeholder="cth: CP — Zakat  |  TP 1 — Zakat  |  Pertemuan 1">
                    <div class="form-hint">Teks pada label kecil di atas judul</div>
                </div>

                {{-- Isi --}}
                <div class="form-group full">
                    <label class="form-label">Isi / Deskripsi <span style="color:#f87171">*</span></label>
                    <textarea name="isi" class="form-control" rows="5" required>{{ old('isi', $atp->isi) }}</textarea>
                    @error('isi')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Minggu — khusus Timeline --}}
                <div class="form-group" id="fieldMinggu">
                    <label class="form-label">Label Minggu / Pertemuan</label>
                    <input type="text" name="minggu" class="form-control" value="{{ old('minggu', $atp->minggu) }}"
                        placeholder="Pertemuan 1–2 · Zakat">
                    <div class="form-hint">Khusus tipe <b>Timeline</b></div>
                </div>

                {{-- Chips — khusus Timeline --}}
                <div class="form-group" id="fieldChips">
                    <label class="form-label">Chips / Tag Metode</label>
                    @php
                        $chipsStr = $atp->chips ? implode(', ', json_decode($atp->chips, true) ?? []) : '';
                    @endphp
                    <input type="text" name="chips" class="form-control" value="{{ old('chips', $chipsStr) }}"
                        placeholder="Tatap Muka, Diskusi Kelompok, 2 × 2 JP">
                    <div class="form-hint">Pisahkan dengan koma. Khusus <b>Timeline</b></div>
                </div>

                {{-- Tags — khusus TP --}}
                <div class="form-group full" id="fieldTags">
                    <label class="form-label">Tags / Level Bloom</label>
                    @php
                        $tagsStr = $atp->tags ? implode(', ', json_decode($atp->tags, true) ?? []) : '';
                    @endphp
                    <input type="text" name="tags" class="form-control" value="{{ old('tags', $tagsStr) }}"
                        placeholder="C1 Mengingat, C2 Memahami">
                    <div class="form-hint">Pisahkan dengan koma. Khusus <b>TP</b></div>
                </div>

                {{-- Urutan --}}
                <div class="form-group">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $atp->urutan) }}"
                        min="0">
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;margin-top:.4rem;">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $atp->is_active) ? 'checked' : '' }} style="width:16px;height:16px;">
                        <span style="font-size:.85rem;color:var(--text-main);">Aktif</span>
                    </label>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Perbarui</button>
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
