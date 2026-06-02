@extends('admin.layouts.admin')
@section('title', 'Kelola ATP')
@section('breadcrumb', 'ATP')

@section('admin-content')

    {{-- Ringkasan per tipe --}}
    <div class="stats-grid" style="margin-bottom:1.5rem;">
        @php
            $tipes = [
                'cp' => ['label' => 'Capaian Pembelajaran', 'icon' => '🎯'],
                'tp' => ['label' => 'Tujuan Pembelajaran', 'icon' => '📌'],
                'timeline' => ['label' => 'Alur Timeline', 'icon' => '📅'],
                'topik' => ['label' => 'Sub-Topik Detail', 'icon' => '📋'],
            ];
        @endphp
        @foreach ($tipes as $key => $info)
            <div class="stat-card">
                <div class="stat-num">{{ $sections->where('tipe', $key)->count() }}</div>
                <div class="stat-label">{{ $info['icon'] }} {{ $info['label'] }}</div>
            </div>
        @endforeach
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">📋 Daftar Section ATP ({{ $sections->total() }})</div>
            <a href="{{ route('admin.atp.create') }}" class="btn-add">➕ Tambah Section</a>
        </div>

        {{-- Filter Tipe --}}
        <div style="padding:.8rem 1.2rem;border-bottom:1px solid var(--card-border);display:flex;gap:.5rem;flex-wrap:wrap;">
            <a href="{{ route('admin.atp.index') }}" class="btn-edit {{ !request('tipe') ? 'active' : '' }}"
                style="{{ !request('tipe') ? 'background:rgba(13,115,119,.2);border-color:var(--emerald-l);color:var(--emerald-ll);' : '' }}">
                ✦ Semua
            </a>
            @foreach ($tipes as $key => $info)
                <a href="{{ route('admin.atp.index', ['tipe' => $key]) }}" class="btn-edit"
                    style="{{ request('tipe') == $key ? 'background:rgba(13,115,119,.2);border-color:var(--emerald-l);color:var(--emerald-ll);' : '' }}">
                    {{ $info['icon'] }} {{ $info['label'] }}
                </a>
            @endforeach
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipe</th>
                        <th>Topik</th>
                        <th>Judul</th>
                        <th>Minggu / Sub</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sections as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @php
                                    $tipeIcon = match ($s->tipe) {
                                        'cp' => '🎯',
                                        'tp' => '📌',
                                        'timeline' => '📅',
                                        'topik' => '📋',
                                        default => '📄',
                                    };
                                    $tipeCls = match ($s->tipe) {
                                        'cp' => 'badge-active',
                                        'tp' => 'badge-m',
                                        'timeline' => 'badge-h',
                                        'topik' => 'badge-z',
                                        default => '',
                                    };
                                @endphp
                                <span class="badge {{ $tipeCls }}">{{ $tipeIcon }}
                                    {{ ucfirst($s->tipe) }}</span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $s->topik[0] }}">{{ ucfirst($s->topik) }}</span>
                            </td>
                            <td>
                                <div class="td-title">{{ $s->icon }} {{ Str::limit($s->judul, 45) }}</div>
                                @if ($s->sub_judul)
                                    <div style="font-size:.7rem;color:var(--text-muted);">{{ $s->sub_judul }}</div>
                                @endif
                            </td>
                            <td style="font-size:.75rem;color:var(--text-muted);">
                                {{ $s->minggu ?? Str::limit($s->isi, 40) }}
                            </td>
                            <td>{{ $s->urutan }}</td>
                            <td>
                                <span class="badge {{ $s->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $s->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>
                                <div class="td-actions">
                                    <a href="{{ route('admin.atp.edit', $s) }}" class="btn-edit">✏️ Edit</a>
                                    <form method="POST" action="{{ route('admin.atp.destroy', $s) }}"
                                        onsubmit="return confirm('Hapus section ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete">🗑️ Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center;padding:2rem;color:var(--text-muted);">
                                Belum ada section ATP.
                                <a href="{{ route('admin.atp.create') }}" style="color:var(--emerald-ll);">Tambah
                                    sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($sections->hasPages())
            <div class="pagination-wrap">{{ $sections->links() }}</div>
        @endif
    </div>

    {{-- Panduan tipe --}}
    <div class="admin-card" style="margin-top:1.5rem;">
        <div class="admin-card-header">
            <div class="admin-card-title">💡 Panduan Pengisian Tipe Section</div>
        </div>
        <div style="padding:1.2rem;display:grid;grid-template-columns:repeat(2,1fr);gap:1rem;">
            <div
                style="background:rgba(13,115,119,.06);border:1px solid rgba(13,115,119,.15);border-radius:10px;padding:1rem;">
                <div style="font-weight:700;color:var(--emerald-ll);margin-bottom:.4rem;">🎯 CP — Capaian Pembelajaran</div>
                <div style="font-size:.78rem;color:var(--text-muted);line-height:1.7;">
                    Isi satu record per topik (Zakat, Mawaris, Haji).<br>
                    <b>Judul</b>: judul CP, <b>Isi</b>: deskripsi panjang kemampuan yang dicapai.<br>
                    <b>Sub Judul</b>: label badge (misal: <code>CP — Zakat</code>)
                </div>
            </div>
            <div style="background:rgba(26,58,92,.2);border:1px solid rgba(26,58,92,.3);border-radius:10px;padding:1rem;">
                <div style="font-weight:700;color:#7eb8e8;margin-bottom:.4rem;">📌 TP — Tujuan Pembelajaran</div>
                <div style="font-size:.78rem;color:var(--text-muted);line-height:1.7;">
                    Isi per tujuan spesifik (TP 1, TP 2, dst).<br>
                    <b>Tags</b>: level Bloom dipisah koma (misal: <code>C1 Mengingat, C2 Memahami</code>)<br>
                    <b>Sub Judul</b>: label (misal: <code>TP 1 — Zakat</code>)
                </div>
            </div>
            <div
                style="background:rgba(201,168,76,.06);border:1px solid rgba(201,168,76,.15);border-radius:10px;padding:1rem;">
                <div style="font-weight:700;color:var(--gold-l);margin-bottom:.4rem;">📅 Timeline — Alur Pembelajaran</div>
                <div style="font-size:.78rem;color:var(--text-muted);line-height:1.7;">
                    Isi per pertemuan/kelompok pertemuan.<br>
                    <b>Minggu</b>: label (misal: <code>Pertemuan 1–2 · Zakat</code>)<br>
                    <b>Chips</b>: metode dipisah koma (misal: <code>Tatap Muka, Diskusi Kelompok, 2 × 2 JP</code>)
                </div>
            </div>
            <div
                style="background:rgba(13,115,119,.06);border:1px solid rgba(13,115,119,.15);border-radius:10px;padding:1rem;">
                <div style="font-weight:700;color:var(--emerald-ll);margin-bottom:.4rem;">📋 Topik — Sub-Topik Detail</div>
                <div style="font-size:.78rem;color:var(--text-muted);line-height:1.7;">
                    Isi per sub-topik pada tab Zakat/Mawaris/Haji.<br>
                    <b>Sub Judul</b>: label pertemuan (misal: <code>Pertemuan 1</code>)<br>
                    <b>Topik</b>: menentukan di tab mana card ini muncul
                </div>
            </div>
        </div>
    </div>
@endsection
