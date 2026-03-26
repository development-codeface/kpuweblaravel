<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisionBanner;
use App\Models\VisionSection;
use App\Models\VisionContent;
use App\Models\VisionSubContent;

class VisionController extends Controller
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
        $edit_banner = VisionBanner::where('pages_id', $id)->first();
        $edit_section = VisionSection::where('pages_id', $id)->get();
        $edit_content = VisionContent::where('pages_id',$id)->with('subContent')->first();
        return view('admin.vision.create', compact('id', 'edit_banner', 'edit_section','edit_content'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        // 🔥 Check if update or insert
        if ($request->banner_id) {
            $banner = VisionBanner::findOrFail($request->banner_id);
        } else {
            $banner = new VisionBanner();
        }

        // Assign values
        $banner->pages_id = $request->pages_id;
        $banner->title = $request->title;
        $banner->button_text = $request->button_text;

        // ✅ Image Upload (only update if new image)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/vision/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/vision/banner/' . $imageName;
        }

        $banner->save();

        return redirect()->route('admin.pages.index')->with('success', 'Vision banner created successfully.');
    }


    public function SectionStore(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'section_icons.*' => 'required|string',
            'section_headings.*' => 'required|string',
            'section_descriptions.*' => 'required|string',
        ]);



        // ✅ 2. Get existing sub content IDs (for delete check)
        // $existingIds = SectionSubContent::where('section_id', $section->id)
        //     ->pluck('id')
        //     ->toArray();

        $submittedIds = [];

        // ✅ 3. Loop through rows
        foreach ($request->section_descriptions as $index => $desc) {

            $subId = $request->section_id[$index] ?? null;

            if ($subId) {
                // 🔁 UPDATE
                $sub = VisionSection::find($subId);
            } else {
                // ➕ INSERT
                $sub = new VisionSection();
                $sub->pages_id = $request->pages_id;
            }

            $sub->icon = $request->section_icons[$index];
            $sub->heading = $request->section_headings[$index];
            $sub->description = $desc;

            $sub->save();

            $submittedIds[] = $sub->id;
        }

        // ✅ 4. DELETE removed rows
        // $deleteIds = array_diff($existingIds, $submittedIds);

        // if (!empty($deleteIds)) {
        //     SectionSubContent::whereIn('id', $deleteIds)->delete();
        // }

        return redirect()->route('admin.pages.index')->with('success', 'Vision section created successfully.');
    }

    public function contentSection(Request $request)
    {


        // ✅ Validation
        $request->validate([
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'content_descriptions.*' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        // ✅ 1. CREATE or UPDATE MAIN CONTENT
        if ($request->content_id) {
            $content = VisionContent::findOrFail($request->content_id);
        } else {
            $content = new VisionContent();
        }

        $content->pages_id = $request->pages_id;
        $content->title = $request->title;
        $content->sub_title = $request->sub_title;
        $content->save();

        // ✅ 2. EXISTING IDS (for delete)
        $existingIds = VisionSubContent::where('vision_contents_id', $content->id)
            ->pluck('id')
            ->toArray();

        $submittedIds = [];

        // ✅ 3. LOOP ROWS
        foreach ($request->content_descriptions as $index => $desc) {

            $subId = $request->sub_content_id[$index] ?? null;

            if ($subId) {
                // 🔁 UPDATE
                $sub = VisionSubContent::find($subId);
            } else {
                // ➕ INSERT
                $sub = new VisionSubContent();
                $sub->vision_contents_id = $content->id;
            }

            $sub->description = $desc;

            // ✅ IMAGE UPLOAD (only if new image)
            if ($request->hasFile('images') && isset($request->file('images')[$index])) {

                $image = $request->file('images')[$index];
                $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('images/content');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);

                $sub->image = 'images/content/' . $imageName;
            }

            $sub->save();

            $submittedIds[] = $sub->id;
        }

        // ✅ 4. DELETE REMOVED ROWS
        // $deleteIds = array_diff($existingIds, $submittedIds);

        // if (!empty($deleteIds)) {
        //     VisionSubContent::whereIn('id', $deleteIds)->delete();
        // }

        return redirect()->route('admin.pages.index')->with('success', 'Vision content created successfully.');
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
