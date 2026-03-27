<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\features;
use App\Models\FeatureContent;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['features'] = features::all();
        return view('admin.feature.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',

            'icon'        => 'required|array|min:1',
            'icon.*'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'name'        => 'required|array',
            'name.*'      => 'required|string|max:255',

            'description'   => 'required|array',
            'description.*' => 'required|string',
        ]);


        $feature = features::create([
            'title'       => $request->title,
            'sub_title'   => $request->sub_title,
        ]);

        foreach ($request->input('name', []) as $key => $name) {
            $iconPath = $this->uploadFeatureIcon($request->file('icon')[$key], $key);

            FeatureContent::create([
                'feature_id'  => $feature->id,
                'icon'        => $iconPath,
                'name'        => $name,
                'description' => $request->input('description')[$key],
            ]);
        }

        return redirect()
            ->route('admin.feature.index')
            ->with('success', 'Feature created successfully');
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
    public function edit($id)
    {
        $feature = features::with('featureContents')->findOrFail($id);
        return view('admin.feature.edit', compact('feature'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',

            'icon' => 'nullable|array',
            'icon.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'existing_icon' => 'nullable|array',

            'name' => 'required|array',
            'name.*' => 'required|string',

            'description' => 'required|array',
            'description.*' => 'required|string',
        ]);
        $feature = features::findOrFail($id);

        $feature->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
        ]);

        $contentIds = $request->input('content_id', []);
        $existingIcons = $request->input('existing_icon', []);
        $savedIds = [];

        foreach ($request->input('name', []) as $key => $name) {
            $contentId = $contentIds[$key] ?? null;
            $featureContent = $contentId ? FeatureContent::find($contentId) : new FeatureContent();

            if (!$featureContent) {
                $featureContent = new FeatureContent();
            }

            $iconPath = $existingIcons[$key] ?? $featureContent->icon ?? null;

            if ($request->hasFile('icon') && isset($request->file('icon')[$key])) {
                $this->deleteImageIfExists($featureContent->icon ?? null);
                $iconPath = $this->uploadFeatureIcon($request->file('icon')[$key], $key);
            }

            if (!$iconPath) {
                return back()
                    ->withErrors(['icon.' . $key => 'The icon field is required.'])
                    ->withInput();
            }

            $featureContent->feature_id = $feature->id;
            $featureContent->icon = $iconPath;
            $featureContent->name = $name;
            $featureContent->description = $request->input('description')[$key];
            $featureContent->save();

            $savedIds[] = $featureContent->id;
        }

        $removedContents = FeatureContent::where('feature_id', $feature->id)
            ->when(!empty($savedIds), function ($query) use ($savedIds) {
                $query->whereNotIn('id', $savedIds);
            })
            ->get();

        foreach ($removedContents as $removedContent) {
            $this->deleteImageIfExists($removedContent->icon);
            $removedContent->delete();
        }

        return redirect()
            ->route('admin.feature.index')
            ->with('success', 'Feature updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $feature = features::findOrFail($id);

        foreach ($feature->featureContents as $content) {
            $this->deleteImageIfExists($content->icon);
            $content->delete();
        }

        $feature->delete();
        return redirect()
            ->route('admin.feature.index')
            ->with('success', 'Feature deleted successfully');
    }

    private function uploadFeatureIcon($icon, int $key): string
    {
        $imageName = time() . '_' . $key . '.' . $icon->getClientOriginalExtension();
        $destinationPath = public_path('images/feature/icons');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $icon->move($destinationPath, $imageName);

        return 'images/feature/icons/' . $imageName;
    }

    private function deleteImageIfExists(?string $imagePath): void
    {
        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }
    }
}
