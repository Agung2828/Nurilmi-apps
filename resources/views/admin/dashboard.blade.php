@extends('admin.layouts.admin')
@section('title', 'Dashboard')

@section('admin-content')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-num">{{ \App\Models\Materi::count() }}</div>
            <div class="stat-label">📚 Total Materi</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ \App\Models\Video::count() }}</div>
            <div class="stat-label">🎬 Total Video</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ \App\Models\Materi::where('topik', 'zakat')->count() }}</div>
            <div class="stat-label">🤲 Materi Zakat</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ \App\Models\Materi::where('topik', 'mawaris')->count() }}</div>
            <div class="stat-label">⚖️ Materi Mawaris</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ \App\Models\Materi::where('topik', 'haji')->count() }}</div>
            <div class="stat-label">🕋 Materi Haji</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ \App\Models\User::count() }}</div>
            <div class="stat-label">👥 Total User</div>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">📚 Materi Terbaru</div>
            <a href="{{ route('admin.materi.index') }}" class="btn-add">Lihat Semua →</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Topik</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\App\Models\Materi::latest()->take(5)->get() as $m)
                        <tr>
                            <td class="td-title">{{ $m->judul }}</td>
                            <td><span class="badge badge-{{ $m->topik[0] }}">{{ ucfirst($m->topik) }}</span></td>
                            <td><span
                                    class="badge {{ $m->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $m->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                            </td>
                            <td>{{ $m->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">🎬 Video Terbaru</div>
            <a href="{{ route('admin.video.index') }}" class="btn-add">Lihat Semua →</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Judul</th>
                        <th>Topik</th>
                        <th>Durasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\App\Models\Video::latest()->take(5)->get() as $v)
                        <tr>
                            <td><img src="https://img.youtube.com/vi/{{ $v->youtube_id }}/default.jpg"
                                    class="thumbnail-prev" alt="{{ $v->judul }}"></td>
                            <td class="td-title">{{ Str::limit($v->judul, 50) }}</td>
                            <td><span class="badge badge-{{ $v->topik[0] }}">{{ ucfirst($v->topik) }}</span></td>
                            <td>{{ $v->durasi ?? '—' }}</td>
                            <td><span
                                    class="badge {{ $v->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $v->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
