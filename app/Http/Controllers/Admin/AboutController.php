<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutBanner;
use App\Models\AboutBlog;
use App\Models\AboutContent;
use App\Models\AboutFeature;
use App\Models\AboutFeatureContent;
use App\Models\AboutSubContent;
use App\Models\AboutMidContent;
use App\Models\AboutMidSubContent;
use App\Models\AboutSection;
use App\Models\AboutSubSection;

class AboutController extends Controller
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
        return view('admin.about.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function bannerStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255', // Example validation rule
            'button_text' => 'required|string|max:255', // Example validation rule
        ]);

        $aboutBanner = new AboutBanner();
        $aboutBanner->pages_id = $request->input('about_id');
        $aboutBanner->title = $request->input('title');
        $aboutBanner->button_text = $request->input('button_text');
        $aboutBanner->save();
        return redirect()->route('admin.pages.index')->with('success', 'About banner created successfully.');
    }

    public function bannerUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
        ]);

        $aboutBanner = AboutBanner::where('pages_id', $id)->update([
            'pages_id'   => $request->about_id,
            'title'      => $request->title,
            'button_text' => $request->button_text
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'About banner updated successfully.');
    }


    public function blogStore(Request $request)
    {
        //   dd($request->all());
        $request->validate([
            'heading' => 'required|string|max:255',
            'Blog_title' => 'required|string|max:255',
            'Blog_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sub_heading' => 'required|string|max:255',
            'description' => 'required',
            'icon' => 'required|string|max:255',
            'sub_heading_two' => 'required|string|max:255',
            'sub_description' => 'required',
        ]);


        $imagePath = null;

        if ($request->hasFile('Blog_image')) {

            $image = $request->file('Blog_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/about/blogs');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/about/blogs/' . $imageName;
        }

        AboutBlog::create([
            'pages_id' => $request->about_id,
            'heading' => $request->heading,
            'title' => $request->Blog_title,
            'image' => $imagePath,
            'button_text' => $request->button_text ?? null,
            'button_link' => $request->button_link ?? null,
            'sub_heading' => $request->sub_heading,
            'description' => $request->description,
            'icon' => $request->icon,
            'icon_heading' => $request->sub_heading_two,
            'icon_description' => $request->sub_description,
            'status' => 1,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'About blog created successfully.');
    }

    public function blogUpdate(Request $request, $id)
    {
        $blog = AboutBlog::where('pages_id', $id)->first();

        $request->validate([
            'heading' => 'required|string|max:255',
            'Blog_title' => 'required|string|max:255',
            'Blog_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sub_heading' => 'required|string|max:255',
            'description' => 'required',
            'icon' => 'required|string|max:255',
            'sub_heading_two' => 'required|string|max:255',
            'sub_description' => 'required',
        ]);

        $imagePath = $blog->image; // keep old image by default

        if ($request->hasFile('Blog_image')) {

            // Delete old image
            if ($blog->image && file_exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }

            $image = $request->file('Blog_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/about/blogs');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/about/blogs/' . $imageName;
        }

        AboutBlog::where('pages_id', $id)->update([
            'pages_id' => $request->about_id,
            'heading' => $request->heading,
            'title' => $request->Blog_title,
            'image' => $imagePath,
            'button_text' => $request->button_text ?? null,
            'button_link' => $request->button_link ?? null,
            'sub_heading' => $request->sub_heading,
            'description' => $request->description,
            'icon' => $request->icon,
            'icon_heading' => $request->sub_heading_two,
            'icon_description' => $request->sub_description,
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'About blog updated successfully.');
    }


    public function contentStore(Request $request)
    {
        $request->validate([
            'content_heading' => 'required|string|max:255',
            'logo_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required',
        ]);

        $imagePath = null;

        if ($request->hasFile('logo_image')) {

            $image = $request->file('logo_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/about/content');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/about/content/' . $imageName;
        }

        AboutContent::create([
            'pages_id' => $request->about_id,
            'heading' => $request->content_heading,
            'logo_image' => $imagePath,
            'content' => $request->description,
            'status' => 1,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'About blog created successfully.');
    }

    public function contentUpdate(Request $request, $id)
    {
        $request->validate([
            'content_heading' => 'required|string|max:255',
            'logo_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required',
        ]);

        $content = AboutContent::where('pages_id', $id)->first();

        $imagePath = $content->logo_image; // keep old image by default

        if ($request->hasFile('logo_image')) {

            // Delete old image if exists
            if ($content->logo_image && file_exists(public_path($content->logo_image))) {
                unlink(public_path($content->logo_image));
            }

            $image = $request->file('logo_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/about/content');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/about/content/' . $imageName;
        }

        $content->update([
            'pages_id' => $request->about_id,
            'heading' => $request->content_heading,
            'logo_image' => $imagePath,
            'content' => $request->description,
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'About blog updated successfully.');
    }


    public function featureStore(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',

            'icon'        => 'required|array',
            'icon.*'      => 'required|string|max:255',

            'name'        => 'required|array',
            'name.*'      => 'required|string|max:255',

            'description'   => 'required|array',
            'description.*' => 'required|string',
        ]);


        $feature = AboutFeature::create([
            'pages_id'   => $request->about_id,
            'title'       => $request->title,
            'sub_title'   => $request->sub_title,
        ]);

        $IconArray = $request->input('icon');

        foreach ($IconArray as $key => $icon) {
            AboutFeatureContent::create([
                'about_feature_id'  => $feature->id,
                'icon'        => $icon,
                'name'        => $request->input('name')[$key],
                'description' => $request->input('description')[$key],
            ]);
        }

        return redirect()->route('admin.pages.index')->with('success', 'About banner created successfully.');
    }

    public function featureUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',

            'icon' => 'required|array',
            'icon.*' => 'required|string',

            'name' => 'required|array',
            'name.*' => 'required|string',

            'description' => 'required|array',
            'description.*' => 'required|string',
        ]);
        $feature = AboutFeature::where('pages_id', $id)->first();

        $feature->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
        ]);

        $contentIds = $request->input('content_id', []);

        foreach ($request->input('icon') as $key => $icon) {
            $contentId = $contentIds[$key] ?? null;

            if ($contentId) {
                // Update existing content
                $featureContent = AboutFeatureContent::find($contentId);
                if ($featureContent) {
                    $featureContent->update([
                        'icon' => $icon,
                        'name' => $request->input('name')[$key],
                        'description' => $request->input('description')[$key],
                    ]);
                }
            } else {
                // Create new content
                AboutFeatureContent::create([
                    'about_feature_id' => $feature->id,
                    'icon' => $icon,
                    'name' => $request->input('name')[$key],
                    'description' => $request->input('description')[$key],
                ]);
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'About banner created successfully.');
    }

    public function subContentStore(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'description' => 'required'
        ]);

        AboutSubContent::create([
            'pages_id' => $request->about_id,
            'title'    => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'About banner created successfully.');
    }

    public function subContentUpdate(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'sub_title'   => 'required|string|max:255',
            'description' => 'required'
        ]);

        $subContent = AboutSubContent::where('pages_id', $id)->first();

        $subContent->update([
            'pages_id'   => $request->about_id,
            'title'      => $request->title,
            'sub_title'  => $request->sub_title,
            'description' => $request->description
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'About banner updated successfully.');
    }


    public function midContent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon.*' => 'required|string|max:255',
            'title.*' => 'required|string|max:255',
            'description.*' => 'required|string',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $mid = AboutMidContent::create([
            'pages_id' => $request->about_id,
            'title' => $request->title,
        ]);

        if ($request->icon) {

            foreach ($request->icon as $index => $icon) {

                $imagePath = null;

                if ($request->hasFile('images') && isset($request->file('images')[$index])) {

                    $image = $request->file('images')[$index];
                    $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path('images/about/mid_content');

                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    $image->move($destinationPath, $imageName);

                    $imagePath = 'images/about/mid_content/' . $imageName;
                }

                AboutMidSubContent::create([
                    'about_mid_content_id' => $mid->id,
                    'icon' => $icon,
                    'title' => $request->sub_title[$index],
                    'description' => $request->description[$index],
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'About created successfully.');
    }

    public function midContentUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icons.*' => 'required|string|max:255',
            'sub_titles.*' => 'required|string|max:255',
            'descriptions.*' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // 1️⃣ Update Main Table (Single Title)
        $mid = AboutMidContent::where('pages_id', $id)->first();

        $mid->update([
            'title' => $request->title,
        ]);

        $existingIds = [];

        // 2️⃣ Loop Rows
        foreach ($request->icons as $index => $icon) {

            $subId = $request->mid_content_id[$index] ?? null;
            $imagePath = null;

            if ($subId) {
                // Existing row
                $sub = AboutMidSubContent::find($subId);
                $existingIds[] = $subId;

                $imagePath = $sub->image; // keep old image
            } else {
                // New row
                $sub = new AboutMidSubContent();
                $sub->about_mid_content_id = $mid->id;
            }

            // 🔹 If new image uploaded
            if ($request->hasFile('images') && isset($request->file('images')[$index])) {

                // Delete old image
                if (!empty($sub->image) && file_exists(public_path($sub->image))) {
                    unlink(public_path($sub->image));
                }

                $image = $request->file('images')[$index];
                $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('images/about/mid_content');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);

                $imagePath = 'images/about/mid_content/' . $imageName;
            }
            if ($subId) {
                $sub->icon = $icon;
                $sub->title = $request->sub_titles[$index];
                $sub->description = $request->descriptions[$index];
                $sub->image = $imagePath;

                $sub->save();
            } else {
                AboutMidSubContent::create([
                    'about_mid_content_id' => $mid->id,
                    'icon' => $icon,
                    'title' => $request->sub_titles[$index],
                    'description' => $request->descriptions[$index],
                    'image' => $imagePath,
                ]);
            }
        }
        return redirect()->route('admin.pages.index')
            ->with('success', 'Mid content updated successfully.');
    }


    public function sectionStore(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'icon.*' => 'required|string|max:255',
            'sub_title.*' => 'required|string|max:255',
            'description.*' => 'required|string',
        ]);

        $section = AboutSection::create([
            'pages_id' => $request->about_id,
            'heading'  => $request->heading,
            'title'    => $request->title,
        ]);

        if ($request->icon) {

            foreach ($request->icon as $key => $icon) {

                AboutSubSection::create([
                    'about_section_id' => $section->id,
                    'icon'       => $icon,
                    'title'  => $request->sub_title[$key] ?? null,
                    'description' => $request->description[$key] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'About banner created successfully.');
    }

    public function sectionUpdate(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'icon.*' => 'required|string|max:255',
            'sub_title.*' => 'required|string|max:255',
            'description.*' => 'required|string',
        ]);

        $section = AboutSection::where('pages_id',$id)->first();

        // Update main section
        $section->update([
            'heading' => $request->heading,
            'title'   => $request->title,
        ]);

        $existingIds = $section->subSection()->pluck('id')->toArray();
        $submittedIds = [];

        foreach ($request->icon as $key => $icon) {

            $subId = $request->sub_section_id[$key] ?? null;

            if ($subId) {

                // UPDATE existing row
                $subSection = AboutSubSection::find($subId);

                if ($subSection) {
                    $subSection->update([
                        'icon' => $icon,
                        'title' => $request->sub_title[$key],
                        'description' => $request->description[$key],
                    ]);

                    $submittedIds[] = $subId;
                }
            } else {

                // INSERT new row
                $new = AboutSubSection::create([
                    'about_section_id' => $section->id,
                    'icon' => $icon,
                    'title' => $request->sub_title[$key],
                    'description' => $request->description[$key],
                ]);

                $submittedIds[] = $new->id;
            }
        }

        // DELETE removed rows
        // $deleteIds = array_diff($existingIds, $submittedIds);

        // AboutSubSection::whereIn('id', $deleteIds)->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Section updated successfully.');
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
        $data['edit_banner'] = AboutBanner::where('pages_id', $data['id'])->first();
        $data['edit_blog']   = AboutBlog::where('pages_id', $data['id'])->first();
        $data['edit_content']     = AboutContent::where('pages_id', $data['id'])->first();
        $data['about_feature'] = AboutFeature::with('featureContents')->where('pages_id', $data['id'])->first();
        $data['sub_content']   = AboutSubContent::where('pages_id', $data['id'])->first();
        $data['mid_content']   = AboutMidContent::with('aboutMidSubContent')->where('pages_id', $data['id'])->first();
        $data['section']       = AboutSection::with('subSection')->where('pages_id', $data['id'])->first();
        return view('admin.about.edit', $data);
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
