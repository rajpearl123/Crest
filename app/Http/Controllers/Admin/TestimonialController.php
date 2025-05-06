<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;


class TestimonialController extends Controller
{
    /**
     * Display a listing of the testimonials.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'review'  => 'required|string|max:1000',
            'name'    => 'required|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'country' => 'required|string|max:255',
        ]);

        $imagePath = null;
         if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/testimonials'), $imageName);
        $imagePath = 'uploads/testimonials/' . $imageName;
    }
        Testimonial::create([
            'rating'  => $request->rating,
            'review'  => $request->review,
            'name'    => $request->name,
            'image'   => $imagePath,
            'country' => $request->country,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    /**
     * Show the form for editing a testimonial.
     */
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update a testimonial in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'rating'  => 'required|integer|min:1|max:5',
    //         'review'  => 'required|string|max:1000',
    //         'name'    => 'required|string|max:255',
    //         'image'   => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
    //         'country' => 'required|string|max:255',
    //     ]);

    //     $testimonial = Testimonial::findOrFail($id);


    //    if ($request->hasFile('image')) {
    //     $image = $request->file('image');
    //     $imageName = time() . '_' . $image->getClientOriginalName();
    //     $image->move(public_path('uploads/testimonials'), $imageName);
    //     $imagePath = 'uploads/testimonials/' . $imageName;
    // }
    //     $testimonial->update([
    //         'rating'  => $request->rating,
    //         'review'  => $request->review,
    //         'name'    => $request->name,
    //         'country' => $request->country,
    //     ]);

    //     return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    // }

    public function update(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string',
        'name' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'country' => 'required|string',
    ]);

    $testimonial = Testimonial::findOrFail($id);
    
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($testimonial->image && file_exists(public_path($testimonial->image))) {
            unlink(public_path($testimonial->image));
        }
        
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/testimonials'), $imageName);
        $testimonial->image = 'uploads/testimonials/' . $imageName;
    }

    $testimonial->update([
        'rating' => $request->rating,
        'review' => $request->review,
        'name' => $request->name,
        'country' => $request->country,
    ]);

    return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
}

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
