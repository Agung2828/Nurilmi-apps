@extends('admin.layouts.admin')
@section('title', 'Edit Soal')
@section('breadcrumb', '<a href="' . route('admin.evaluasi.index') . '">Evaluasi</a> › <a
        href="' . route('admin.soal.index', $soal->kuis_id) . '">Soal</a> › Edit')

@section('admin-content')
    <div class="form-card">
        <form method="POST" action="{{ route('admin.soal.update', $soal) }}">
            @csrf @method('PUT')
            <div class="form-grid">

                <div class="form-group full">
                    <label class="form-label">Pertanyaan <span style="color:#f87171">*</span></label>
                    <textarea name="pertanyaan" class="form-control" rows="3" required>{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                    @error('pertanyaan')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">Opsi A <span style="color:#f87171">*</span></label>
                    <input type="text" name="opsi_a" class="form-control" value="{{ old('opsi_a', $soal->opsi_a) }}"
                        required>
                    @error('opsi_a')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">Opsi B <span style="color:#f87171">*</span></label>
                    <input type="text" name="opsi_b" class="form-control" value="{{ old('opsi_b', $soal->opsi_b) }}"
                        required>
                    @error('opsi_b')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">Opsi C <span style="color:#f87171">*</span></label>
                    <input type="text" name="opsi_c" class="form-control" value="{{ old('opsi_c', $soal->opsi_c) }}"
                        required>
                    @error('opsi_c')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">Opsi D <span style="color:#f87171">*</span></label>
                    <input type="text" name="opsi_d" class="form-control" value="{{ old('opsi_d', $soal->opsi_d) }}"
                        required>
                    @error('opsi_d')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Jawaban Benar <span style="color:#f87171">*</span></label>
                    <select name="jawaban_benar" class="form-control" required>
                        <option value="a" {{ old('jawaban_benar', $soal->jawaban_benar) == 'a' ? 'selected' : '' }}>A
                        </option>
                        <option value="b" {{ old('jawaban_benar', $soal->jawaban_benar) == 'b' ? 'selected' : '' }}>B
                        </option>
                        <option value="c" {{ old('jawaban_benar', $soal->jawaban_benar) == 'c' ? 'selected' : '' }}>C
                        </option>
                        <option value="d" {{ old('jawaban_benar', $soal->jawaban_benar) == 'd' ? 'selected' : '' }}>D
                        </option>
                    </select>
                    @error('jawaban_benar')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $soal->urutan) }}"
                        min="0">
                </div>

                <div class="form-group full">
                    <label class="form-label">Pembahasan
                        <span style="font-size:.75rem;color:var(--text-muted);">(opsional)</span>
                    </label>
                    <textarea name="pembahasan" class="form-control" rows="3">{{ old('pembahasan', $soal->pembahasan) }}</textarea>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Perbarui Soal</button>
                <a href="{{ route('admin.soal.index', $soal->kuis_id) }}" class="btn-cancel">← Kembali ke Daftar Soal</a>
            </div>
        </form>
    </div>
@endsection
