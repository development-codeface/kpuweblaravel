<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpinionBanner;
use App\Models\OpinionContent;

class SecondOpinionController extends Controller
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
        return view('admin.opinion.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'banner_description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/opinion/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/opinion/banner/' . $imageName;
        }

        OpinionBanner::create([
            'pages_id'   => $request->pages_id,
            'title'      => $request->title,
            'button_text' => $request->button_text,
            'description' => $request->banner_description,
            'image'      => $imagePath,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Career banner created successfully.');
    }

    public function contentStore(Request $request)
    {
        $request->validate([
            'heading.*' => 'required|string|max:255',
            'description.*' => 'required|string',
        ]);

        foreach ($request->heading as $index => $heading) {

            OpinionContent::create([
                'pages_id'    => $request->pages_id,
                'heading'     => $heading,
                'description' => $request->description[$index] ?? null,
            ]);
        }

        return redirect()->route('admin.pages.index')->with('success', 'Career content created successfully.');
    }

    public function contentUpdate(Request $request, $id)
    {
        $request->validate([
            'heading.*' => 'required|string|max:255',
            'description.*' => 'required|string',
        ]);

        // $existingIds = OpinionContent::where('pages_id', $request->pages_id)
        //     ->pluck('id')
        //     ->toArray();

        // $submittedIds = [];

        foreach ($request->heading as $index => $heading) {

            $contentId = $request->content_id[$index] ?? null;

            if ($contentId) {
                // UPDATE existing row
                $content = OpinionContent::find($contentId);
                if ($content) {
                    $content->update([
                        'heading' => $heading,
                        'description' => $request->description[$index] ?? null,
                    ]);
                    $submittedIds[] = $contentId;
                }
            } else {
                // CREATE new row
                $new = OpinionContent::create([
                    'pages_id' => $$request->pages_id,
                    'heading' => $heading,
                    'description' => $request->description[$index] ?? null,
                ]);
                $submittedIds[] = $new->id;
            }
        }

        // // DELETE removed rows
        // $idsToDelete = array_diff($existingIds, $submittedIds);

        // if (!empty($idsToDelete)) {
        //     OpinionContent::whereIn('id', $idsToDelete)->delete();
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
        $data['id'] = $id;
        $data['banner'] = OpinionBanner::where('pages_id', $id)->first();
        $data['contents'] = OpinionContent::where('pages_id', $id)->get();
        return view('admin.opinion.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $banner = OpinionBanner::findOrFail($request->banner_id);

        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'banner_description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $banner->image; // keep old image

        if ($request->hasFile('image')) {

            // delete old image
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/opinion/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/opinion/banner/' . $imageName;
        }

        $banner->update([
            'title' => $request->title,
            'button_text' => $request->button_text,
            'description' => $request->banner_description,
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
