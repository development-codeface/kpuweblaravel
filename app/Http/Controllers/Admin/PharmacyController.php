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
        $edit_banner = PharmacyBanner::where('pages_id', $id)->first();
        $edit_content = PharmacyContent::where('pages_id', $id)->first();
        $edit_sub_content = PharmacySubContent::where('pharmacy_contents_id', $edit_content->id)->get();
        $edit_plans_content = PharmacyPlansContent::where('pages_id', $id)->get();
        $edit_plans = PharmacyPlans::where('pages_id', $id)->get();
        return view('admin.pharmacy.create', compact('id', 'edit_banner', 'edit_content', 'edit_sub_content', 'edit_plans_content', 'edit_plans'));
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
            'image'              => $request->banner_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->banner_id) {
            $banner = PharmacyBanner::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new PharmacyBanner();
        }

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

            $banner->image = 'images/pharmacy/banner/' . $imageName;
        }
        $banner->pages_id    = $request->pages_id;
        $banner->title       = $request->title;
        $banner->button_text = $request->button_text;
        $banner->save();

        return redirect()->route('admin.pages.index')->with('success', 'Pharmacy banner created successfully.');
    }

    public function pharmacyStore(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'sub_title'         => 'required|string|max:255',
            'description'       => 'required',
            'icon.*'            => 'required|string|max:255',
            'heading.*'         => 'required|string|max:255',
            'sub_description.*' => 'required|string',
        ]);

        /*
    |--------------------------------------------------------------------------
    | 1️⃣ CREATE OR UPDATE MAIN CONTENT
    |--------------------------------------------------------------------------
    */

        $content = PharmacyContent::updateOrCreate(
            ['id' => $request->content_id], // hidden input
            [
                'pages_id'    => $request->pages_id,
                'title'       => $request->title,
                'sub_title'   => $request->sub_title,
                'button_text' => $request->button_text ?? null,
                'description' => $request->description,
            ]
        );

        /*
    |--------------------------------------------------------------------------
    | 2️⃣ HANDLE MULTIPLE SUB CONTENT
    |--------------------------------------------------------------------------
    */

        $submittedIds = [];

        if ($request->icon) {

            foreach ($request->icon as $index => $icon) {

                $subId = $request->sub_id[$index] ?? null;

                $data = [
                    'pharmacy_contents_id' => $content->id,
                    'icon'                 => $icon,
                    'heading'              => $request->heading[$index] ?? null,
                    'description'          => $request->sub_description[$index] ?? null,
                ];

                if ($subId) {
                    // UPDATE
                    PharmacySubContent::where('id', $subId)->update($data);
                    $submittedIds[] = $subId;
                } else {
                    // CREATE
                    $new = PharmacySubContent::create($data);
                    $submittedIds[] = $new->id;
                }
            }
        }

        /*
    |--------------------------------------------------------------------------
    | 3️⃣ DELETE REMOVED SUB ROWS
    |--------------------------------------------------------------------------
    */

        // PharmacySubContent::where('pharmacy_contents_id', $content->id)
        //     ->whereNotIn('id', $submittedIds)
        //     ->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Pharmacy content saved successfully.');
    }

    public function pharmacyPlanStore(Request $request)
    {
        // dd($request->all());
        $request->validate([

            // text section
            'basic_plan.*'    => 'required|string|max:255',
            'standard_plan.*' => 'required|string|max:255',

            // plans section
            'plan_title.*'     => 'required|string|max:255',
            'plan_sub_title.*' => 'required|string|max:255',
            'from_time.*' => 'required|string|max:255',
            'to_time.*'   => 'required|string|max:255',
        ]);

        $pagesId = $request->pages_id;

        /*
    |--------------------------------------------------------------------------
    | 1️⃣ TEXT SECTION (Basic / Standard Plan)
    |--------------------------------------------------------------------------
    */

        $submittedTextIds = [];

        if ($request->basic_plan) {

            foreach ($request->basic_plan as $index => $text) {

                $contentId = $request->plan_content_id[$index] ?? null;

                $data = [
                    'pages_id'      => $pagesId,
                    'basic_plan'    => $request->basic_plan[$index] ?? null,
                    'standard_plan' => $request->standard_plan[$index] ?? null,
                ];

                if ($contentId) {
                    // UPDATE
                    PharmacyPlansContent::where('id', $contentId)->update($data);
                    $submittedTextIds[] = $contentId;
                } elseif (!empty($text)) {
                    // CREATE
                    $new = PharmacyPlansContent::create($data);
                    $submittedTextIds[] = $new->id;
                }
            }
        }

        // DELETE REMOVED TEXT ROWS
        // PharmacyPlansContent::where('pages_id', $pagesId)
        //     ->whereNotIn('id', $submittedTextIds)
        //     ->delete();


        /*
    |--------------------------------------------------------------------------
    | 2️⃣ PLANS SECTION
    |--------------------------------------------------------------------------
    */

        $submittedPlanIds = [];

        if ($request->title) {

            foreach ($request->plan_title as $index => $title) {

                $planId = $request->plan_id[$index] ?? null;

                $data = [
                    'pages_id'  => $pagesId,
                    'title'     => $title,
                    'sub_title' => $request->plan_sub_title[$index] ?? null,
                    'from_time' => $request->from_time[$index] ?? null,
                    'to_time'   => $request->to_time[$index] ?? null,
                ];

                if ($planId) {
                    // UPDATE
                    PharmacyPlans::where('id', $planId)->update($data);
                    $submittedPlanIds[] = $planId;
                } else {
                    // CREATE
                    $new = PharmacyPlans::create($data);
                    $submittedPlanIds[] = $new->id;
                }
            }
        }

        // DELETE REMOVED PLAN ROWS
        // PharmacyPlans::where('pages_id', $pagesId)
        //     ->whereNotIn('id', $submittedPlanIds)
        //     ->delete();


        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Pharmacy plan saved successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
