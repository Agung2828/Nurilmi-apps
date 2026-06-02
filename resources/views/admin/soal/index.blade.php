@extends('admin.layouts.admin')
@section('title', 'Kelola Soal')
@section('breadcrumb',
    '<a href="' .
        route('admin.evaluasi.index') .
        '">Evaluasi</a> › <a
        href="' .
        route('admin.evaluasi.edit', $evaluasi) .
        '">' .
        $evaluasi->icon .
        ' ' .
        $evaluasi->judul .
        '</a> › Soal')

@section('admin-content')

    {{-- Info paket --}}
    <div class="admin-card" style="margin-bottom:1.5rem;">
        <div class="admin-card-header">
            <div>
                <div class="admin-card-title">{{ $evaluasi->icon }} {{ $evaluasi->judul }}</div>
                <div style="font-size:.78rem;color:var(--text-muted);margin-top:.25rem;">
                    Topik: <strong>{{ ucfirst($evaluasi->topik) }}</strong> &nbsp;·&nbsp;
                    Kesulitan: <strong>{{ ucfirst($evaluasi->kesulitan) }}</strong> &nbsp;·&nbsp;
                    Durasi: <strong>{{ $evaluasi->durasi_menit }} menit</strong> &nbsp;·&nbsp;
                    Skor Lulus: <strong>≥ {{ $evaluasi->skor_lulus }}</strong>
                </div>
            </div>
            <div style="display:flex;gap:.6rem;">
                <a href="{{ route('admin.evaluasi.soal.create', $evaluasi) }}" class="btn-add">➕ Tambah Soal</a>
                <a href="{{ route('admin.evaluasi.edit', $evaluasi) }}" class="btn-cancel" style="padding:.5rem 1rem;">⚙️
                    Edit Paket</a>
            </div>
        </div>
    </div>

    {{-- Tabel soal --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">📋 Daftar Soal ({{ $soal->total() }})</div>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Pertanyaan</th>
                        <th style="width:80px;">Jawaban</th>
                        <th style="width:60px;">Urutan</th>
                        <th style="width:130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($soal as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div style="font-weight:600;color:var(--text-main);margin-bottom:.3rem;">
                                    {{ Str::limit($s->pertanyaan, 90) }}
                                </div>
                                <div
                                    style="font-size:.72rem;color:var(--text-muted);display:flex;gap:.4rem;flex-wrap:wrap;">
                                    <span>A: {{ Str::limit($s->opsi_a, 30) }}</span>
                                    <span>·</span>
                                    <span>B: {{ Str::limit($s->opsi_b, 30) }}</span>
                                    <span>·</span>
                                    <span>C: {{ Str::limit($s->opsi_c, 30) }}</span>
                                    <span>·</span>
                                    <span>D: {{ Str::limit($s->opsi_d, 30) }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-active" style="font-size:.85rem;font-weight:800;">
                                    {{ strtoupper($s->jawaban_benar) }}
                                </span>
                            </td>
                            <td style="text-align:center;">{{ $s->urutan }}</td>
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
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;padding:2.5rem;color:var(--text-muted);">
                                Belum ada soal untuk paket ini.
                                <a href="{{ route('admin.evaluasi.soal.create', $evaluasi) }}"
                                    style="color:var(--emerald-ll);">Tambah soal pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($soal->hasPages())
            <div class="pagination-wrap">{{ $soal->links() }}</div>
        @endif
    </div>

@endsection
