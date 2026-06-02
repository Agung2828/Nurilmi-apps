@extends('admin.layouts.admin')
@section('title', 'Tambah Video')
@section('breadcrumb', '<a href="' . route('admin.video.index') . '">Video</a> › Tambah')

@section('admin-content')
    <div class="form-card">
        {{-- Form pakai enctype multipart karena ada upload file --}}
        <form method="POST" action="{{ route('admin.video.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">

                {{-- Topik --}}
                <div class="form-group">
                    <label class="form-label">Topik *</label>
                    <select name="topik" class="form-control" required>
                        <option value="">-- Pilih Topik --</option>
                        <option value="zakat" {{ old('topik') == 'zakat' ? 'selected' : '' }}>🤲 Zakat</option>
                        <option value="mawaris" {{ old('topik') == 'mawaris' ? 'selected' : '' }}>⚖️ Mawaris</option>
                        <option value="haji" {{ old('topik') == 'haji' ? 'selected' : '' }}>🕋 Haji</option>
                    </select>
                    @error('topik')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Urutan --}}
                <div class="form-group">
                    <label class="form-label">Urutan</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
                </div>

                {{-- Judul --}}
                <div class="form-group full">
                    <label class="form-label">Judul Video *</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required
                        placeholder="contoh: Pengertian dan Dalil Zakat dalam Islam">
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
                                {{ old('video_type', 'youtube') === 'youtube' ? 'checked' : '' }}
                                onchange="toggleVideoType('youtube')">
                            <span>📺 Link YouTube</span>
                        </label>
                        <label style="display:flex;align-items:center;gap:.4rem;cursor:pointer;">
                            <input type="radio" name="video_type" value="file"
                                {{ old('video_type') === 'file' ? 'checked' : '' }} onchange="toggleVideoType('file')">
                            <span>📁 Upload File</span>
                        </label>
                    </div>
                </div>

                {{-- Panel YouTube --}}
                <div id="panel-youtube" class="form-group"
                    style="display:{{ old('video_type', 'youtube') === 'file' ? 'none' : 'block' }}">
                    <label class="form-label">YouTube Video ID *</label>
                    <input type="text" name="youtube_id" id="ytId" class="form-control"
                        value="{{ old('youtube_id') }}" placeholder="contoh: dQw4w9WgXcQ">
                    <div class="form-hint">Ambil dari URL: youtube.com/watch?v=<strong>ID_INI</strong></div>
                    @error('youtube_id')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Preview thumbnail YouTube --}}
                <div id="panel-thumb" class="form-group"
                    style="display:{{ old('video_type') === 'file' ? 'none' : 'block' }}">
                    <label class="form-label">Preview Thumbnail</label>
                    <img id="thumbPreview" src="" alt="thumbnail" class="thumbnail-prev"
                        style="width:160px;height:90px;display:none;border-radius:6px;object-fit:cover;">
                    <div style="font-size:.72rem;color:var(--text-muted);margin-top:.3rem;">Otomatis dari YouTube setelah
                        isi ID</div>
                </div>

                {{-- Panel Upload File --}}
                <div id="panel-file" class="form-group full"
                    style="display:{{ old('video_type') === 'file' ? 'block' : 'none' }}">
                    <label class="form-label">File Video *</label>
                    <input type="file" name="video_file" id="videoFile" class="form-control"
                        accept="video/mp4,video/webm,video/ogg">
                    <div class="form-hint">Format: MP4, WebM, OGG — Maks. <strong>200 MB</strong></div>
                    @error('video_file')
                        <div class="form-error">{{ $message }}</div>
                    @enderror

                    {{-- Preview file lokal --}}
                    <video id="videoPreview" controls
                        style="margin-top:.8rem;width:320px;max-width:100%;display:none;border-radius:8px;"></video>
                </div>

                {{-- Durasi --}}
                <div class="form-group">
                    <label class="form-label">Durasi</label>
                    <input type="text" name="durasi" class="form-control" value="{{ old('durasi') }}"
                        placeholder="contoh: 18:24">
                </div>

                {{-- Seri --}}
                <div class="form-group full">
                    <label class="form-label">Nama Seri</label>
                    <input type="text" name="seri" class="form-control" value="{{ old('seri') }}"
                        placeholder="contoh: Seri Zakat — Ep. 1">
                </div>

                {{-- Deskripsi --}}
                <div class="form-group full">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" placeholder="Deskripsi singkat video...">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" selected>✅ Aktif</option>
                        <option value="0">❌ Nonaktif</option>
                    </select>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Simpan Video</button>
                <a href="{{ route('admin.video.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>

    <script>
        // Toggle panel YouTube / File
        function toggleVideoType(type) {
            const panelYt = document.getElementById('panel-youtube');
            const panelThumb = document.getElementById('panel-thumb');
            const panelFile = document.getElementById('panel-file');

            if (type === 'youtube') {
                panelYt.style.display = 'block';
                panelThumb.style.display = 'block';
                panelFile.style.display = 'none';
                // Hapus required dari file input supaya form bisa submit
                document.getElementById('videoFile').removeAttribute('required');
            } else {
                panelYt.style.display = 'none';
                panelThumb.style.display = 'none';
                panelFile.style.display = 'block';
            }
        }

        // Preview thumbnail YouTube
        document.getElementById('ytId').addEventListener('input', function() {
            const id = this.value.trim();
            const prev = document.getElementById('thumbPreview');
            if (id.length > 5) {
                prev.src = `https://img.youtube.com/vi/${id}/hqdefault.jpg`;
                prev.style.display = 'block';
            } else {
                prev.style.display = 'none';
            }
        });

        // Preview file video lokal
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
