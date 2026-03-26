<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InsuranceBanner;
use App\Models\InsuranceContent;
use App\Models\InsuranceSubContent;

class InsuranceController extends Controller
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
        $edit_banner = InsuranceBanner::where('pages_id', $id)->first();
        $edit_content = InsuranceContent::where('pages_id', $id)->with('subContents')->first();
        return view('admin.insurance.create', compact('id', 'edit_banner', 'edit_content'));
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
            $banner = InsuranceBanner::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new InsuranceBanner();
        }

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/insurance/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/insurance/banner/' . $imageName;
        }

        $banner->pages_id    = $request->pages_id;
        $banner->title       = $request->title;
        $banner->description       = $request->description;
        $banner->button_text = $request->button_text;
        $banner->save();

        return redirect()->route('admin.pages.index')->with('success', 'Insurance Banner created successfully.');
    }

    public function ContentStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'icon.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content_descriptions.*' => 'required|string',
        ]);

        if ($request->content_id) {

            $content = InsuranceContent::findOrFail($request->content_id);

            $content->update([
                'title'     => $request->title,
                'sub_title' => $request->sub_title,
            ]);
        } else {
            $content = InsuranceContent::create([
                'pages_id'  => $request->pages_id,
                'title'     => $request->title,
                'sub_title' => $request->sub_title,
            ]);
        }

        $savedIds = [];

        foreach ($request->content_descriptions as $index => $desc) {

            $subId = $request->sub_content_id[$index] ?? null;

            if ($subId) {
                $sub = InsuranceSubContent::find($subId);
            } else {
                $sub = new InsuranceSubContent();
                $sub->insurance_contents_id = $content->id;
            }
            
            if ($request->hasFile('images.' . $index)) {

                $file = $request->file('images')[$index];

                $imageName = time() . '_' . $index . '.' . $file->getClientOriginalExtension();

                $destinationPath = public_path('images/insurance/content');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $imageName);

                // delete old image (optional but recommended)
                if ($sub->icon && file_exists(public_path($sub->icon))) {
                    unlink(public_path($sub->icon));
                }

                $sub->icon = 'images/insurance/content/' . $imageName;
            }

            // description
            $sub->description = $desc;
            $sub->save();

            $savedIds[] = $sub->id;
        }

        // ============================
        // 3️⃣ DELETE REMOVED ROWS
        // ============================

        // InsuranceSubContent::where('insurance_contents_id', $content->id)
        //     ->whereNotIn('id', $savedIds)
        //     ->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Insurance content created successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
