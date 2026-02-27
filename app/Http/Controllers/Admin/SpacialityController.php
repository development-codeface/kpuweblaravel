<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpacialityBanner;
use App\Models\SpacialityBlog;
use App\Models\SpacialityContent;
use App\Models\SpacialitySubContent;

class SpacialityController extends Controller
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
        $data['banner'] = SpacialityBanner::where('pages_id', $id)->first();
        $data['content'] = SpacialityContent::where('pages_id', $id)->with('subContents')->first();
        $data['blog']    = SpacialityBlog::where('pages_id', $id)->get();
        return view('admin.spaciality.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'              => 'required|string|max:255',
            'button_text'        => 'required|string|max:255',
            'text'               => 'required|string',
            'banner_description' => 'required|string',
            'image'              => $request->banner_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Check if updating
        if ($request->banner_id) {
            $banner = SpacialityBanner::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new SpacialityBanner();
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/spaciality/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/spaciality/banner/' . $imageName;
        }

        // Common Fields
        $banner->pages_id    = $request->pages_id;
        $banner->title       = $request->title;
        $banner->button_text = $request->button_text;
        $banner->text        = $request->text;
        $banner->description = $request->banner_description;
        $banner->save();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Spaciality saved successfully.');
    }

    public function contentStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',

            'images' => $request->content_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'heading' => 'required|array|min:1',
            'heading.*' => 'required|string|max:255',

            'description' => 'required|array|min:1',
            'description.*' => 'required|string',
        ]);



        if ($request->content_id) {

            $content = SpacialityContent::findOrFail($request->content_id);

            $content->update([
                'pages_id'  => $request->pages_id,
                'title'     => $request->title,
                'sub_title' => $request->sub_title,
            ]);
        } else {

            $content = SpacialityContent::create([
                'pages_id'  => $request->pages_id,
                'title'     => $request->title,
                'sub_title' => $request->sub_title,
            ]);
        }



        if ($request->hasFile('images')) {

            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/spaciality/content');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // delete old image if update
            if (!empty($content->image) && file_exists(public_path($content->image))) {
                unlink(public_path($content->image));
            }

            $image->move($destinationPath, $imageName);

            $content->update([
                'image' => 'images/spaciality/content/' . $imageName
            ]);
        }

        // $existingIds = SpacialitySubContent::where('spaciality_contents_id', $content->id)
        //     ->pluck('id')
        //     ->toArray();

        // $submittedIds = array_filter($request->sub_content_id ?? []);

        // $idsToDelete = array_diff($existingIds, $submittedIds);

        // if (!empty($idsToDelete)) {
        //     SpacialitySubContent::whereIn('id', $idsToDelete)->delete();
        // }


        foreach ($request->heading as $index => $heading) {

            $subId = $request->sub_content_id[$index] ?? null;

            if ($subId) {

                // UPDATE EXISTING
                SpacialitySubContent::where('id', $subId)->update([
                    'heading'     => $heading,
                    'description' => $request->description[$index],
                ]);
            } else {

                // CREATE NEW
                SpacialitySubContent::create([
                    'spaciality_contents_id' => $content->id,
                    'heading'                => $heading,
                    'description'            => $request->description[$index],
                ]);
            }
        }

        return redirect()->route('admin.pages.index')
            ->with('success', 'Spaciality saved successfully.');
    }

    public function blogStore(Request $request)
    {
        $request->validate([
            'icon.*'        => 'required',
            'blog_title.*'       => 'required',
            'blog_description.*' => 'required',
        ]);

        foreach ($request->blog_title as $key => $value) {

            if (!empty($request->blog_id[$key])) {

                // 🔵 UPDATE
                $blog = SpacialityBlog::findOrFail($request->blog_id[$key]);

                $blog->update([
                    'pages_id'   => $request->pages_id,
                    'icon'       => $request->icon[$key],
                    'title'      => $request->blog_title[$key],
                    'description' => $request->blog_description[$key],
                ]);
            } else {

                // 🟢 CREATE
                SpacialityBlog::create([
                    'pages_id'   => $request->pages_id,
                    'icon'       => $request->icon[$key],
                    'title'      => $request->blog_title[$key],
                    'description' => $request->blog_description[$key],
                ]);
            }
        }

        return redirect()->route('admin.pages.index')
            ->with('success', 'Spaciality saved successfully.');
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
        return view('admin.spaciality.edit');
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
