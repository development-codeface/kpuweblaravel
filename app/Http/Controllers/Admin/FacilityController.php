<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\FacilityContent;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['facility'] = Facility::get();
        return view('admin.facility.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.facility.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required',
            'heading'        => 'required|array',
            'heading.*'      => 'required|string|max:255',
            'button_text'        => 'required|array',
            'button_text.*'      => 'required|string|max:255',
            'images'           => 'required|array',   // ✅ ADD THIS
            'images.*'         => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $facilityId = Facility::create([
            'title'     => $request->title,
            'sub_title' => $request->sub_title
        ]);

        foreach ($request->heading as $index => $heading) {

            $imageName = null;

            // Check if image exists for this index
            if ($request->hasFile('images.' . $index)) {

                $image      = $request->file('images')[$index];
                $imageName  = time() . '_' . $index . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('images/facility');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);
            }

            FacilityContent::create([
                'facilities_id' => $request->facilities_id,
                'heading'       => $heading,
                'button_text'   => $request->button_text[$index] ?? null,
                'image'         => $imageName,
            ]);
        }

        return redirect()->route('admin.facility.index')->with('success', 'facility created successfully.');
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
        $data['edit'] = Facility::with('content')->where('id', $id)->first();
        return view('admin.facility.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required',
            'heading'        => 'required|array',
            'heading.*'      => 'required|string|max:255',
            'button_text'        => 'required|array',
            'button_text.*'      => 'required|string|max:255',
            // 'images'           => 'required|array',   // ✅ ADD THIS
            // 'images.*'         => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $facility = Facility::findOrFail($request->id);

        // ✅ Update main table
        $facility->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
        ]);

        foreach ($request->heading as $index => $heading) {

            $contentId = $request->content_id[$index] ?? null;


            // 🔹 If new image uploaded
            if ($request->hasFile('images.' . $index)) {

                $image = $request->file('images')[$index];
                $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('images/facility');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);
            } else {
                $imageName = FacilityContent::find($contentId)->image;
            }

            // 🔥 If content already exists → UPDATE
            if ($contentId) {

                $content = FacilityContent::find($contentId);

                if ($content) {
                    $content->update([
                        'heading' => $heading,
                        'button_text' => $request->button_text[$index] ?? null,
                        'image' => $imageName ?? $content->image, // keep old image if not changed
                    ]);
                }
            } else {
                // 🔥 New row added → CREATE
                FacilityContent::create([
                    'facilities_id' => $facility->id,
                    'heading' => $heading,
                    'button_text' => $request->button_text[$index] ?? null,
                    'image' => $imageName,
                ]);
            }
        }

        return redirect()->route('admin.facility.index')
            ->with('success', 'Facility updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Facility::where('id', $id)->delete();
        FacilityContent::where('facilities_id', $id)->delete();
        return redirect()->route('admin.facility.index')->with('success', 'facility created successfully.');
    }
}
