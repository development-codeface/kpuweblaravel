<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AmbulanceBanner;
use Illuminate\Http\Request;
use App\Models\AmbulanceContent;
use App\Models\AmbulanceSubContent;

class AmbulanceController extends Controller
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
        $banner = AmbulanceBanner::where('pages_id', $id)->first();
        $contents = AmbulanceContent::with('sub_content')->where('pages_id', $id)->first();
        return view('admin.ambulance.create', compact('id', 'banner', 'contents'));
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
            $banner = AmbulanceBanner::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new AmbulanceBanner();
        }

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/ambulance/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/ambulance/banner/' . $imageName;
        }

        $banner->pages_id    = $request->pages_id;
        $banner->title       = $request->title;
        $banner->button_text = $request->button_text;
        $banner->description = $request->description;
        $banner->save();

        return redirect()->route('admin.pages.index')->with('success', 'Career banner created successfully.');
    }

    public function storeContent(Request $request)
    {
        $request->validate([

            'title'           => 'required|string|max:255',
            'description'     => 'required',
            'sub_title'       => 'required|string|max:255',
            'sub_description' => 'required',
            'number'          => 'required',
            'content_image'   => $request->content_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'heading.*'              => 'required|string|max:255',
            'content_descriptions.*' => 'required'
        ]);

        /*
    |--------------------------------------------------------------------------
    | 1️⃣ CREATE OR UPDATE MAIN RECORD
    |--------------------------------------------------------------------------
    */

        $content = AmbulanceContent::find($request->content_id);

        $imagePath = $content->image ?? null;

        // 🔹 Handle Image
        if ($request->hasFile('content_image')) {

            // delete old
            if ($content && $content->image && file_exists(public_path($content->image))) {
                unlink(public_path($content->image));
            }

            $image = $request->file('content_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/ambulance/content');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $imagePath = 'images/ambulance/content/' . $imageName;
        }

        if ($content) {

            // UPDATE
            $content->update([
                'title'           => $request->title,
                'description'     => $request->description,
                'sub_title'       => $request->sub_title,
                'sub_description' => $request->sub_description,
                'number'          => $request->number,
                'image'           => $imagePath,
            ]);
        } else {

            // CREATE
            $content = AmbulanceContent::create([
                'pages_id'        => $request->pages_id,
                'title'           => $request->title,
                'description'     => $request->description,
                'sub_title'       => $request->sub_title,
                'sub_description' => $request->sub_description,
                'number'          => $request->number,
                'image'           => $imagePath,
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | 2️⃣ HANDLE MULTIPLE SUB ROWS
    |--------------------------------------------------------------------------
    */

        $keepIds = [];

        foreach ($request->heading as $index => $heading) {

            $subId = $request->sub_content_id[$index] ?? null;

            $data = [
                'ambulance_contents_id' => $content->id,
                'title'                 => $heading,
                'description'           => $request->content_descriptions[$index] ?? null,
            ];

            if ($subId) {

                AmbulanceSubContent::where('id', $subId)->update($data);
                $keepIds[] = $subId;
            } else {

                $new = AmbulanceSubContent::create($data);
                $keepIds[] = $new->id;
            }
        }

        // // 🔹 Delete removed rows
        // AmbulanceSubContent::where('ambulance_contents_id', $content->id)
        //     ->whereNotIn('id', $keepIds)
        //     ->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Ambulance content saved successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
