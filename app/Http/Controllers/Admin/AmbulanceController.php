<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AmbulanceBanner;
use Illuminate\Http\Request;
use App\Models\AmbulanceContent;
use App\Models\AmbulanceSubContent;

class AmbulanceController extends Controller
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
        return view('admin.ambulance.create', compact('id'));
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

            $destinationPath = public_path('images/ambulance/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/ambulance/banner/' . $imageName;
        }

        AmbulanceBanner::create([
            'pages_id'   => $request->pages_id,
            'title'      => $request->title,
            'button_text' => $request->button_text,
            'description' => $request->description,
            'image'      => $imagePath,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Career banner created successfully.');
    }

    public function update(Request $request, $id)
    {
        $banner = AmbulanceBanner::where('pages_id', $id)->first();

        $request->validate([
            'title'        => 'required|string|max:255',
            'button_text'  => 'required|string|max:255',
            'description'  => 'required',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $banner->image; // keep old image by default

        // If new image uploaded
        if ($request->hasFile('image')) {

            // Delete old image
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/ambulance/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/ambulance/banner/' . $imageName;
        }

        $banner->update([
            'pages_id'   => $request->pages_id,
            'title'        => $request->title,
            'button_text'  => $request->button_text,
            'description'  => $request->description,
            'image'        => $imagePath,
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Ambulance banner updated successfully.');
    }


    public function storeContent(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'required',
            'sub_title'       => 'required|string|max:255',
            'sub_description' => 'required',
            'number'          => 'required',
            'content_image'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'heading.*'       => 'required|string|max:255',
            'content_descriptions.*'  => 'required'
        ]);

        // Create a new AmbulanceContent record

        $imagePath = null;

        // ✅ Your Image Upload Logic
        if ($request->hasFile('content_image')) {

            $image = $request->file('content_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/ambulance/content');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/ambulance/content/' . $imageName;
        }

        // ✅ Insert Main Content
        $content = AmbulanceContent::create([
            'pages_id'        => $request->pages_id,
            'title'           => $request->title,
            'description'     => $request->description,
            'sub_title'       => $request->sub_title,
            'sub_description' => $request->sub_description,
            'number'          => $request->number,
            'image'           => $imagePath,
        ]);

        // ✅ Insert Multiple Sub Rows
        foreach ($request->heading as $index => $heading) {

            AmbulanceSubContent::create([
                'ambulance_contents_id' => $content->id,
                'title'                 => $heading,
                'description'           => $request->content_descriptions[$index] ?? null,
            ]);
        }

        return redirect()->route('admin.pages.index')->with('success', 'Ambulance content created successfully.');
    }

    public function updateContent(Request $request)
    {
        $request->validate([

            'title'           => 'required|string|max:255',
            'description'     => 'required',
            'sub_title'       => 'required|string|max:255',
            'sub_description' => 'required',
            'number'          => 'required',

            'content_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'heading.*'              => 'required|string|max:255',
            'content_descriptions.*' => 'required'
        ]);

        // 🔹 Find Main Record
        $content = AmbulanceContent::findOrFail($request->content_id);

        $imagePath = $content->image;

        // 🔹 Update Image (if new uploaded)
        if ($request->hasFile('content_image')) {

            if ($content->image && file_exists(public_path($content->image))) {
                unlink(public_path($content->image));
            }

            $image = $request->file('content_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/ambulance/content');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/ambulance/content/' . $imageName;
        }

        // 🔹 Update Main Content
        $content->update([
            'title'           => $request->title,
            'description'     => $request->description,
            'sub_title'       => $request->sub_title,
            'sub_description' => $request->sub_description,
            'number'          => $request->number,
            'image'           => $imagePath,
        ]);

        // 🔹 Handle Sub Contents
        $keepIds = [];

        foreach ($request->heading as $index => $heading) {

            $subId = $request->sub_content_id[$index] ?? null;

            if ($subId) {

                // ✅ Update Existing
                $sub = AmbulanceSubContent::find($subId);

                if ($sub) {
                    $sub->update([
                        'title'       => $heading,
                        'description' => $request->content_descriptions[$index] ?? null,
                    ]);

                    $keepIds[] = $sub->id;
                }
            } else {

                // ✅ Create New
                $newSub = AmbulanceSubContent::create([
                    'ambulance_contents_id' => $content->id,
                    'title'                 => $heading,
                    'description'           => $request->content_descriptions[$index] ?? null,
                ]);

                $keepIds[] = $newSub->id;
            }
        }

        // // 🔹 Delete Removed Rows
        // AmbulanceSubContent::where('ambulance_contents_id', $content->id)
        //     ->whereNotIn('id', $keepIds)
        //     ->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Ambulance content updated successfully.');
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
        $data['banner'] = AmbulanceBanner::where('pages_id', $id)->first();
        $data['contents'] = AmbulanceContent::with('sub_content')->where('pages_id', $id)->first();
        return view('admin.ambulance.edit', $data);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
