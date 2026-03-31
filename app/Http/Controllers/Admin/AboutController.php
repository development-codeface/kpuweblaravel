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
        $data['id'] = $id;
        $data['edit_banner'] = AboutBanner::where('pages_id', $data['id'])->first();
        $data['edit_blog']   = AboutBlog::where('pages_id', $data['id'])->first();
        $data['edit_content']     = AboutContent::where('pages_id', $data['id'])->first();
        $data['about_feature'] = AboutFeature::with('featureContents')->where('pages_id', $data['id'])->first();
        $data['sub_content']   = AboutSubContent::where('pages_id', $data['id'])->first();
        $data['mid_content']   = AboutMidContent::with('aboutMidSubContent')->where('pages_id', $data['id'])->first();
        $data['section']       = AboutSection::with('subSection')->where('pages_id', $data['id'])->first();
        return view('admin.about.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function bannerStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'image' => $request->banner_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->banner_id) {
            $aboutBanner = AboutBanner::findOrFail($request->banner_id);
        } else {
            $aboutBanner = new AboutBanner();
        }

        if ($request->hasFile('image')) {
            if ($aboutBanner->image && file_exists(public_path($aboutBanner->image))) {
                unlink(public_path($aboutBanner->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/about/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $aboutBanner->image = 'images/about/banner/' . $imageName;
        }

        $aboutBanner->pages_id = $request->input('about_id');
        $aboutBanner->title = $request->input('title');
        $aboutBanner->button_text = $request->input('button_text');
        $aboutBanner->status = $aboutBanner->status ?? 'active';
        $aboutBanner->save();

        return redirect()->route('admin.pages.index')->with('success', 'About banner created successfully.');
    }

    public function blogStore(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'Blog_title' => 'required|string|max:255',
            'sub_heading' => 'required|string|max:255',
            'blog_description' => 'required',
            'blog_icon' => 'required|string|max:255',
            'sub_heading_two' => 'required|string|max:255',
            'sub_description' => 'required',
            'Blog_image'              => $request->blog_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        // UPDATE OR CREATE
        $blog = AboutBlog::updateOrCreate(
            ['id' => $request->blog_id],
            [
                'pages_id'          => $request->about_id,
                'heading'           => $request->heading,
                'title'             => $request->Blog_title,
                'button_text'       => $request->button_text ?? null,
                'button_link'       => $request->button_link ?? null,
                'sub_heading'       => $request->sub_heading,
                'description'       => $request->blog_description,
                'icon'              => $request->blog_icon,
                'icon_heading'      => $request->sub_heading_two,
                'icon_description'  => $request->sub_description,
                'status'            => 1,
            ]
        );

        // IMAGE UPLOAD
        if ($request->hasFile('Blog_image')) {

            // delete old image if exists
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

            $blog->image = 'images/about/blogs/' . $imageName;
            $blog->save();
        }

        return redirect()->route('admin.pages.index')->with('success', 'About blog created successfully.');
    }


    public function contentStore(Request $request)
    {

        $request->validate([
            'content_heading' => 'required|string|max:255',
            'content_description' => 'required',
            'logo_image'              => $request->content_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // UPDATE OR CREATE
        $content = AboutContent::updateOrCreate(
            ['id' => $request->content_id],
            [
                'pages_id' => $request->about_id,
                'heading' => $request->content_heading,
                'content' => $request->content_description,
            ]
        );

        // IMAGE UPLOAD
        if ($request->hasFile('logo_image')) {

            // delete old image if exists
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

            $content->image = 'images/about/content/' . $imageName;
            $content->save();
        }

        return redirect()->route('admin.pages.index')->with('success', 'About blog created successfully.');
    }

    public function featureStore(Request $request)
    {
        $request->validate([
            'feature_title'     => 'required|string|max:255',
            'feature_sub_title' => 'required|string|max:255',

            'feature_icon'        => 'required|array',
            'feature_icon.*'      => 'required|string|max:255',

            'name'        => 'required|array',
            'name.*'      => 'required|string|max:255',

            'feature_description'   => 'required|array',
            'feature_description.*' => 'required|string',
        ]);

        $feature = AboutFeature::updateOrCreate(
            ['id' => $request->feature_id],
            [
                'pages_id'  => $request->about_id,
                'title'     => $request->feature_title,
                'sub_title' => $request->feature_sub_title,
            ]
        );

        $savedContentIds = [];

        foreach ($request->feature_icon as $key => $icon) {

            $contentId = $request->content_id[$key] ?? null;

            $featureContent = AboutFeatureContent::updateOrCreate(
                ['id' => $contentId],
                [
                    'about_feature_id' => $feature->id,
                    'icon'             => $icon,
                    'name'             => $request->name[$key],
                    'description'      => $request->feature_description[$key],
                ]
            );

            $savedContentIds[] = $featureContent->id;
        }

        // AboutFeatureContent::where('about_feature_id', $feature->id)
        //     ->whereNotIn('id', $savedContentIds)
        //     ->delete();

        return redirect()->route('admin.pages.index')->with('success', 'About banner created successfully.');
    }

    public function subContentStore(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'content_sub_title' => 'required|string|max:255',
            'description' => 'required'
        ]);

        $content = AboutSubContent::updateOrCreate(
            ['id' => $request->sub_content_id],
            [
                'pages_id' => $request->about_id,
                'title'    => $request->title,
                'sub_title' => $request->content_sub_title,
                'description' => $request->description
            ]
        );

        return redirect()->route('admin.pages.index')->with('success', 'About Content created successfully.');
    }


    public function midContent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon.*' => 'required|string|max:255',
            'sub_title.*' => 'required|string|max:255',
            'description.*' => 'required|string',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $mid = AboutSubContent::updateOrCreate(
            ['id' => $request->mid_content_id],
            [
                'pages_id' => $request->about_id,
                'title'    => $request->title
            ]
        );


        $existingIds = [];

        foreach ($request->icon as $index => $icon) {

            $subId = $request->mid_sub_content_id[$index] ?? null;
            $imagePath = null;

            if ($subId) {
                $sub = AboutMidSubContent::find($subId);
                $existingIds[] = $subId;
                $imagePath = $sub->image;
            } else {
                $sub = new AboutMidSubContent();
                $sub->about_mid_content_id = $mid->id;
            }

            // Image Upload
            if ($request->hasFile('images') && isset($request->file('images')[$index])) {

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

            $sub->icon = $icon;
            $sub->title = $request->sub_title[$index];
            $sub->description = $request->description[$index];
            $sub->image = $imagePath;
            $sub->about_mid_content_id = $mid->id;
            $sub->save();
        }

        // 3️⃣ Delete removed rows
        // AboutMidSubContent::where('about_mid_content_id', $mid->id)
        //     ->whereNotIn('id', $existingIds)
        //     ->delete();

        return redirect()->route('admin.pages.index')->with('success', 'About created successfully.');
    }



    public function sectionStore(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'section_icon.*' => 'required|string|max:255',
            'section_sub_title.*' => 'required|string|max:255',
            'section_description.*' => 'required|string',
        ]);

        $section = AboutSection::updateOrCreate(
            ['id' => $request->section_id],
            [
                'pages_id' => $request->about_id,
                'heading'  => $request->heading,
                'title'    => $request->title,
            ]
        );


        $existingIds = [];
        $submittedIds = [];

        if ($request->section_icon) {
            foreach ($request->section_icon as $key => $icon) {

                $subId = $request->sub_section_id[$key] ?? null;

                if ($subId) {

                    // UPDATE
                    $sub = AboutSubSection::find($subId);

                    if ($sub) {
                        $sub->update([
                            'icon' => $icon,
                            'title' => $request->section_sub_title[$key],
                            'description' => $request->section_description[$key],
                        ]);

                        $submittedIds[] = $subId;
                    }
                } else {

                    // INSERT
                    $new = AboutSubSection::create([
                        'about_section_id' => $section->id,
                        'icon' => $icon,
                        'title' => $request->section_sub_title[$key],
                        'description' => $request->section_description[$key],
                    ]);

                    $submittedIds[] = $new->id;
                }
            }
        }

        // 3️⃣ Delete removed rows
        // $existingIds = $section->subSection()->pluck('id')->toArray();

        // $deleteIds = array_diff($existingIds, $submittedIds);

        // AboutSubSection::whereIn('id', $deleteIds)->delete();

        return redirect()->route('admin.pages.index')->with('success', 'About banner created successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
