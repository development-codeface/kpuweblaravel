<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HealthPakageBanner;
use App\Models\HealthPackagecontent;
use Illuminate\Support\Facades\DB;
use App\Models\HealthPackageBlog;

class HealthPackagesController extends Controller
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
        $category = DB::table('category')->select('id', 'name')->get();
        return view('admin.health_package.create', compact('id', 'category'));
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

            $destinationPath = public_path('images/health_package/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/health_package/banner/' . $imageName;
        }

        HealthPakageBanner::create([
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
        ]);

        HealthPackagecontent::create([
            'pages_id'   => $request->pages_id,
            'title'      => $request->title,
            'sub_title' => $request->sub_title,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Career content created successfully.');
    }

    public function blogStore(Request $request)
    {
        $request->validate([
            'category'        => 'required',
            'blog_title.*'         => 'required|string|max:255',
            'sub_title.*'     => 'required|string|max:255',
            'name.*'          => 'required|string|max:255',
            'designation.*'   => 'required|string|max:255',
            'image.*'         => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        foreach ($request->blog_title as $key => $value) {

            $imagePath = null;

            if ($request->hasFile('image') && isset($request->file('image')[$key])) {

                $image = $request->file('image')[$key];

                $imageName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('images/health_package/blog');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);

                $imagePath = 'images/health_package/blog/' . $imageName;
            }

            HealthPackageBlog::create([
                'pages_id'     => $request->pages_id,
                'category_id'  => $request->category,
                'title'        => $request->blog_title[$key],
                'sub_title'    => $request->sub_titles[$key],
                'name'         => $request->name[$key],
                'designation'  => $request->designation[$key],
                'image'        => $imagePath,
            ]);
        }


        return redirect()->route('admin.pages.index')->with('success', 'Career content created successfully.');
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
        $data['edit_banner'] = HealthPakageBanner::where('pages_id', $id)->first();
        $data['edit_content'] = HealthPackagecontent::where('pages_id', $id)->first();
        return view('admin.health_package.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'button_text'  => 'required|string|max:255',
            'description'  => 'required',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $banner = HealthPakageBanner::findOrFail($request->banner_id);

        $imagePath = $banner->image;

        if ($request->hasFile('image')) {

            // delete old image
            if (!empty($banner->image) && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/health_package/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/health_package/banner/' . $imageName;
        }

        $banner->update([
            'title'       => $request->title,
            'button_text' => $request->button_text,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Health package banner updated successfully.');
    }

    public function ContentUpdate(Request $request, $id)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
        ]);

        $content = HealthPackagecontent::findOrFail($request->content_id);

        $content->update([
            'title'     => $request->title,
            'sub_title' => $request->sub_title,
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Health package content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
