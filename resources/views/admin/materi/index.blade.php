@extends('admin.layouts.admin')
@section('title', 'Kelola Materi')
@section('breadcrumb', 'Materi')

@section('admin-content')
    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">📚 Daftar Materi ({{ $materis->total() }})</div>
            <a href="{{ route('admin.materi.create') }}" class="btn-add">➕ Tambah Materi</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Topik</th>
                        <th>Badge</th>
                        <th>Urutan</th>
                        <th>PDF</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materis as $m)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="td-title">{{ $m->judul }}</div>
                                <div style="font-size:.7rem;color:var(--text-muted);">{{ Str::limit($m->sub_judul, 50) }}
                                </div>
                            </td>
                            <td><span class="badge badge-{{ $m->topik[0] }}">{{ ucfirst($m->topik) }}</span></td>
                            <td>{{ $m->badge ?? '—' }}</td>
                            <td>{{ $m->urutan }}</td>
                            <td>
                                @if ($m->pdf)
                                    <a href="{{ asset('storage/' . $m->pdf) }}" target="_blank"
                                        style="color:var(--emerald-ll);font-size:.72rem;">📄 Lihat</a>
                                @else
                                    <span style="color:var(--text-muted);font-size:.72rem;">—</span>
                                @endif
                            </td>
                            <td><span
                                    class="badge {{ $m->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $m->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                            </td>
                            <td>
                                <div class="td-actions">
                                    <a href="{{ route('admin.materi.edit', $m) }}" class="btn-edit">✏️ Edit</a>
                                    <form method="POST" action="{{ route('admin.materi.destroy', $m) }}"
                                        onsubmit="return confirm('Hapus materi ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete">🗑️ Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center;padding:2rem;color:var(--text-muted);">Belum ada
                                materi. <a href="{{ route('admin.materi.create') }}"
                                    style="color:var(--emerald-ll);">Tambah sekarang</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($materis->hasPages())
            <div class="pagination-wrap">{{ $materis->links() }}</div>
        @endif
    </div>
@endsection
