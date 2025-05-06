<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\HomeVideo;
use App\Http\Controllers\Controller;


class HomeVideoController extends Controller
{	

	public function index()
{
    $video = HomeVideo::first(); // Fetch the single video record
    return view('admin.video.index', compact('video'));
}



    /**
     * Show the video details (fetch the single entry).
     */
    public function show()
    {
        $video = HomeVideo::first(); // Fetches the first (and only) record
        return view('admin.video.edit', compact('video'));
    }

    /**
     * Update the video record (either file or link).
     */
    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'video_file' => 'nullable|file|mimes:mp4,mkv,avi|max:10240', // 10MB max
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 2MB max for thumbnail
            'video_link' => 'nullable|url',
        ]);
    
        $video = HomeVideo::first(); // Fetch the single record
    
        if (!$video) {
            $video = new HomeVideo(); // Create if not exists
        }
    
        // Handle video file upload
        if ($request->hasFile('video_file')) {
            // Delete the old video file if it exists
            if ($video->video_file && file_exists(public_path($video->video_file))) {
                unlink(public_path($video->video_file));
            }
    
            $file = $request->file('video_file');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Unique filename
            $destinationPath = public_path('uploads/videos');
    
            // Move video file to public/uploads/videos
            $file->move($destinationPath, $fileName);
    
            $video->video_file = 'uploads/videos/' . $fileName;
            $video->video_link = null; // Remove link if uploading a file
    
            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                // Delete the old thumbnail if it exists
                if ($video->thumbnail && file_exists(public_path($video->thumbnail))) {
                    unlink(public_path($video->thumbnail));
                }
    
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName(); // Unique filename
                $thumbnailDestinationPath = public_path('uploads/thumbnails');
    
                // Create thumbnails directory if it doesn't exist
                if (!file_exists($thumbnailDestinationPath)) {
                    mkdir($thumbnailDestinationPath, 0755, true);
                }
    
                // Move thumbnail to public/uploads/thumbnails
                $thumbnail->move($thumbnailDestinationPath, $thumbnailName);
    
                $video->thumbnail = 'uploads/thumbnails/' . $thumbnailName;
            }
        } elseif ($request->video_link) {
            // Delete the old video file and thumbnail if a link is provided
            if ($video->video_file && file_exists(public_path($video->video_file))) {
                unlink(public_path($video->video_file));
            }
            if ($video->thumbnail && file_exists(public_path($video->thumbnail))) {
                unlink(public_path($video->thumbnail));
            }
    
            $video->video_link = $request->video_link;
            $video->video_file = null;
            $video->thumbnail = null; // Remove thumbnail if using a link
        }
    
        $video->save();
    
        return redirect()->route('admin.video.index')->with('success', 'Video updated successfully!');
    }
    
}
