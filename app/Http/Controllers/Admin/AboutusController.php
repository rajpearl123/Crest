<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Aboutus;
use App\Models\WhyChooseUs;
use App\Models\Chooseus;


use App\Http\Controllers\Controller;


class AboutusController extends Controller
{
    public function index()
    {
        $section = Aboutus::first(); 
        return view('admin.about.index', compact('section'));
    }

    // public function update(Request $request)
    // {
    //     //dd($request->all());
    //     $request->validate([
    //         'subtitle' => 'required|string',
    //         'title' => 'required|string',
    //         'description' => 'required|string',
    //         'progress_bars' => 'required|array',
    //     ]);

    //     Aboutus::updateOrCreate(['id' => 1], [
    //         'subtitle' => $request->subtitle,
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'progress_bars' => json_encode($request->progress_bars),
    //     ]);

    //     return redirect()->back()->with('success', 'Section updated successfully!');
    // }

    public function update(Request $request)
{
    // DD($request->ALL());
    $request->validate([
        'subtitle' => 'required|string',
        'title' => 'required|string',
        'description' => 'required|string',
        'op_desc'=>'required|string',
        'progress_bars' => 'required|array',
        'operation_data' => 'required|array', // Validate as an array
    ]);

    $aboutUs = Aboutus::first();
    // dd($aboutUs);

    // Check if the record exists
    if ($aboutUs) {
        $aboutUs->update([
            'subtitle' => $request->subtitle,
            'title' => $request->title,
            'description' => $request->description,
            'op_desc' => $request->op_desc,
            'progress_bars' => json_encode($request->progress_bars),
            'operation_data' => json_encode($request->operation_data), // Store as JSON
        ]);

        return redirect()->back()->with('success', 'Section updated successfully!');
    }

    return redirect()->back()->with('error', 'Record not found!');
}


    public function section_index()
    {
        $features = WhyChooseUs::all();
        return view('admin.about.why_choose_us.index', compact('features'));
    }

    public function section_create()
    {
        return view('admin.about.why_choose_us.create');
    }

    public function section_store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'feature_icon' => 'nullable|string',
            'feature_text' => 'required|string',
        ]);

        WhyChooseUs::create($request->all());

        return redirect()->route('admin.why_choose_us.index')->with('success', 'Feature added successfully!');
    }

    public function section_edit($id)
    {
        $feature = WhyChooseUs::findOrFail($id);
        return view('admin.about.why_choose_us.edit', compact('feature'));
    }

    public function section_update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'feature_icon' => 'nullable|string',
            'feature_text' => 'required|string',
        ]);

        $feature = WhyChooseUs::findOrFail($id);
        $feature->update($request->all());

        return redirect()->route('admin.why_choose_us.index')->with('success', 'Feature updated successfully!');
    }

    public function section_destroy($id)
    {
        $feature = WhyChooseUs::findOrFail($id);
        $feature->delete();

        return redirect()->route('admin.why_choose_us.index')->with('success', 'Feature deleted successfully!');
    }





    public function choose_us_index() {
        $items = Chooseus::all();
        return view('admin.choose_us.index', compact('items'));
    }

    public function choose_us_create() {
        return view('admin.choose_us.create');
    }

    public function choose_us_store(Request $request) {
        //dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        Chooseus::create($request->all());

        return redirect()->route('admin.choose_us.index')->with('success', 'Item added successfully.');
    }

    public function choose_us_edit($id) {
        $whyChooseUs = Chooseus::find($id);
    
        if (!$whyChooseUs) {
            abort(404, "WhyChooseUs record not found.");
        }
    
        return view('admin.choose_us.edit', compact('whyChooseUs'));
    }

    public function choose_us_update(Request $request, $id) {
        //dd($request->all());
        $whyChooseUs = Chooseus::findOrFail($id);
    
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);
    
        $whyChooseUs->update($request->only(['title', 'content']));
    
        return redirect()->route('admin.choose_us.index')->with('success', 'Item updated successfully.');
    }

    public function choose_us_destroy($id) {
        $whyChooseUs = Chooseus::find($id);
    
        if (!$whyChooseUs) {
            return redirect()->route('admin.choose_us.index')->with('error', 'Item not found.');
        }
    
        $whyChooseUs->delete();
        return redirect()->route('admin.choose_us.index')->with('success', 'Item deleted successfully.');
    }

}
