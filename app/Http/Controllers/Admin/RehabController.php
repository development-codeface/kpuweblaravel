<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RehabBanner;
use Illuminate\Http\Request;

class RehabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $data['id'] = $id;
        $data['banner'] = RehabBanner::where('pages_id', $id)->first();
        return view('admin.rehab.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'              => 'required|string|max:255',
            'button_text'        => 'required|string|max:255',
            'description' => 'required|string',
            'image'              => $request->banner_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Check if updating
        if ($request->banner_id) {
            $banner = RehabBanner::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new RehabBanner();
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/rehab/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/rehab/banner' . $imageName;
        }

        // Common Fields
        $banner->pages_id    = $request->pages_id;
        $banner->title       = $request->title;
        $banner->button_text = $request->button_text;
        $banner->description = $request->description;
        $banner->save();

        return redirect()->route('admin.pages.index')
            ->with('success', 'rehabilitation saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
