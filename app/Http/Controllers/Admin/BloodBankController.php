<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodBank;
use App\Models\BloodBankContent;
use App\Models\BloodBankSubContent;
use App\Models\BloodGroup;

class BloodBankController extends Controller
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
        return view('admin.blood_bank.create', compact('id'));
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

            $destinationPath = public_path('images/blood/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/blood/banner/' . $imageName;
        }

        BloodBank::create([
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
            'title'        => 'required|string|max:255',
            'button_text'  => 'required|string|max:255',
            'description'  => 'required',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $bloodBank = BloodBank::findOrFail($request->banner_id);

        $imagePath = $bloodBank->image;

        if ($request->hasFile('image')) {

            // delete old image
            if ($bloodBank->image && file_exists(public_path($bloodBank->image))) {
                unlink(public_path($bloodBank->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/blood/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $imagePath = 'images/blood/banner/' . $imageName;
        }

        $bloodBank->update([
            'pages_id'    => $request->pages_id,
            'title'       => $request->title,
            'button_text' => $request->button_text,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Blood bank banner updated successfully.');
    }


    public function contentStore(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',

            'heading.*'   => 'required|string|max:255',
            'text.*'      => 'required|string',
        ]);

        // ✅ Insert Main Content
        $content = BloodBankContent::create([
            'pages_id'    => $request->pages_id,
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        // ✅ Insert Multiple Sub Rows
        foreach ($request->heading as $index => $heading) {

            BloodBankSubContent::create([
                'blood_bank_contents_id' => $content->id,
                'heading'                => $heading,
                'text'                   => $request->text[$index] ?? null,
            ]);
        }

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Blood Bank content created successfully.');
    }

    public function contentUpdate(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'heading.*'   => 'required|string|max:255',
            'text.*'      => 'required|string',
        ]);

        // =====================
        // UPDATE MAIN CONTENT
        // =====================

        $content = BloodBankContent::findOrFail($request->blood_content_id);

        $content->update([
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        // =====================
        // UPDATE MULTIPLE SUB CONTENT
        // =====================

        $existingIds = [];

        foreach ($request->heading as $index => $heading) {

            $subId = $request->sub_content_id[$index] ?? null;

            if ($subId) {
                // UPDATE EXISTING
                $sub = BloodBankSubContent::find($subId);
                if ($sub) {
                    $sub->update([
                        'heading' => $heading,
                        'text'    => $request->text[$index],
                    ]);
                    $existingIds[] = $sub->id;
                }
            } else {
                // CREATE NEW
                $newSub = BloodBankSubContent::create([
                    'blood_bank_contents_id' => $content->id,
                    'heading'                => $heading,
                    'text'                   => $request->text[$index],
                ]);
                $existingIds[] = $newSub->id;
            }
        }

        // DELETE REMOVED ROWS
        // BloodBankSubContent::where('blood_bank_contents_id', $content->id)
        //     ->whereNotIn('id', $existingIds)
        //     ->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Content updated successfully.');
    }


    public function bloodGroupStore(Request $request)
    {
        $request->validate([
            'blood_group.*'    => 'required|string|max:10',
            'status.*'      => 'required|in:1,0',
        ]);

        foreach ($request->blood_group as $index => $group) {

            BloodGroup::create([
                'pages_id'    => $request->pages_id,
                'blood_group' => $group,
                'status'      => $request->status[$index] ?? null,
            ]);
        }

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Blood Group  created successfully.');
    }

    public function bloodGroupUpdate(Request $request)
    {
        $request->validate([
            'blood_group.*' => 'required|string|max:255',
            'status.*'      => 'required|in:0,1',
        ]);

        $existingIds = [];

        foreach ($request->blood_group as $index => $group) {

            $id = $request->blood_group_id[$index] ?? null;

            if ($id) {
                // UPDATE
                $blood = BloodGroup::find($id);
                if ($blood) {
                    $blood->update([
                        'blood_group' => $group,
                        'status'      => $request->status[$index],
                    ]);
                    $existingIds[] = $blood->id;
                }
            } else {
                // CREATE NEW
                $new = BloodGroup::create([
                    'pages_id'    => $request->pages_id,
                    'blood_group' => $group,
                    'status'      => $request->status[$index],
                ]);
                $existingIds[] = $new->id;
            }
        }

        // DELETE REMOVED
        // BloodGroup::where('pages_id', $pageId)
        //     ->whereNotIn('id', $existingIds)
        //     ->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Blood groups updated successfully.');
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
        $data['edit_bannner'] = BloodBank::where('pages_id', $id)->first();
        $data['edit_content'] = BloodBankContent::with('sub_content')->where('pages_id', $id)->first();
        $data['blood_groups'] = BloodGroup::where('pages_id', $id)->get();
        return view('admin.blood_bank.edit', $data);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
