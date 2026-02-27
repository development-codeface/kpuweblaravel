<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TurismBanner;
use App\Models\TurismContent;
use App\Models\TurismSubContent;
use App\Models\MedicalTrip;
use App\Models\MedicalTripContent;
use App\Models\MedicalTripSubContent;

class MedicalTurism extends Controller
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
        $data['banner'] = TurismBanner::where('pages_id', $id)->first();
        $data['content'] = TurismContent::where('pages_id', $id)->with('subContents')->first();
        return view('admin.medical-turism.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'              => 'required|string|max:255',
            'button_text'        => 'required|string|max:255',
            'banner_description' => 'required|string',
            'image'              => $request->banner_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Check if updating
        if ($request->banner_id) {
            $banner = TurismBanner::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new TurismBanner();
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/turism/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/turism/banner/' . $imageName;
        }

        // Common Fields
        $banner->pages_id    = $request->pages_id;
        $banner->title       = $request->title;
        $banner->button_text = $request->button_text;
        $banner->description = $request->banner_description;
        $banner->save();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Hospital turism saved successfully.');
    }

    public function contentStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'icon.*' => 'required|string|max:255',
            'heading.*' => 'required|string|max:255',
            'description.*' => 'required|string',
        ]);

        $content = TurismContent::updateOrCreate(
            ['id' => $request->content_id], // if exists → update
            [
                'pages_id' => $request->pages_id,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
            ]
        );

        foreach ($request->heading as $index => $heading) {

            $subId = $request->sub_content_id[$index] ?? null;

            $sub = TurismSubContent::updateOrCreate(
                ['id' => $subId], // if id exists → update
                [
                    'turism_contents_id' => $content->id,
                    'icon' => $request->icon[$index],
                    'heading' => $heading,
                    'description' => $request->description[$index],
                ]
            );

            $submittedIds[] = $sub->id;
        }

        return redirect()->route('admin.pages.index')
            ->with('success', 'Hospital turism saved successfully.');
    }

    public function Medicalstore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'medical.*.heading' => 'required',
            'medical.*.description' => 'required',
            'medical.*.texts.*.text' => 'required',
        ]);

        // Save main page content
        $main = MedicalTrip::updateOrCreate(
            ['id' => $request->medical_id],
            [
                'pages_id' => $request->pages_id,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
            ]
        );

        $existingMedicalIds = [];

        foreach ($request->medical as $medicalItem) {

            // Insert or Update Medical Row
            $medical = MedicalTripContent::updateOrCreate(
                ['id' => $medicalItem['content_id'] ?? null],
                [
                    'medical_trips_id' => $main->id,
                    'heading' => $medicalItem['heading'],
                    'description' => $medicalItem['description'],
                ]
            );

            $existingMedicalIds[] = $medical->id;

            $existingTextIds = [];

            if (isset($medicalItem['texts'])) {

                foreach ($medicalItem['texts'] as $textItem) {

                    $text = MedicalTripSubContent::updateOrCreate(
                        ['id' => $textItem['sub_content_id'] ?? null],
                        [
                            'medical_trip_contents_id' => $medical->id,
                            'text' => $textItem['text'],
                        ]
                    );

                    $existingTextIds[] = $text->id;
                }

                // Delete removed texts
                // MedicalText::where('medical_id', $medical->id)
                //     ->whereNotIn('id', $existingTextIds)
                //     ->delete();
            }
        }

        // Delete removed medical rows
        // Medical::where('medical_main_id', $main->id)
        //     ->whereNotIn('id', $existingMedicalIds)
        //     ->delete();

          return redirect()->route('admin.pages.index')
            ->with('success', 'Hospital Medical  saved successfully.');
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
