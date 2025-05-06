<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Step;
use App\Http\Controllers\Controller;


class StepController extends Controller
{
    // Display a listing of the steps
    public function index(Request $request)
{
    $query = Step::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $steps = $query->orderBy('step_count')->get();

    return view('admin.steps.index', compact('steps'));
}

    // Show the form for creating a new step
    public function create()
    {
        return view('admin.steps.create');
    }

    // Store a newly created step
     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:svg|max:2048',
            'step_count' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        // Handle Image Upload (Save in "public/steps")
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('steps'), $imageName);
            $imagePath = 'steps/' . $imageName;
        }

        Step::create([
            'title' => $request->title,
            'image' => $imagePath,
            'step_count' => $request->step_count,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.steps.index')->with('success', 'Step created successfully.');
    }

    // Show the form for editing the specified step
    public function edit(Step $step)
    {
        return view('admin.steps.edit', compact('step'));
    }

    // Update the specified step
    public function update(Request $request, Step $step)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:svg|max:2048',
            'step_count' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($step->image && File::exists(public_path($step->image))) {
                File::delete(public_path($step->image));
            }

            // Save new image in "public/steps"
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('steps'), $imageName);
            $step->image = 'steps/' . $imageName;
        }

        $step->update([
            'title' => $request->title,
            'step_count' => $request->step_count,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.steps.index')->with('success', 'Step updated successfully.');
    }

    // Remove the specified step
    public function destroy(Step $step)
    {
        $step->delete();
        return redirect()->route('admin.steps.index')->with('success', 'Step deleted successfully.');
    }
}
