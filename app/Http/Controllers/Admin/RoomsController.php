<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomBanner;
use App\Models\RoomsType;
use App\Models\SpecRooms;

class RoomsController extends Controller
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
        $edit_rooms = RoomsType::where('pages_id', $id)->with('specRooms')->get();
        $edit_banner = RoomBanner::where('pages_id', $id)->first();
        return view('admin.rooms.create', compact('id', 'edit_banner','edit_rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        // ✅ Check insert or update
        if ($request->banner_id) {
            $banner = RoomBanner::findOrFail($request->banner_id);
        } else {
            $banner = new RoomBanner();
        }

        // ✅ Assign values
        $banner->pages_id = $request->pages_id;
        $banner->title = $request->title;
        $banner->button_text = $request->button_text;
        $banner->description = $request->description;

        // ✅ Image Upload
        if ($request->hasFile('image')) {

            // 🔥 Delete old image (important)
            if (!empty($banner->image) && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/rooms/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/rooms/banner/' . $imageName;
        }

        $banner->save();

        return redirect()->route('admin.pages.index')->with('success', 'Rooms banner created successfully.');
    }

    public function roomStore(Request $request)
    {
        $request->validate([
            'rooms.*.type' => 'required|string|max:255',
            'rooms.*.heading' => 'required|string|max:255',
            'rooms.*.bed_count' => 'required|integer|min:1',
            'rooms.*.image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'rooms.*.features' => 'required|array|min:1',
            'rooms.*.features.*' => 'required|string|max:255',
        ]);

        $roomIds = []; // track for delete

        foreach ($request->rooms as $index => $roomData) {

            $room = null;

            // =========================
            // FIND EXISTING ROOM
            // =========================
            if (!empty($roomData['id'])) {
                $room = RoomsType::find($roomData['id']);
            }

            // =========================
            // IMAGE HANDLE
            // =========================
            $imagePath = $room->image ?? null;

            if (isset($roomData['image']) && $roomData['image'] instanceof \Illuminate\Http\UploadedFile) {

                $image = $roomData['image'];
                $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('rooms');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);

                // delete old image
                if ($room && $room->image && file_exists(public_path($room->image))) {
                    unlink(public_path($room->image));
                }

                $imagePath = 'rooms/' . $imageName;
            }

            // =========================
            // CREATE OR UPDATE ROOM (FIXED)
            // =========================
            if ($room) {

                $room->update([
                    'pages_id'  => $request->pages_id,
                    'type'      => $roomData['type'],
                    'heading'   => $roomData['heading'],
                    'bed_count' => $roomData['bed_count'],
                    'image'     => $imagePath,
                ]);
            } else {

                $room = RoomsType::create([
                    'pages_id'  => $request->pages_id,
                    'type'      => $roomData['type'],
                    'heading'   => $roomData['heading'],
                    'bed_count' => $roomData['bed_count'],
                    'image'     => $imagePath,
                ]);
            }

            $roomIds[] = $room->id;

            // =========================
            // FEATURES (SpecRooms)
            // =========================
            $featureIds = [];

            if (!empty($roomData['features'])) {

                foreach ($roomData['features'] as $key => $featureValue) {

                    $featureId = $roomData['feature_ids'][$key] ?? null;

                    if (!empty($featureId)) {

                        $feature = SpecRooms::find($featureId);

                        if ($feature) {
                            $feature->update([
                                'features' => $featureValue
                            ]);
                        }
                    } else {

                        $feature = SpecRooms::create([
                            'rooms_types_id' => $room->id,
                            'features'       => $featureValue,
                        ]);
                    }

                    if (isset($feature)) {
                        $featureIds[] = $feature->id;
                    }
                }
            }

            // =========================
            // DELETE REMOVED FEATURES
            // =========================
            // $room->specRooms()
            //     ->whereNotIn('id', $featureIds)
            //     ->delete();
        }

        // =========================
        // DELETE REMOVED ROOMS (OPTIONAL)
        // =========================
        // RoomsType::where('pages_id', $request->pages_id)
        //     ->whereNotIn('id', $roomIds)
        //     ->delete();

        // =========================
        // REDIRECT (IMPORTANT: OUTSIDE LOOP)
        // =========================
        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Rooms saved successfully.');
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
