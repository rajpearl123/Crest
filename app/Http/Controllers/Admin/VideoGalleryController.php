<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\VideoGallery;
use App\Http\Controllers\Controller;


class VideoGalleryController extends Controller
{
    // Display all videos
    public function index(Request $request)
{
    $query = VideoGallery::query();

    // Filter by title
    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $request->input('title') . '%');
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('active', $request->input('status'));
    }

    // Filter by date range
    if ($request->filled('start_date')) {
        $query->whereDate('created_at', '>=', $request->input('start_date'));
    }
    if ($request->filled('end_date')) {
        $query->whereDate('created_at', '<=', $request->input('end_date'));
    }

    $videos = $query->paginate(10); // Paginate with 10 items per page
    // dd( $query->get());
    return view('admin.video_gallery.index', compact('videos'));
}

    // Show form to add a new video
    public function create()
    {
        return view('admin.video_gallery.create');
    }

    // Store a new video
    public function store(Request $request)
    {
        $request->validate([
            'video_url' => 'required|url',
            'title' => 'required',
            'active' => 'required|in:yes,no',
        ]);

        VideoGallery::create($request->all());

        return redirect()->route('admin.video-gallery.index')->with('success', 'Video added successfully.');
    }

    // Show a single video
    public function show($id)
    {
        $video = VideoGallery::findOrFail($id);
        return view('admin.video_gallery.show', compact('video'));
    }

    // Show form to edit a video
    public function edit($id)
    {
        $video = VideoGallery::findOrFail($id);
        return view('admin.video_gallery.edit', compact('video'));
    }

    // Update a video
    public function update(Request $request, $id)
    {
        $request->validate([
            'video_url' => 'required|url',
            'title' => 'required',
            'active' => 'required|in:yes,no',
        ]);

        $video = VideoGallery::findOrFail($id);
        $video->update($request->all());

        return redirect()->route('admin.video-gallery.index')->with('success', 'Video updated successfully.');
    }

    // Delete a video
    public function destroy($id)
    {
        $video = VideoGallery::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.video-gallery.index')->with('success', 'Video deleted successfully.');
    }
}
