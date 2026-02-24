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

            'icon'        => 'required|array',
            'icon.*'      => 'required|string|max:255',

            'name'        => 'required|array',
            'name.*'      => 'required|string|max:255',

            'description'   => 'required|array',
            'description.*' => 'required|string',
        ]);


        $feature = features::create([
            'title'       => $request->title,
            'sub_title'   => $request->sub_title,
        ]);

        $IconArray = $request->input('icon');

        foreach ($IconArray as $key => $icon) {
            FeatureContent::create([
                'feature_id'  => $feature->id,
                'icon'        => $icon,
                'name'        => $request->input('name')[$key],
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

            'icon' => 'required|array',
            'icon.*' => 'required|string',

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

        foreach ($request->input('icon') as $key => $icon) {
            $contentId = $contentIds[$key] ?? null;

            if ($contentId) {
                // Update existing content
                $featureContent = FeatureContent::find($contentId);
                if ($featureContent) {
                    $featureContent->update([
                        'icon' => $icon,
                        'name' => $request->input('name')[$key],
                        'description' => $request->input('description')[$key],
                    ]);
                }
            } else {
                // Create new content
                FeatureContent::create([
                    'feature_id' => $feature->id,
                    'icon' => $icon,
                    'name' => $request->input('name')[$key],
                    'description' => $request->input('description')[$key],
                ]);
            }
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
        FeatureContent::where('feature_id', $id)->delete();
        $feature = features::findOrFail($id);
        $feature->delete();
        return redirect()
            ->route('admin.feature.index')
            ->with('success', 'Feature deleted successfully');
    }
}
