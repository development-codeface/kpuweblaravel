<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\banner;
use App\Models\Content;
use App\Models\Section;
use App\Models\SubContent;
use App\Models\SubSection;

class HomeController extends Controller
{
    //
    public function create($id)
    {
        $edit_content = Content::where('pages_id', $id)->with('subContent')->first();
        $edit_banner = banner::where('pages_id', $id)->first();
        $edit_section = Section::where('pages_id', $id)->with('subContent')->first();
        return view('admin.home.create', compact('id', 'edit_banner', 'edit_content', 'edit_section'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'image'              => $request->banner_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->banner_id) {
            $banner = banner::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new banner();
        }

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/banners');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/banners/' . $imageName;
        }

        $banner->pages_id    = $request->pages_id;
        $banner->title       = $request->title;
        $banner->button_text = $request->button_text;
        $banner->save();

        return redirect()->route('admin.pages.index')->with('success', 'banner created successfully.');
    }

    public function contentStore(Request $request)
    {
        $request->validate([
            'content_btn_text' => 'required|string|max:255',
            'content_heading' => 'required|string|max:255',
            'content_sub_heading' => 'required|string|max:255',

            'content_title' => 'nullable|array',
            'content_title.*' => 'required|string|max:255',
            'content_description' => 'nullable|array',
            'content_description.*' => 'required|string',

            'content_image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // ✅ STORE OR UPDATE CONTENT
        if ($request->content_id) {
            $content = Content::findOrFail($request->content_id);

            $content->update([
                'button_text' => $request->content_btn_text,
                'heading' => $request->content_heading,
                'sub_heading' => $request->content_sub_heading,
            ]);
        } else {
            $content = Content::create([
                'pages_id' => $request->pages_id,
                'button_text' => $request->content_btn_text,
                'heading' => $request->content_heading,
                'sub_heading' => $request->content_sub_heading,
            ]);
        }

        $savedIds = [];

        // ✅ MULTIPLE SUB CONTENT
        foreach ($request->input('content_title', []) as $key => $title) {

            $subId = $request->sub_content_id[$key] ?? null;

            if ($subId) {
                $subContent = SubContent::find($subId);
            } else {
                $subContent = new SubContent();
            }

            if (!$subContent) {
                $subContent = new SubContent();
            }

            $imagePath = $subContent->image ?? null;

            // ✅ IMAGE UPLOAD
            if ($request->hasFile('content_image') && isset($request->file('content_image')[$key])) {

                // delete old image
                if ($subContent->image && file_exists(public_path($subContent->image))) {
                    unlink(public_path($subContent->image));
                }

                $image = $request->file('content_image')[$key];
                $imageName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('images/content/subcontent');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);
                $imagePath = 'images/content/subcontent/' . $imageName;
            }

            // ✅ SAVE DATA
            $subContent->contents_id = $content->id;
            $subContent->title = $title;
            $subContent->description = $request->content_description[$key] ?? null;
            $subContent->image = $imagePath;
            $subContent->save();

            $savedIds[] = $subContent->id;
        }

        // ✅ DELETE REMOVED ROWS (IMPORTANT)
        $removedSubContents = SubContent::where('contents_id', $content->id)
            ->when(!empty($savedIds), function ($query) use ($savedIds) {
                $query->whereNotIn('id', $savedIds);
            })
            ->get();

        foreach ($removedSubContents as $removedSubContent) {
            if ($removedSubContent->image && file_exists(public_path($removedSubContent->image))) {
                unlink(public_path($removedSubContent->image));
            }

            $removedSubContent->delete();
        }

        return redirect()->route('admin.pages.index')->with('success', 'Content created successfully.');
    }

    public function sectionStore(Request $request)
    {
        $request->validate([
            'section_heading' => 'required|string|max:255',
            'section_sub_heading' => 'required|string|max:255',
            'section_title' => 'required|string|max:255',
            'section_sub_title' => 'required|string|max:255',

            'name' => 'nullable|array',
            'name.*' => 'required|string|max:255',
            'section_description' => 'nullable|array',
            'section_description.*' => 'required|string',

            'imagess' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sub_section_image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // ✅ STORE OR UPDATE SECTION
        if ($request->section_id) {
            $section = Section::findOrFail($request->section_id);

            $section->update([
                'heading' => $request->section_heading,
                'sub_heading' => $request->section_sub_heading,
                'title' => $request->section_title,
                'sub_title' => $request->section_sub_title,
            ]);
        } else {
            $section = Section::create([
                'pages_id' => $request->pages_id,
                'heading' => $request->section_heading,
                'sub_heading' => $request->section_sub_heading,
                'title' => $request->section_title,
                'sub_title' => $request->section_sub_title,
            ]);
        }

        // ✅ IMAGE UPLOAD (Single)
        if ($request->hasFile('imagess')) {

            if ($section->image && file_exists(public_path($section->image))) {
                unlink(public_path($section->image));
            }

            $image = $request->file('imagess');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/section');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $section->image = 'images/section/' . $imageName;
            $section->save();
        }

        $savedIds = [];

        // ✅ MULTIPLE SUB SECTION
        foreach ($request->input('name', []) as $key => $value) {

            $subId = $request->sub_section_id[$key] ?? null;

            if ($subId) {
                $subSection = SubSection::find($subId);
            } else {
                $subSection = new SubSection();
            }

            if (!$subSection) {
                $subSection = new SubSection();
            }

            $imagePath = $subSection->image ?? null;

            if ($request->hasFile('sub_section_image') && isset($request->file('sub_section_image')[$key])) {

                if ($subSection->image && file_exists(public_path($subSection->image))) {
                    unlink(public_path($subSection->image));
                }

                $image = $request->file('sub_section_image')[$key];
                $imageName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('images/section/subsection');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);
                $imagePath = 'images/section/subsection/' . $imageName;
            }

            $subSection->sections_id = $section->id;
            $subSection->name = $request->name[$key];
            $subSection->description = $request->section_description[$key];
            $subSection->image = $imagePath;
            $subSection->save();

            $savedIds[] = $subSection->id;
        }

        // ✅ DELETE REMOVED ROWS
        $removedSubSections = SubSection::where('sections_id', $section->id)
            ->when(!empty($savedIds), function ($query) use ($savedIds) {
                $query->whereNotIn('id', $savedIds);
            })
            ->get();

        foreach ($removedSubSections as $removedSubSection) {
            if ($removedSubSection->image && file_exists(public_path($removedSubSection->image))) {
                unlink(public_path($removedSubSection->image));
            }

            $removedSubSection->delete();
        }

        return redirect()->route('admin.pages.index')->with('success', 'Section created successfully.');
    }
}
