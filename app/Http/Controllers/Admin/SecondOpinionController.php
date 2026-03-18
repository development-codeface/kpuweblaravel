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
        $banner = OpinionBanner::where('pages_id', $id)->first();
        $contents = OpinionContent::where('pages_id', $id)->get();
        
        return view('admin.opinion.create', compact('id', 'banner', 'contents'));
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
            'image'              => $request->banner_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->banner_id) {
            $banner = OpinionBanner::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new OpinionBanner();
        }

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/opinion/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/opinion/banner/' . $imageName;
        }

        $banner->pages_id    = $request->pages_id;
        $banner->title       = $request->title;
        $banner->button_text = $request->button_text;
        $banner->description = $request->banner_description;
        $banner->save();

        return redirect()->route('admin.pages.index')->with('success', 'Openion banner created successfully.');
    }

    public function contentStore(Request $request)
    {
        $request->validate([
            'heading.*'     => 'required|string|max:255',
            'description.*' => 'required|string',
        ]);

        $submittedIds = [];

        foreach ($request->heading as $index => $heading) {

            $contentId = $request->content_id[$index] ?? null;

            $data = [
                'pages_id'    => $request->pages_id,
                'heading'     => $heading,
                'description' => $request->description[$index] ?? null,
            ];

            if ($contentId) {

                // UPDATE
                OpinionContent::where('id', $contentId)->update($data);
                $submittedIds[] = $contentId;
            } else {

                // CREATE
                $new = OpinionContent::create($data);
                $submittedIds[] = $new->id;
            }
        }

        // 🔥 DELETE removed rows
        OpinionContent::where('pages_id', $request->pages_id)
            ->whereNotIn('id', $submittedIds)
            ->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Content saved successfully.');
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
    public function edit(string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
