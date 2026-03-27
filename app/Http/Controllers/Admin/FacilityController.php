<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\FacilityContent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['facility'] = Facility::get();
        return view('admin.facility.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.facility.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'sub_title'         => 'required',
            'heading'           => 'required|array',
            'heading.*'         => 'required|string|max:255',
            'button_text'       => 'required|array',
            'button_text.*'     => 'required|string|max:255',
            'images'            => 'required|array',
            'images.*'          => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'seo_title'         => 'nullable|string|max:255',
            'seo_description'   => 'nullable|string',
            'seo_author'        => 'nullable|string|max:255',
            'seo_robots'        => 'nullable|string|max:255',
            'seo_canonical_url' => 'nullable|url|max:2048',
            'seo_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $facility = Facility::create([
            'title'     => $request->title,
            'sub_title' => $request->sub_title
        ]);

        $this->syncSeoData($facility, $request, 'images/facility/seo');

        foreach ($request->heading as $index => $heading) {

            $imageName = null;

            // Check if image exists for this index
            if ($request->hasFile('images.' . $index)) {

                $image      = $request->file('images')[$index];
                $imageName  = time() . '_' . $index . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('images/facility');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);
            }

            FacilityContent::create([
                'facilities_id' => $facility->id,
                'heading'       => $heading,
                'button_text'   => $request->button_text[$index] ?? null,
                'image'         => $imageName,
            ]);
        }

        return redirect()->route('admin.facility.index')->with('success', 'facility created successfully.');
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
        $data['edit'] = Facility::with('content')->where('id', $id)->first();
        return view('admin.facility.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title'             => 'required|string|max:255',
            'sub_title'         => 'required',
            'heading'           => 'required|array',
            'heading.*'         => 'required|string|max:255',
            'button_text'       => 'required|array',
            'button_text.*'     => 'required|string|max:255',
            'seo_title'         => 'nullable|string|max:255',
            'seo_description'   => 'nullable|string',
            'seo_author'        => 'nullable|string|max:255',
            'seo_robots'        => 'nullable|string|max:255',
            'seo_canonical_url' => 'nullable|url|max:2048',
            'seo_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $facility = Facility::findOrFail($request->id);
        $existingContents = $facility->content()->get()->keyBy('id');

        // ✅ Update main table
        $facility->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
        ]);

        $this->syncSeoData($facility, $request, 'images/facility/seo');

        $submittedContentIds = collect($request->input('content_id', []))
            ->filter()
            ->map(fn ($value) => (int) $value)
            ->all();

        foreach ($request->heading as $index => $heading) {

            $contentId = $request->content_id[$index] ?? null;
            $content = $contentId ? $existingContents->get((int) $contentId) : null;
            $imageName = $content?->image;


            // 🔹 If new image uploaded
            if ($request->hasFile('images.' . $index)) {
                if ($content?->image) {
                    $this->deleteFacilityContentImage($content->image);
                }

                $image = $request->file('images')[$index];
                $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('images/facility');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);
            }

            // 🔥 If content already exists → UPDATE
            if ($contentId) {

                if ($content) {
                    $content->update([
                        'heading' => $heading,
                        'button_text' => $request->button_text[$index] ?? null,
                        'image' => $imageName ?? $content->image, // keep old image if not changed
                    ]);
                }
            } else {
                // 🔥 New row added → CREATE
                FacilityContent::create([
                    'facilities_id' => $facility->id,
                    'heading' => $heading,
                    'button_text' => $request->button_text[$index] ?? null,
                    'image' => $imageName,
                ]);
            }
        }

        $contentsToDelete = $existingContents
            ->reject(fn (FacilityContent $content) => in_array($content->id, $submittedContentIds, true));

        foreach ($contentsToDelete as $content) {
            $this->deleteFacilityContentImage($content->image);
            $content->delete();
        }

        return redirect()->route('admin.facility.index')
            ->with('success', 'Facility updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $facility = Facility::with('content')->findOrFail($id);

        foreach ($facility->content as $content) {
            $this->deleteFacilityContentImage($content->image);
        }

        $this->deleteUploadedImage($facility->seo->image);
        $facility->seo()->delete();
        $facility->content()->delete();
        $facility->delete();

        return redirect()->route('admin.facility.index')->with('success', 'facility created successfully.');
    }

    private function syncSeoData(Model $model, Request $request, string $directory): void
    {
        $existingSeo = $model->seo()->first();
        $seoImagePath = $existingSeo?->image;

        if ($request->hasFile('seo_image')) {
            $this->deleteUploadedImage($seoImagePath);
            $seoImagePath = $this->storeUploadedImage($request->file('seo_image'), $directory);
        }

        $seoPayload = [
            'title'         => $request->filled('seo_title') ? $request->input('seo_title') : null,
            'description'   => $request->filled('seo_description') ? $request->input('seo_description') : null,
            'author'        => $request->filled('seo_author') ? $request->input('seo_author') : null,
            'robots'        => $request->filled('seo_robots') ? $request->input('seo_robots') : null,
            'canonical_url' => $request->filled('seo_canonical_url') ? $request->input('seo_canonical_url') : null,
            'image'         => $seoImagePath,
        ];

        $hasSeoData = collect($seoPayload)->contains(fn ($value) => filled($value));

        if (! $hasSeoData) {
            if ($existingSeo) {
                $this->deleteUploadedImage($existingSeo->image);
                $existingSeo->delete();
            }

            return;
        }

        if ($existingSeo) {
            $existingSeo->update($seoPayload);
            return;
        }

        $model->seo()->create($seoPayload);
    }

    private function storeUploadedImage(UploadedFile $image, string $directory): string
    {
        $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path($directory);

        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $image->move($destinationPath, $imageName);

        return trim($directory, '/\\') . '/' . $imageName;
    }

    private function deleteUploadedImage(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }

    private function deleteFacilityContentImage(?string $imageName): void
    {
        if ($imageName) {
            $this->deleteUploadedImage('images/facility/' . $imageName);
        }
    }
}
