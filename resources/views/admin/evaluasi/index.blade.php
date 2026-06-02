@extends('admin.layouts.admin')
@section('title', 'Kelola Evaluasi')
@section('breadcrumb', 'Evaluasi › Paket Kuis')

@section('admin-content')
    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">📝 Daftar Paket Kuis ({{ $kuis->total() }})</div>
            <a href="{{ route('admin.evaluasi.create') }}" class="btn-add">➕ Tambah Paket Kuis</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Topik</th>
                        <th>Kesulitan</th>
                        <th>Soal</th>
                        <th>Durasi</th>
                        <th>Lulus</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kuis as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="td-title">{{ $k->icon }} {{ $k->judul }}</div>
                                <div style="font-size:.7rem;color:var(--text-muted);">{{ Str::limit($k->deskripsi, 55) }}
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-{{ $k->topik[0] }}">{{ ucfirst($k->topik) }}</span>
                            </td>
                            <td>
                                @php
                                    $cls = match ($k->kesulitan) {
                                        'mudah' => 'badge-active',
                                        'sedang' => 'badge-h',
                                        'sulit' => 'badge-inactive',
                                    };
                                @endphp
                                <span class="badge {{ $cls }}">{{ ucfirst($k->kesulitan) }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.evaluasi.soal.index', $k) }}"
                                    style="color:var(--emerald-ll);font-weight:700;">
                                    {{ $k->soal_count }} soal
                                </a>
                            </td>
                            <td>{{ $k->durasi_menit }} mnt</td>
                            <td>≥ {{ $k->skor_lulus }}</td>
                            <td>
                                <span class="badge {{ $k->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $k->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>
                                <div class="td-actions">
                                    <a href="{{ route('admin.evaluasi.soal.index', $k) }}" class="btn-edit">📋 Soal</a>
                                    <a href="{{ route('admin.evaluasi.edit', $k) }}" class="btn-edit">✏️ Edit</a>
                                    <form method="POST" action="{{ route('admin.evaluasi.destroy', $k) }}"
                                        onsubmit="return confirm('Hapus paket kuis ini beserta semua soalnya?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete">🗑️ Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align:center;padding:2rem;color:var(--text-muted);">
                                Belum ada paket kuis.
                                <a href="{{ route('admin.evaluasi.create') }}" style="color:var(--emerald-ll);">Tambah
                                    sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($kuis->hasPages())
            <div class="pagination-wrap">{{ $kuis->links() }}</div>
        @endif
    </div>
@endsection
