<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Models\CustomPackage;
use App\Models\Appointment;


use Illuminate\Http\Request;


use App\Http\Controllers\Controller;


class PackageController extends Controller
{

    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        //dd("here");
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:photography,videography,offers',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
        ]);

        Package::create([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'description' => $request->description,
            'features' => $request->features ? json_encode($request->features) : null,
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:photography,videography',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
        ]);

        $package = Package::findOrFail($id);

        $package->update([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'description' => $request->description,
            'features' => $request->features ? json_encode(array_filter($request->features)) : null,
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }

    public function user_requests()
    {
        $user_requests = CustomPackage::all();
        return view('admin.packages.user_requests', compact('user_requests'));
    }



    public function appointments()
    {
        $appointments = Appointment::with('package')->latest()->get();

        return view('admin.appointments.index', compact('appointments'));
    }
}
