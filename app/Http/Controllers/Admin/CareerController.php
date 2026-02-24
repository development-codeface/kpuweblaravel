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
        return view('admin.career.create', compact('id'));
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

            $destinationPath = public_path('images/career/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/career/banner/' . $imageName;
        }

        CareerBanner::create([
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
        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $banner = CareerBanner::where('pages_id', $id)->first();

        $imagePath = $banner->image; // keep old image by default

        if ($request->hasFile('image')) {

            // 🔹 Delete old image
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            // 🔹 Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/career/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/career/banner/' . $imageName;
        }

        $banner->update([
            'title'       => $request->title,
            'button_text' => $request->button_text,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Career banner updated successfully.');
    }



    public function contentStore(Request $request)
    {
        $request->validate([
            'icon.*' => 'required|string|max:255',
            'mid_title.*' => 'required|string|max:255',
            'job_type.*' => 'required|string|max:255',
            'work_mode.*' => 'nullable|string|max:255',
            'salary_min.*' => 'nullable',
            'salary_max.*' => 'nullable',
            'salary_type.*' => 'nullable|string|max:50',
            'location.*' => 'nullable|string|max:255',
        ]);

        foreach ($request->mid_title as $index => $title) {
            CareerContent::create([
                'pages_id'    => $request->pages_id ?? null,
                'title'      => $title,
                'job_type'   => $request->job_type[$index] ?? null,
                'work_mode'  => $request->work_mode[$index] ?? null,
                'salary_min' => $request->salary_min[$index] ?? null,
                'salary_max' => $request->salary_max[$index] ?? null,
                'salary_type' => $request->salary_type[$index] ?? null,
                'location'   => $request->location[$index] ?? null,
                'icon'      => $request->icon[$index],
            ]);
        }
        return redirect()->route('admin.pages.index')->with('success', 'Career banner created successfully.');
    }

    public function contentUpdate(Request $request)
    {
        $request->validate([
            'icon.*'        => 'required|string|max:255',
            'mid_title.*'   => 'required|string|max:255',
            'job_type.*'    => 'required|string|max:255',
            'work_mode.*'   => 'nullable|string|max:255',
            'salary_min.*'  => 'nullable',
            'salary_max.*'  => 'nullable',
            'salary_type.*' => 'nullable|string|max:50',
            'location.*'    => 'nullable|string|max:255',
        ]);

        foreach ($request->mid_title as $index => $title) {

            $contentId = $request->content_id[$index] ?? null;

            if ($contentId) {

                CareerContent::where('id', $contentId)->update([
                    'title'       => $title,
                    'job_type'    => $request->job_type[$index] ?? null,
                    'work_mode'   => $request->work_mode[$index] ?? null,
                    'salary_min'  => $request->salary_min[$index] ?? null,
                    'salary_max'  => $request->salary_max[$index] ?? null,
                    'salary_type' => $request->salary_type[$index] ?? null,
                    'location'    => $request->location[$index] ?? null,
                    'icon'        => $request->icon[$index],
                ]);
            } else {

                CareerContent::create([
                    'pages_id'    => $request->pages_id,
                    'title'       => $title,
                    'job_type'    => $request->job_type[$index] ?? null,
                    'work_mode'   => $request->work_mode[$index] ?? null,
                    'salary_min'  => $request->salary_min[$index] ?? null,
                    'salary_max'  => $request->salary_max[$index] ?? null,
                    'salary_type' => $request->salary_type[$index] ?? null,
                    'location'    => $request->location[$index] ?? null,
                    'icon'        => $request->icon[$index],
                ]);
            }
        }

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Career content updated successfully.');
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
        //
        $data['id'] = $id;
        $data['banner_edit']  = CareerBanner::where('pages_id', $id)->first();
        $data['content_edit'] = CareerContent::where('pages_id', $id)->get();
        return view('admin.career.edit', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
