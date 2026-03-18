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
        $edit_bannner = BloodBank::where('pages_id', $id)->first();
        $edit_content = BloodBankContent::with('sub_content')->where('pages_id', $id)->first();
        $blood_groups = BloodGroup::where('pages_id', $id)->get();
        return view('admin.blood_bank.create', compact('id', 'edit_bannner', 'edit_content', 'blood_groups'));
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
            $banner = BloodBank::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new BloodBank();
        }

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/blood/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/blood/banner/' . $imageName;
        }

        $banner->pages_id    = $request->pages_id;
        $banner->title       = $request->title;
        $banner->button_text = $request->button_text;
        $banner->description = $request->description;
        $banner->save();

        return redirect()->route('admin.pages.index')->with('success', 'Blood Bank created successfully.');
    }


    public function contentStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'heading.*'   => 'required|string|max:255',
            'text.*'      => 'required|string',
        ]);

        $content = BloodBankContent::find($request->content_id);

        if ($content) {

            // UPDATE
            $content->update([
                'title'       => $request->title,
                'description' => $request->description,
            ]);
        } else {

            // CREATE
            $content = BloodBankContent::create([
                'pages_id'    => $request->pages_id,
                'title'       => $request->title,
                'description' => $request->description,
            ]);
        }


        $keepIds = [];

        foreach ($request->heading as $index => $heading) {

            $subId = $request->sub_content_id[$index] ?? null;

            $data = [
                'blood_bank_contents_id' => $content->id,
                'heading'                => $heading,
                'text'                   => $request->text[$index] ?? null,
            ];

            if ($subId) {

                BloodBankSubContent::where('id', $subId)->update($data);
                // $keepIds[] = $subId;
            } else {
                $new = BloodBankSubContent::create($data);
                // $keepIds[] = $new->id;
            }
        }

        // DELETE REMOVED ROWS
        // BloodBankSubContent::where('blood_bank_contents_id', $content->id)
        //     ->whereNotIn('id', $keepIds)
        //     ->delete();


        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Blood Bank content created successfully.');
    }

    public function bloodGroupStore(Request $request)
    {

        $request->validate([
            'blood_group.*' => 'required|string|max:10',
            'status.*'      => 'required|in:0,1',
        ]);

        $savedIds = [];
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
                    $savedIds[] = $blood->id;
                }
            } else {
                // CREATE
                $new = BloodGroup::create([
                    'pages_id'    => $request->pages_id,
                    'blood_group' => $group,
                    'status'      => $request->status[$index],
                ]);
                $savedIds[] = $new->id;
            }
        }

        // OPTIONAL DELETE REMOVED ROWS
        // BloodGroup::where('pages_id', $request->pages_id)
        //     ->whereNotIn('id', $savedIds)
        //     ->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Blood Group  created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
