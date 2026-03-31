<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Icu;
use App\Models\IcuFeature;
use App\Models\IcuFeatureContent;
use App\Models\Menu;
use Illuminate\Http\Request;

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
        $banner = Icu::where('pages_id', $id)->first();
        $feature = IcuFeature::with('featureContents')->where('pages_id', $id)->first();
        $menu = Menu::where('pages_id', $id)->get();

        return view('admin.icu.create', compact('id', 'menu', 'banner', 'feature'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->input('active_tab') === 'featureSection') {
            return $this->storeFeatureSection($request);
        }

        return $this->storeBannerSection($request);
    }

    private function storeBannerSection(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'description' => 'required',
            'image' => $request->banner_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->banner_id) {
            $banner = Icu::findOrFail($request->banner_id);
        } else {
            $banner = new Icu();
        }

        if ($request->hasFile('image')) {
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/icu/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $banner->image = 'images/icu/banner/' . $imageName;
        }

        $banner->pages_id = $request->pages_id;
        $banner->title = $request->title;
        $banner->button_text = $request->button_text;
        $banner->description = $request->description;
        $banner->save();

        return redirect()->route('admin.pages.index')->with('success', 'ICU banner saved successfully.');
    }

    private function storeFeatureSection(Request $request)
    {
        $request->validate([
            'feature_title' => 'required|string|max:255',
            'feature_sub_title' => 'required|string|max:255',
            'feature_icon' => 'required|array|min:1',
            'feature_icon.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'existing_feature_icon' => 'nullable|array',
            'name' => 'required|array|min:1',
            'name.*' => 'required|string|max:255',
            'feature_description' => 'required|array|min:1',
            'feature_description.*' => 'required|string',
        ]);

        $feature = IcuFeature::updateOrCreate(
            ['id' => $request->feature_id],
            [
                'pages_id' => $request->pages_id,
                'title' => $request->feature_title,
                'sub_title' => $request->feature_sub_title,
            ]
        );

        $savedContentIds = [];
        $existingIcons = $request->input('existing_feature_icon', []);

        foreach ($request->input('name', []) as $key => $name) {
            $contentId = $request->content_id[$key] ?? null;
            $featureContent = $contentId ? IcuFeatureContent::find($contentId) : new IcuFeatureContent();

            if (!$featureContent) {
                $featureContent = new IcuFeatureContent();
            }

            $iconPath = $existingIcons[$key] ?? $featureContent->icon ?? null;

            if ($request->hasFile('feature_icon') && isset($request->file('feature_icon')[$key])) {
                $this->deleteImageIfExists($featureContent->icon ?? null);
                $iconPath = $this->uploadFeatureIcon($request->file('feature_icon')[$key], $key);
            }

            if (!$iconPath) {
                return back()
                    ->withErrors(['feature_icon.' . $key => 'The icon image field is required.'])
                    ->withInput();
            }

            $featureContent->icu_feature_id = $feature->id;
            $featureContent->icon = $iconPath;
            $featureContent->name = $name;
            $featureContent->description = $request->feature_description[$key];
            $featureContent->save();

            $savedContentIds[] = $featureContent->id;
        }

        $removedContents = IcuFeatureContent::where('icu_feature_id', $feature->id)
            ->when(!empty($savedContentIds), function ($query) use ($savedContentIds) {
                $query->whereNotIn('id', $savedContentIds);
            })
            ->get();

        foreach ($removedContents as $removedContent) {
            $this->deleteImageIfExists($removedContent->icon);
            $removedContent->delete();
        }

        return redirect()->route('admin.pages.index')->with('success', 'ICU core values saved successfully.');
    }

    private function uploadFeatureIcon($icon, int $key): string
    {
        $imageName = time() . '_' . $key . '.' . $icon->getClientOriginalExtension();
        $destinationPath = public_path('images/icu/feature-icons');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $icon->move($destinationPath, $imageName);

        return 'images/icu/feature-icons/' . $imageName;
    }

    private function deleteImageIfExists(?string $imagePath): void
    {
        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
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
