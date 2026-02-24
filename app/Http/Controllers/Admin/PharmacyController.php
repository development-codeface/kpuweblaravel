<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PharmacyBanner;
use App\Models\PharmacyContent;
use App\Models\PharmacySubContent;
use App\Models\PharmacyPlans;
use App\Models\PharmacyPlansContent;
use Illuminate\Support\Facades\DB;

class PharmacyController extends Controller
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
        return view('admin.pharmacy.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'pages_id'    => 'required',
            'title'       => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Your Custom Folder
            $destinationPath = public_path('images/pharmacy/banner');

            // Create Folder If Not Exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move Image
            $image->move($destinationPath, $imageName);

            $imagePath = 'images/pharmacy/banner/' . $imageName;
        }

        PharmacyBanner::create([
            'pages_id'    => $request->pages_id,
            'title'       => $request->title,
            'button_text' => $request->button_text,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Pharmacy banner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function pharmacyStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title'             => 'required|string|max:255',
            'sub_title'         => 'required|string|max:255',
            // 'button_text'       => 'required|string|max:255',
            'description'       => 'required',
            'icon.*'            => 'required|string|max:255',
            'heading.*'         => 'required|string|max:255',
            'sub_description.*' => 'nullable|string',
        ]);

        // 🔹 1️⃣ Insert Main Content
        $content = PharmacyContent::create([
            'pages_id'    => $request->pages_id,
            'title'       => $request->title,
            'sub_title'   => $request->sub_title,
            'button_text' => $request->button_text ?? null,
            'description' => $request->description,
        ]);

        // 🔹 2️⃣ Insert Multiple Sub Rows
        if ($request->icon) {

            foreach ($request->icon as $index => $icon) {

                PharmacySubContent::create([
                    'pharmacy_contents_id' => $content->id,
                    'icon'                => $icon,
                    'heading'             => $request->heading[$index] ?? null,
                    'description'     => $request->sub_description[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'Pharmacy banner created successfully.');
    }

    public function pharmacyPlanStore(Request $request)
    {
        $request->validate([

            // text section
            'basic_plan.*'         => 'nullable|string|max:255',
            'standard_plan.*'         => 'nullable|string|max:255',

            // plans section
            'title.*'        => 'required|string|max:255',
            'sub_title.*'    => 'nullable|string|max:255',
            'from_time.*'    => 'nullable|string|max:255',
            'to_time.*'      => 'nullable|string|max:255',
        ]);



        // ✅ 1️⃣ Insert Multiple Text Rows
        if ($request->basic_plan) {
            foreach ($request->basic_plan as $index => $plan) {

                if (!empty($plan)) {
                    PharmacyPlansContent::create([
                        'pages_id' => $request->pages_id,
                        'basic_plan'     => $request->basic_plan[$index] ?? null,
                        'standard_plan'  => $request->standard_plan[$index] ?? null,
                    ]);
                }
            }
        }

        // ✅ 2️⃣ Insert Multiple Plans Rows
        if ($request->title) {

            foreach ($request->title as $index => $title) {

                if (!empty($title)) {

                    PharmacyPlans::create([
                        'pages_id'  => $request->pages_id,
                        'title'     => $title,
                        'sub_title' => $request->sub_title[$index] ?? null,
                        'from_time' => $request->from_time[$index] ?? null,
                        'to_time'   => $request->to_time[$index] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'Pharmacy plan created successfully.');
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
        $edit_banner = PharmacyBanner::where('pages_id', $id)->first();
        $edit_content = PharmacyContent::where('pages_id', $id)->first();
        $edit_sub_content = PharmacySubContent::where('pharmacy_contents_id', $edit_content->id)->get();
        $edit_plans_content = PharmacyPlansContent::where('pages_id', $id)->get();
        $edit_plans = PharmacyPlans::where('pages_id', $id)->get();
        return view('admin.pharmacy.edit', compact('id', 'edit_banner', 'edit_content', 'edit_sub_content', 'edit_plans_content', 'edit_plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'title'       => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $banner = PharmacyBanner::findOrFail($id);

        $imagePath = $banner->image;

        if ($request->hasFile('image')) {

            // Delete old image
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/pharmacy/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/pharmacy/banner/' . $imageName;
        }

        $banner->update([
            'title'       => $request->title,
            'button_text' => $request->button_text,
            'image'       => $imagePath,
        ]);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Pharmacy banner updated successfully.');
    }

    public function contentUpdate(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'title'             => 'required|string|max:255',
            'sub_title'         => 'required|string|max:255',
            // 'button_text'       => 'required|string|max:255',
            'description'       => 'required',
            'icon.*'            => 'required|string|max:255',
            'heading.*'         => 'required|string',
            'sub_description.*' => 'nullable|string',
        ]);

        // 🔹 1️⃣ Update Main Content
        $content = PharmacyContent::findOrFail($request->id);
        $content->update([
            'pages_id'    => $request->pages_id,
            'title'       => $request->title,
            'sub_title'   => $request->sub_title,
            'button_text' => $request->button_text ?? null,
            'description' => $request->description,
        ]);

        // 🔹 2️⃣ Update or Insert Sub Rows
        if ($request->icon) {

            foreach ($request->icon as $index => $icon) {

                if (isset($request->content_id[$index])) {
                    // Update existing sub content
                    $subContent = PharmacySubContent::findOrFail($request->content_id[$index]);
                    $subContent->update([
                        'icon'        => $icon,
                        'heading'     => $request->heading[$index] ?? null,
                        'description' => $request->sub_description[$index] ?? null,
                    ]);
                } else {
                    // Insert new sub content
                    PharmacySubContent::create([
                        'pharmacy_contents_id' => $content->id,
                        'icon'                => $icon,
                        'heading'             => $request->heading[$index] ?? null,
                        'description'         => $request->sub_description[$index] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'Pharmacy content updated successfully.');
    }

    public function pharmacyPlanUpdate(Request $request)
    {
        $request->validate([

            // text section
            'basic_plan.*'         => 'nullable|string|max:255',
            'standard_plan.*'         => 'nullable|string|max:255',

            // plans section
            'title.*'        => 'required|string|max:255',
            'sub_title.*'    => 'nullable|string|max:255',
            'from_time.*'    => 'nullable|string|max:255',
            'to_time.*'      => 'nullable|string|max:255',
        ]);

        $pagesId = $request->pages_id;

        /*
    |--------------------------------------------------------------------------
    | 1️⃣ UPDATE TEXT SECTION
    |--------------------------------------------------------------------------
    */

        // $existingTextIds = PharmacyPlansContent::where('pages_id', $pagesId)
        //     ->pluck('id')
        //     ->toArray();

        $submittedTextIds = [];

        if ($request->basic_plan) {

            foreach ($request->basic_plan as $index => $text) {

                $contentId = $request->plan_content_id[$index] ?? null;

                if ($contentId) {

                    // UPDATE
                    PharmacyPlansContent::where('id', $contentId)
                        ->update([
                            'basic_plan'     => $request->basic_plan[$index] ?? null,
                            'standard_plan'  => $request->standard_plan[$index] ?? null,
                        ]);

                    $submittedTextIds[] = $contentId;
                } elseif (!empty($text)) {

                    // CREATE NEW
                    $new = PharmacyPlansContent::create([
                        'pages_id' => $pagesId,
                        'basic_plan'     => $request->basic_plan[$index] ?? null,
                        'standard_plan'  => $request->standard_plan[$index] ?? null,
                    ]);

                    $submittedTextIds[] = $new->id;
                }
            }
        }

        // DELETE removed rows
        // $deleteTextIds = array_diff($existingTextIds, $submittedTextIds);
        // PharmacyPlansContent::whereIn('id', $deleteTextIds)->delete();


        // $existingPlanIds = PharmacyPlans::where('pages_id', $pagesId)
        //     ->pluck('id')
        //     ->toArray();

        $submittedPlanIds = [];

        if ($request->title) {

            foreach ($request->title as $index => $title) {

                $planId = $request->plan_id[$index] ?? null;

                if ($planId) {

                    // UPDATE
                    PharmacyPlans::where('id', $planId)
                        ->update([
                            'title'     => $title,
                            'sub_title' => $request->sub_title[$index] ?? null,
                            'from_time' => $request->from_time[$index] ?? null,
                            'to_time'   => $request->to_time[$index] ?? null,
                        ]);

                    $submittedPlanIds[] = $planId;
                } elseif (!empty($title)) {

                    // CREATE NEW
                    $new = PharmacyPlans::create([
                        'pages_id'  => $pagesId,
                        'title'     => $title,
                        'sub_title' => $request->sub_title[$index] ?? null,
                        'from_time' => $request->from_time[$index] ?? null,
                        'to_time'   => $request->to_time[$index] ?? null,
                    ]);

                    $submittedPlanIds[] = $new->id;
                }
            }
        }

        // DELETE removed rows
        // $deletePlanIds = array_diff($existingPlanIds, $submittedPlanIds);
        // PharmacyPlans::whereIn('id', $deletePlanIds)->delete();



        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Pharmacy plan updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
