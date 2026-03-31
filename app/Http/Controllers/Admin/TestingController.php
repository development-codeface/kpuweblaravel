<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestingBanner;
use App\Models\TestingService;
use App\Models\TestingSubService;
use Illuminate\Http\Request;

class TestingController extends Controller
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
        $data['banner'] = TestingBanner::where('pages_id', $id)->first();
        $data['content'] = TestingService::with('subContents')->where('pages_id', $id)->first();
        return view('admin.testing.create', $data);
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
            $banner = TestingBanner::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new TestingBanner();
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/testing/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/testing/banner/' . $imageName;
        }

        // Common Fields
        $banner->pages_id    = $request->pages_id;
        $banner->title       = $request->title;
        $banner->button_text = $request->button_text;
        $banner->description = $request->description;
        $banner->save();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Hospital testing saved successfully.');
    }

    public function contentStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'content_description' => 'required|string|max:255',

            'images' => $request->content_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'heading' => 'required|array|min:1',
            'heading.*' => 'required|string|max:255',

            'sub_description' => 'required|array|min:1',
            'sub_description.*' => 'required|string',
        ]);



        if ($request->content_id) {

            $content = TestingService::findOrFail($request->content_id);

            $content->update([
                'pages_id'  => $request->pages_id,
                'title'     => $request->title,
                'description' => $request->content_description,
            ]);
        } else {

            $content = TestingService::create([
                'pages_id'  => $request->pages_id,
                'title'     => $request->title,
                'description' => $request->content_description,
            ]);
        }



        if ($request->hasFile('images')) {

            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/service/testing/content');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // delete old image if update
            if (!empty($content->image) && file_exists(public_path($content->image))) {
                unlink(public_path($content->image));
            }

            $image->move($destinationPath, $imageName);

            $content->update([
                'image' => 'images/service/testing/content/' . $imageName
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
                TestingSubService::where('id', $subId)->update([
                    'heading'     => $heading,
                    'description' => $request->sub_description[$index],
                ]);
            } else {
                // CREATE NEW
                TestingSubService::create([
                    'testing_services_id'    => $content->id,
                    'heading'                => $heading,
                    'description'            => $request->sub_description[$index],
                ]);
            }
        }

        return redirect()->route('admin.pages.index')
            ->with('success', 'saved successfully.');
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
