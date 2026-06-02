@extends('admin.layouts.admin')
@section('title', 'Kelola Video')
@section('breadcrumb', 'Video')

@section('admin-content')
    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">🎬 Daftar Video ({{ $videos->total() }})</div>
            <a href="{{ route('admin.video.create') }}" class="btn-add">➕ Tambah Video</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Thumb</th>
                        <th>Judul</th>
                        <th>Topik</th>
                        <th>Seri</th>
                        <th>Durasi</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($videos as $v)
                        <tr>
                            {{-- Thumbnail --}}
                            <td>
                                @if ($v->video_type === 'youtube')
                                    <img src="https://img.youtube.com/vi/{{ $v->youtube_id }}/default.jpg"
                                        class="thumbnail-prev" alt="{{ $v->judul }}">
                                @else
                                    <div
                                        style="width:80px;height:45px;background:var(--bg-muted,#e5e7eb);
                                                border-radius:4px;display:flex;align-items:center;
                                                justify-content:center;font-size:1.5rem;">
                                        📁
                                    </div>
                                @endif
                            </td>

                            {{-- Judul + info sumber --}}
                            <td>
                                <div class="td-title">{{ Str::limit($v->judul, 50) }}</div>
                                <div style="font-size:.68rem;color:var(--text-muted);">
                                    @if ($v->video_type === 'youtube')
                                        📺 YouTube — {{ $v->youtube_id }}
                                    @else
                                        📁 File lokal
                                    @endif
                                </div>
                            </td>

                            {{-- Topik --}}
                            <td>
                                <span class="badge badge-{{ $v->topik[0] }}">{{ ucfirst($v->topik) }}</span>
                            </td>

                            {{-- Seri --}}
                            <td style="font-size:.75rem;">{{ $v->seri ?? '—' }}</td>

                            {{-- Durasi --}}
                            <td>{{ $v->durasi ?? '—' }}</td>

                            {{-- Urutan --}}
                            <td>{{ $v->urutan }}</td>

                            {{-- Status --}}
                            <td>
                                <span class="badge {{ $v->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $v->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <div class="td-actions">
                                    {{-- Tombol Play sesuai tipe --}}
                                    @if ($v->video_type === 'youtube')
                                        <a href="https://youtube.com/watch?v={{ $v->youtube_id }}" target="_blank"
                                            class="btn-edit">▶ Play</a>
                                    @else
                                        <a href="{{ asset('storage/' . $v->video_path) }}" target="_blank"
                                            class="btn-edit">▶ Play</a>
                                    @endif

                                    <a href="{{ route('admin.video.edit', $v) }}" class="btn-edit">✏️ Edit</a>

                                    <form method="POST" action="{{ route('admin.video.destroy', $v) }}"
                                        onsubmit="return confirm('Hapus video ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete">🗑️ Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center;padding:2rem;color:var(--text-muted);">
                                Belum ada video.
                                <a href="{{ route('admin.video.create') }}" style="color:var(--emerald-ll);">
                                    Tambah sekarang
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($videos->hasPages())
            <div class="pagination-wrap">{{ $videos->links() }}</div>
        @endif
    </div>
@endsection
