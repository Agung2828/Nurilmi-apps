@extends('admin.layouts.admin')
@section('title', 'Edit Video')
@section('breadcrumb', '<a href="' . route('admin.video.index') . '">Video</a> › Edit')

@section('admin-content')
    <div class="form-card">
        <form method="POST" action="{{ route('admin.video.update', $video) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-grid">

                {{-- Topik --}}
                <div class="form-group">
                    <label class="form-label">Topik *</label>
                    <select name="topik" class="form-control" required>
                        <option value="zakat" {{ $video->topik == 'zakat' ? 'selected' : '' }}>🤲 Zakat</option>
                        <option value="mawaris" {{ $video->topik == 'mawaris' ? 'selected' : '' }}>⚖️ Mawaris</option>
                        <option value="haji" {{ $video->topik == 'haji' ? 'selected' : '' }}>🕋 Haji</option>
                    </select>
                </div>

                {{-- Urutan --}}
                <div class="form-group">
                    <label class="form-label">Urutan</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $video->urutan) }}"
                        min="0">
                </div>

                {{-- Judul --}}
                <div class="form-group full">
                    <label class="form-label">Judul Video *</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $video->judul) }}"
                        required>
                    @error('judul')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Toggle tipe video --}}
                <div class="form-group full">
                    <label class="form-label">Sumber Video *</label>
                    <div style="display:flex;gap:1rem;margin-top:.4rem;">
                        <label style="display:flex;align-items:center;gap:.4rem;cursor:pointer;">
                            <input type="radio" name="video_type" value="youtube"
                                {{ old('video_type', $video->video_type) === 'youtube' ? 'checked' : '' }}
                                onchange="toggleVideoType('youtube')">
                            <span>📺 Link YouTube</span>
                        </label>
                        <label style="display:flex;align-items:center;gap:.4rem;cursor:pointer;">
                            <input type="radio" name="video_type" value="file"
                                {{ old('video_type', $video->video_type) === 'file' ? 'checked' : '' }}
                                onchange="toggleVideoType('file')">
                            <span>📁 Upload File</span>
                        </label>
                    </div>
                </div>

                {{-- Panel YouTube --}}
                @php $currentType = old('video_type', $video->video_type); @endphp

                <div id="panel-youtube" class="form-group" style="display:{{ $currentType === 'file' ? 'none' : 'block' }}">
                    <label class="form-label">YouTube Video ID *</label>
                    <input type="text" name="youtube_id" id="ytId" class="form-control"
                        value="{{ old('youtube_id', $video->youtube_id) }}" placeholder="contoh: dQw4w9WgXcQ">
                    <div class="form-hint">Ambil dari URL: youtube.com/watch?v=<strong>ID_INI</strong></div>
                    @error('youtube_id')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Thumbnail YouTube --}}
                <div id="panel-thumb" class="form-group" style="display:{{ $currentType === 'file' ? 'none' : 'block' }}">
                    <label class="form-label">Thumbnail Saat Ini</label>
                    <img id="thumbPreview"
                        src="{{ $video->video_type === 'youtube' ? 'https://img.youtube.com/vi/' . $video->youtube_id . '/hqdefault.jpg' : '' }}"
                        alt="thumbnail" class="thumbnail-prev"
                        style="width:160px;height:90px;border-radius:6px;object-fit:cover;{{ $video->video_type !== 'youtube' ? 'display:none' : '' }}">
                </div>

                {{-- Panel Upload File --}}
                <div id="panel-file" class="form-group full"
                    style="display:{{ $currentType === 'file' ? 'block' : 'none' }}">
                    <label class="form-label">
                        File Video
                        @if ($video->video_type === 'file' && $video->video_path)
                            <span style="font-size:.72rem;color:var(--text-muted);">(kosongkan jika tidak ingin
                                mengganti)</span>
                        @endif
                    </label>
                    <input type="file" name="video_file" id="videoFile" class="form-control"
                        accept="video/mp4,video/webm,video/ogg">
                    <div class="form-hint">Format: MP4, WebM, OGG — Maks. <strong>200 MB</strong></div>
                    @error('video_file')
                        <div class="form-error">{{ $message }}</div>
                    @enderror

                    {{-- Tampilkan video yang sudah ada --}}
                    @if ($video->video_type === 'file' && $video->video_path)
                        <div style="margin-top:.6rem;">
                            <div style="font-size:.75rem;color:var(--text-muted);margin-bottom:.3rem;">Video saat ini:</div>
                            <video controls style="width:320px;max-width:100%;border-radius:8px;">
                                <source src="{{ asset('storage/' . $video->video_path) }}">
                                Browser tidak mendukung tag video.
                            </video>
                        </div>
                    @endif

                    {{-- Preview file baru --}}
                    <video id="videoPreview" controls
                        style="margin-top:.8rem;width:320px;max-width:100%;display:none;border-radius:8px;"></video>
                </div>

                {{-- Durasi --}}
                <div class="form-group">
                    <label class="form-label">Durasi</label>
                    <input type="text" name="durasi" class="form-control" value="{{ old('durasi', $video->durasi) }}"
                        placeholder="contoh: 18:24">
                </div>

                {{-- Seri --}}
                <div class="form-group full">
                    <label class="form-label">Nama Seri</label>
                    <input type="text" name="seri" class="form-control" value="{{ old('seri', $video->seri) }}">
                </div>

                {{-- Deskripsi --}}
                <div class="form-group full">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $video->deskripsi) }}</textarea>
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" {{ $video->is_active ? 'selected' : '' }}>✅ Aktif</option>
                        <option value="0" {{ !$video->is_active ? 'selected' : '' }}>❌ Nonaktif</option>
                    </select>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Perbarui Video</button>
                <a href="{{ route('admin.video.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>

    <script>
        function toggleVideoType(type) {
            const panelYt = document.getElementById('panel-youtube');
            const panelThumb = document.getElementById('panel-thumb');
            const panelFile = document.getElementById('panel-file');

            if (type === 'youtube') {
                panelYt.style.display = 'block';
                panelThumb.style.display = 'block';
                panelFile.style.display = 'none';
            } else {
                panelYt.style.display = 'none';
                panelThumb.style.display = 'none';
                panelFile.style.display = 'block';
            }
        }

        // Preview thumbnail YouTube
        document.getElementById('ytId')?.addEventListener('input', function() {
            const id = this.value.trim();
            const prev = document.getElementById('thumbPreview');
            if (id.length > 5) {
                prev.src = `https://img.youtube.com/vi/${id}/hqdefault.jpg`;
                prev.style.display = 'block';
            }
        });

        // Preview file baru
        document.getElementById('videoFile').addEventListener('change', function() {
            const preview = document.getElementById('videoPreview');
            const file = this.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
@endsection
