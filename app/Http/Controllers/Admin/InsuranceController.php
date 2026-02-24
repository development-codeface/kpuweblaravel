<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InsuranceBanner;
use App\Models\InsuranceContent;
use App\Models\InsuranceSubContent;

class InsuranceController extends Controller
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
        //
        return view('admin.insurance.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/insurance/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/insurance/banner/' . $imageName;
        }

        InsuranceBanner::create([
            'pages_id'   => $request->pages_id,
            'title'      => $request->title,
            'button_text' => $request->button_text,
            'description' => $request->description,
            'image'      => $imagePath,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Career banner created successfully.');
    }

    public function ContentStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'icon.*' => 'required|string|max:255',
            'content_descriptions.*' => 'required|string',
        ]);



        // 1️⃣ Insert Parent (Single Form Data)
        $content = InsuranceContent::create([
            'pages_id' => $request->pages_id,
            'title' => $request->title,
            'sub_title' => $request->sub_title,
        ]);

        // 2️⃣ Insert Multiple Sub Rows
        if ($request->icon) {

            foreach ($request->icon as $index => $icon) {

                InsuranceSubContent::create([
                    'insurance_contents_id' => $content->id,
                    'icon' => $icon,
                    'description' => $request->content_descriptions[$index] ?? null,
                ]);
            }
        }
        return redirect()->route('admin.pages.index')->with('success', 'Career content created successfully.');
    }

    public function ContentUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'icon.*' => 'required|string|max:255',
            'content_descriptions.*' => 'required|string',
        ]);

        $content = InsuranceContent::findOrFail($request->content_id);

        // 1️⃣ Update Parent
        $content->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
        ]);

        $existingIds = $content->subContents->pluck('id')->toArray();
        $submittedIds = $request->sub_content_id ?? [];

        $keptIds = [];

        // 2️⃣ Update or Insert Sub Rows
        foreach ($request->icon as $index => $icon) {

            $subId = $submittedIds[$index] ?? null;

            if ($subId) {
                // Update existing row
                $sub = InsuranceSubContent::find($subId);

                if ($sub) {
                    $sub->update([
                        'icon' => $icon,
                        'description' => $request->content_descriptions[$index] ?? null,
                    ]);
                    $keptIds[] = $subId;
                }
            } else {
                // Insert new row
                $new = InsuranceSubContent::create([
                    'insurance_contents_id' => $content->id,
                    'icon' => $icon,
                    'description' => $request->content_descriptions[$index] ?? null,
                ]);

                $keptIds[] = $new->id;
            }
        }

        // // 3️⃣ Delete Removed Rows
        // $deleteIds = array_diff($existingIds, $keptIds);

        // if (!empty($deleteIds)) {
        //     InsuranceSubContent::whereIn('id', $deleteIds)->delete();
        // }

        return redirect()->route('admin.pages.index')
            ->with('success', 'Content updated successfully.');
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
        $data['id'] = $id;
        $data['edit_banner'] = InsuranceBanner::where('pages_id', $id)->first();
        $data['edit_content'] = InsuranceContent::where('pages_id', $id)->with('subContents')->first();
        return view('admin.insurance.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $banner = InsuranceBanner::findOrFail($request->banner_id);

        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $banner->image;

        // If new image uploaded
        if ($request->hasFile('image')) {

            // Delete old image
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/insurance/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/insurance/banner/' . $imageName;
        }

        $banner->update([
            'pages_id' => $request->pages_id,
            'title' => $request->title,
            'button_text' => $request->button_text,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Banner updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
