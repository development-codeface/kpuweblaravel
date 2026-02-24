<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Icu;
use App\Models\Menu;
use App\Models\IcuContent;
use App\Models\IcuSubContent;
use App\Models\IcuFeature;
use Illuminate\Support\Facades\DB;

class IcuController extends Controller
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
        $menu = Menu::where('pages_id', $id)->get();
        return view('admin.icu.create', compact('id', 'menu'));
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

            $destinationPath = public_path('images/icu/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/icu/banner/' . $imageName;
        }

        Icu::create([
            'pages_id'   => $request->pages_id,
            'title'      => $request->title,
            'button_text' => $request->button_text,
            'description' => $request->description,
            'image'      => $imagePath,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Career banner created successfully.');
    }

    public function MenuStore(Request $request)
    {
        $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
        ]);
        foreach ($request->name as $name) {
            if (!empty($name)) {
                Menu::create([
                    'pages_id' => $request->pages_id,
                    'name' => $name,
                ]);
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'ICU menu created successfully.');
    }

    public function contentStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'menu' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sub_title' => 'required|string|max:255',
            'sub_description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'text.*' => 'nullable|string',
            'feature_title.*' => 'nullable|string',
            'feature_description.*' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            // =========================
            // IMAGE UPLOAD (Same Logic)
            // =========================
            $imagePath = null;

            if ($request->hasFile('images')) {

                $image = $request->file('images');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('images/icu/content');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);

                $imagePath = 'images/icu/content/' . $imageName;
            }

            // =========================
            // 1️⃣ Insert Main Content
            // =========================
            $icuContent = IcuContent::create([
                'menus_id'        => $request->menu,
                'title'           => $request->title,
                'description'     => $request->description,
                'image'           => $imagePath,
                'sub_title'       => $request->sub_title,
                'sub_description' => $request->sub_description,
            ]);

            // =========================
            // 2️⃣ Insert Sub Texts
            // =========================
            if ($request->has('text')) {
                foreach ($request->text as $txt) {
                    if (!empty($txt)) {
                        IcuSubContent::create([
                            'icu_contents_id' => $icuContent->id,
                            'text'            => $txt,
                        ]);
                    }
                }
            }

            // =========================
            // 3️⃣ Insert Features
            // =========================
            if ($request->has('feature_title') && $request->has('feature_description')) {

                foreach ($request->feature_title as $index => $featureTitle) {

                    if (!empty($featureTitle)) {

                        IcuFeature::create([
                            'icu_contents_id' => $icuContent->id,
                            'title'           => $featureTitle,
                            'description'     => $request->feature_description[$index] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.pages.index')->with('success', 'ICU content created successfully.');
            } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
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
