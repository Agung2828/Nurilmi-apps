<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('user')
            ->orderBy('topik')
            ->orderBy('urutan')
            ->paginate(15);
        return view('admin.video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.video.create');
    }

    public function store(Request $request)
    {
        $videoType = $request->input('video_type', 'youtube');

        $rules = [
            'topik'      => 'required|in:zakat,mawaris,haji',
            'judul'      => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'video_type' => 'required|in:youtube,file',
            'durasi'     => 'nullable|string|max:10',
            'seri'       => 'nullable|string|max:100',
            'urutan'     => 'nullable|integer',
            'is_active'  => 'boolean',
        ];

        if ($videoType === 'youtube') {
            $rules['youtube_id'] = 'required|string|max:20';
        } else {
            $rules['video_file'] = 'required|file|mimetypes:video/mp4,video/webm,video/ogg|max:204800';
        }

        $validated = $request->validate($rules);

        $data = [
            'topik'      => $validated['topik'],
            'judul'      => $validated['judul'],
            'deskripsi'  => $validated['deskripsi'] ?? null,
            'video_type' => $videoType,
            'durasi'     => $validated['durasi'] ?? null,
            'seri'       => $validated['seri'] ?? null,
            'urutan'     => $validated['urutan'] ?? 0,
            'is_active'  => $request->boolean('is_active', true),
            'user_id'    => auth()->id(),
        ];

        if ($videoType === 'youtube') {
            $data['youtube_id'] = $validated['youtube_id'];
            $data['video_path'] = null;
        } else {
            // Simpan langsung ke public/storage/videos
            $fileName = time() . '_' . $request->file('video_file')->getClientOriginalName();
            $request->file('video_file')->move(public_path('storage/videos'), $fileName);
            $data['video_path'] = 'videos/' . $fileName;
            $data['youtube_id'] = null;
        }

        Video::create($data);

        return redirect()->route('admin.video.index')
            ->with('success', 'Video berhasil ditambahkan!');
    }

    public function edit(Video $video)
    {
        return view('admin.video.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $videoType = $request->input('video_type', $video->video_type);

        $rules = [
            'topik'      => 'required|in:zakat,mawaris,haji',
            'judul'      => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'video_type' => 'required|in:youtube,file',
            'durasi'     => 'nullable|string|max:10',
            'seri'       => 'nullable|string|max:100',
            'urutan'     => 'nullable|integer',
            'is_active'  => 'boolean',
        ];

        if ($videoType === 'youtube') {
            $rules['youtube_id'] = 'required|string|max:20';
        } else {
            $rules['video_file'] = 'nullable|file|mimetypes:video/mp4,video/webm,video/ogg|max:204800';
        }

        $validated = $request->validate($rules);

        $data = [
            'topik'      => $validated['topik'],
            'judul'      => $validated['judul'],
            'deskripsi'  => $validated['deskripsi'] ?? null,
            'video_type' => $videoType,
            'durasi'     => $validated['durasi'] ?? null,
            'seri'       => $validated['seri'] ?? null,
            'urutan'     => $validated['urutan'] ?? 0,
            'is_active'  => $request->boolean('is_active', true),
        ];

        if ($videoType === 'youtube') {
            if ($video->video_type === 'file' && $video->video_path) {
                $oldFile = public_path('storage/' . $video->video_path);
                if (file_exists($oldFile)) unlink($oldFile);
            }
            $data['youtube_id'] = $validated['youtube_id'];
            $data['video_path'] = null;
        } else {
            if ($request->hasFile('video_file')) {
                if ($video->video_path) {
                    $oldFile = public_path('storage/' . $video->video_path);
                    if (file_exists($oldFile)) unlink($oldFile);
                }
                $fileName = time() . '_' . $request->file('video_file')->getClientOriginalName();
                $request->file('video_file')->move(public_path('storage/videos'), $fileName);
                $data['video_path'] = 'videos/' . $fileName;
            }
            $data['youtube_id'] = null;
        }

        $video->update($data);

        return redirect()->route('admin.video.index')
            ->with('success', 'Video berhasil diperbarui!');
    }

    public function destroy(Video $video)
    {
        if ($video->video_type === 'file' && $video->video_path) {
            $oldFile = public_path('storage/' . $video->video_path);
            if (file_exists($oldFile)) unlink($oldFile);
        }

        $video->delete();

        return redirect()->route('admin.video.index')
            ->with('success', 'Video berhasil dihapus!');
    }
}
