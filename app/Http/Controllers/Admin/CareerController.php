<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerBanner;
use App\Models\CareerContent;

class CareerController extends Controller
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
        $banner_edit = CareerBanner::where('pages_id', $id)->first();
        $content_edit = CareerContent::where('pages_id', $id)->get();
        return view('admin.career.create', compact('id', 'banner_edit', 'content_edit'));
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
            'image'              => $request->banner_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->banner_id) {
            $banner = CareerBanner::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new CareerBanner();
        }

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/career/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/career/banner/' . $imageName;
        }

        $banner->pages_id    = $request->pages_id;
        $banner->title       = $request->title;
        $banner->button_text = $request->button_text;
        $banner->description = $request->description;
        $banner->save();

        return redirect()->route('admin.pages.index')->with('success', 'Career banner created successfully.');
    }


    public function contentStore(Request $request)
    {
        $request->validate([
            'icon.*'        => 'required|string|max:255',
            'mid_title.*'   => 'required|string|max:255',
            'job_type.*'    => 'required|string|max:255',
            'work_mode.*'   => 'string|max:255',
            'salary_min.*'  => 'required',
            'salary_max.*'  => 'required',
            'salary_type.*' => 'required|string|max:50',
            'location.*'    => 'required|string|max:255',
        ]);

        $existingIds = [];

        foreach ($request->mid_title as $index => $title) {

            $contentId = $request->content_id[$index] ?? null;

            $data = [
                'pages_id'    => $request->pages_id,
                'title'       => $title,
                'job_type'    => $request->job_type[$index] ?? null,
                'work_mode'   => $request->work_mode[$index] ?? null,
                'salary_min'  => $request->salary_min[$index] ?? null,
                'salary_max'  => $request->salary_max[$index] ?? null,
                'salary_type' => $request->salary_type[$index] ?? null,
                'location'    => $request->location[$index] ?? null,
                'icon'        => $request->icon[$index],
            ];

            if ($contentId) {

                CareerContent::where('id', $contentId)->update($data);
                $existingIds[] = $contentId;
            } else {

                $new = CareerContent::create($data);
                $existingIds[] = $new->id;
            }
        }

        // 🔥 Delete removed rows (important)
        // CareerContent::where('pages_id', $request->pages_id)
        //     ->whereNotIn('id', $existingIds)
        //     ->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Career content saved successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
