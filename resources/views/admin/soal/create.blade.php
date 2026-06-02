@extends('admin.layouts.admin')
@section('title', 'Tambah Soal')
@section('breadcrumb',
    '<a href="' .
        route('admin.evaluasi.index') .
        '">Evaluasi</a> › <a
        href="' .
        route('admin.evaluasi.soal.index', $evaluasi) .
        '">' .
        $evaluasi->icon .
        ' ' .
        $evaluasi->judul .
        '</a> ›
    Tambah Soal')

@section('admin-content')
    <div class="form-card">
        <form method="POST" action="{{ route('admin.evaluasi.soal.store', $evaluasi) }}">
            @csrf
            <div class="form-grid">

                <div class="form-group full">
                    <label class="form-label">Pertanyaan <span style="color:#f87171">*</span></label>
                    <textarea name="pertanyaan" class="form-control" rows="3" placeholder="Tulis pertanyaan di sini..." required>{{ old('pertanyaan') }}</textarea>
                    @error('pertanyaan')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">Opsi A <span style="color:#f87171">*</span></label>
                    <input type="text" name="opsi_a" class="form-control" value="{{ old('opsi_a') }}"
                        placeholder="Pilihan A" required>
                    @error('opsi_a')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">Opsi B <span style="color:#f87171">*</span></label>
                    <input type="text" name="opsi_b" class="form-control" value="{{ old('opsi_b') }}"
                        placeholder="Pilihan B" required>
                    @error('opsi_b')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">Opsi C <span style="color:#f87171">*</span></label>
                    <input type="text" name="opsi_c" class="form-control" value="{{ old('opsi_c') }}"
                        placeholder="Pilihan C" required>
                    @error('opsi_c')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">Opsi D <span style="color:#f87171">*</span></label>
                    <input type="text" name="opsi_d" class="form-control" value="{{ old('opsi_d') }}"
                        placeholder="Pilihan D" required>
                    @error('opsi_d')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Jawaban Benar <span style="color:#f87171">*</span></label>
                    <select name="jawaban_benar" class="form-control" required>
                        <option value="">— Pilih Jawaban —</option>
                        <option value="a" {{ old('jawaban_benar') == 'a' ? 'selected' : '' }}>A</option>
                        <option value="b" {{ old('jawaban_benar') == 'b' ? 'selected' : '' }}>B</option>
                        <option value="c" {{ old('jawaban_benar') == 'c' ? 'selected' : '' }}>C</option>
                        <option value="d" {{ old('jawaban_benar') == 'd' ? 'selected' : '' }}>D</option>
                    </select>
                    @error('jawaban_benar')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}"
                        min="0">
                </div>

                <div class="form-group full">
                    <label class="form-label">Pembahasan <span style="font-size:.75rem;color:var(--text-muted);">(opsional —
                            ditampilkan setelah menjawab)</span></label>
                    <textarea name="pembahasan" class="form-control" rows="3"
                        placeholder="Penjelasan mengapa jawaban tersebut benar...">{{ old('pembahasan') }}</textarea>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Simpan Soal</button>
                <button type="submit" name="tambah_lagi" value="1" class="btn-cancel"
                    style="background:linear-gradient(135deg,var(--emerald),var(--emerald-l));color:#fff;border:none;">
                    💾 Simpan & Tambah Lagi
                </button>
                <a href="{{ route('admin.evaluasi.soal.index', $evaluasi) }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
@endsection
