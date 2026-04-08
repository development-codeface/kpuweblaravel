<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\SpacialityBanner;
use App\Models\SpacialityBlog;
use App\Models\SpacialityContent;
use App\Models\SpacialityFeature;
use App\Models\SpacialityFeatureContent;
use App\Models\SpacialitySubContent;

class SpacialityController extends Controller
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
    public function create(Request $request, $id)
    {
        $departmentId = $request->integer('department_id') ?: null;

        $data['id'] = $id;
        $data['departmentId'] = $departmentId;
        $data['department'] = $departmentId ? Department::findOrFail($departmentId) : null;
        $data['banner'] = $this->getSpacialityRecord(SpacialityBanner::class, $id, $departmentId);
        $data['content'] = $this->getSpacialityRecord(SpacialityContent::class, $id, $departmentId, ['subContents']);
        $data['blog'] = $this->getSpacialityRecords(SpacialityBlog::class, $id, $departmentId);
        $data['feature'] = $this->getSpacialityRecord(SpacialityFeature::class, $id, $departmentId, ['featureContents']);

        return view('admin.spaciality.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $departmentId = $this->resolveDepartmentId($request);

        $request->validate([
            'pages_id'            => 'required|integer|exists:pages,id',
            'department_id'       => 'nullable|integer|exists:departments,id',
            'title'              => 'required|string|max:255',
            'button_text'        => 'required|string|max:255',
            'text'               => 'required|string',
            'banner_description' => 'required|string',
            'image'              => $request->banner_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Check if updating
        if ($request->banner_id) {
            $banner = SpacialityBanner::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new SpacialityBanner();
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/spaciality/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/spaciality/banner/' . $imageName;
        }

        // Common Fields
        $banner->pages_id    = $request->pages_id;
        $banner->department_id = $departmentId;
        $banner->title       = $request->title;
        $banner->button_text = $request->button_text;
        $banner->text        = $request->text;
        $banner->description = $request->banner_description;
        $banner->save();

        return $this->redirectToBuilder($request, 'Spaciality saved successfully.');
    }

    public function contentStore(Request $request)
    {
        $departmentId = $this->resolveDepartmentId($request);

        $request->validate([
            'pages_id' => 'required|integer|exists:pages,id',
            'department_id' => 'nullable|integer|exists:departments,id',
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',

            'images' => $request->content_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'heading' => 'required|array|min:1',
            'heading.*' => 'required|string|max:255',

            'description' => 'required|array|min:1',
            'description.*' => 'required|string',
        ]);



        if ($request->content_id) {

            $content = SpacialityContent::findOrFail($request->content_id);

            $content->update([
                'pages_id'  => $request->pages_id,
                'department_id' => $departmentId,
                'title'     => $request->title,
                'sub_title' => $request->sub_title,
            ]);
        } else {

            $content = SpacialityContent::create([
                'pages_id'  => $request->pages_id,
                'department_id' => $departmentId,
                'title'     => $request->title,
                'sub_title' => $request->sub_title,
            ]);
        }



        if ($request->hasFile('images')) {

            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/spaciality/content');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // delete old image if update
            if (!empty($content->image) && file_exists(public_path($content->image))) {
                unlink(public_path($content->image));
            }

            $image->move($destinationPath, $imageName);

            $content->update([
                'image' => 'images/spaciality/content/' . $imageName
            ]);
        }

        // $existingIds = SpacialitySubContent::where('spaciality_contents_id', $content->id)
        //     ->pluck('id')
        //     ->toArray();

        // $submittedIds = array_filter($request->sub_content_id ?? []);

        // $idsToDelete = array_diff($existingIds, $submittedIds);

        // if (!empty($idsToDelete)) {
        //     SpacialitySubContent::whereIn('id', $idsToDelete)->delete();
        // }


        foreach ($request->heading as $index => $heading) {

            $subId = $request->sub_content_id[$index] ?? null;

            if ($subId) {

                // UPDATE EXISTING
                SpacialitySubContent::where('id', $subId)->update([
                    'heading'     => $heading,
                    'description' => $request->description[$index],
                ]);
            } else {

                // CREATE NEW
                SpacialitySubContent::create([
                    'spaciality_contents_id' => $content->id,
                    'heading'                => $heading,
                    'description'            => $request->description[$index],
                ]);
            }
        }

        return $this->redirectToBuilder($request, 'Spaciality saved successfully.');
    }

    public function blogStore(Request $request)
    {
        $departmentId = $this->resolveDepartmentId($request);

        $request->validate([
            'pages_id' => 'required|integer|exists:pages,id',
            'department_id' => 'nullable|integer|exists:departments,id',
            'icon.*'        => 'required',
            'blog_title.*'       => 'required',
            'blog_description.*' => 'required',
        ]);

        foreach ($request->blog_title as $key => $value) {

            if (!empty($request->blog_id[$key])) {

                // 🔵 UPDATE
                $blog = SpacialityBlog::findOrFail($request->blog_id[$key]);

                $blog->update([
                    'pages_id'   => $request->pages_id,
                    'department_id' => $departmentId,
                    'icon'       => $request->icon[$key],
                    'title'      => $request->blog_title[$key],
                    'description' => $request->blog_description[$key],
                ]);
            } else {

                // 🟢 CREATE
                SpacialityBlog::create([
                    'pages_id'   => $request->pages_id,
                    'department_id' => $departmentId,
                    'icon'       => $request->icon[$key],
                    'title'      => $request->blog_title[$key],
                    'description' => $request->blog_description[$key],
                ]);
            }
        }

        return $this->redirectToBuilder($request, 'Spaciality saved successfully.');
    }

    public function featureStore(Request $request)
    {
        $departmentId = $this->resolveDepartmentId($request);

        $request->validate([
            'pages_id' => 'required|integer|exists:pages,id',
            'department_id' => 'nullable|integer|exists:departments,id',
            'feature_title' => 'required|string|max:255',
            'feature_sub_title' => 'required|string|max:255',
            'feature_icon' => 'nullable|array',
            'feature_icon.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'existing_feature_icon' => 'nullable|array',
            'existing_feature_icon.*' => 'nullable|string|max:255',
            'content_id' => 'nullable|array',
            'content_id.*' => 'nullable|integer',
            'names' => 'required|array|min:1',
            'names.*' => 'required|string|max:255',
            'feature_description' => 'required|array|min:1',
            'feature_description.*' => 'required|string',
        ], [
            'feature_icon.*.uploaded' => 'The icon image failed to upload. Please choose an image smaller than 2MB.',
        ]);

        $feature = SpacialityFeature::updateOrCreate(
            ['id' => $request->feature_id],
            [
                'pages_id' => $request->pages_id,
                'department_id' => $departmentId,
                'title' => $request->feature_title,
                'sub_title' => $request->feature_sub_title,
            ]
        );

        $savedContentIds = [];
        $contentIds = $request->input('content_id', []);
        $existingIcons = $request->input('existing_feature_icon', []);
        $featureDescriptions = $request->input('feature_description', []);
        $uploadedFeatureIcons = $request->file('feature_icon', []);

        foreach ($request->input('names', []) as $key => $name) {
            $contentId = $contentIds[$key] ?? null;
            $featureContent = $contentId ? SpacialityFeatureContent::find($contentId) : new SpacialityFeatureContent();

            if (!$featureContent) {
                $featureContent = new SpacialityFeatureContent();
            }

            $iconPath = $existingIcons[$key] ?? $featureContent->icon ?? null;
            $uploadedIcon = $uploadedFeatureIcons[$key] ?? null;

            if ($uploadedIcon) {
                $this->deleteFeatureIconIfExists($featureContent->icon ?? null);
                $iconPath = $this->uploadFeatureIcon($uploadedIcon, $key);
            }

            if (!$iconPath) {
                return back()
                    ->withErrors(['feature_icon.' . $key => 'The icon image field is required.'])
                    ->withInput();
            }

            $featureContent->spaciality_feature_id = $feature->id;
            $featureContent->icon = $iconPath;
            $featureContent->name = $name;
            $featureContent->description = $featureDescriptions[$key] ?? '';
            $featureContent->save();

            $savedContentIds[] = $featureContent->id;
        }

        $removedContents = SpacialityFeatureContent::where('spaciality_feature_id', $feature->id)
            ->when(!empty($savedContentIds), function ($query) use ($savedContentIds) {
                $query->whereNotIn('id', $savedContentIds);
            })
            ->get();

        foreach ($removedContents as $removedContent) {
            $this->deleteFeatureIconIfExists($removedContent->icon);
            $removedContent->delete();
        }

        return $this->redirectToBuilder($request, 'Spaciality core values saved successfully.');
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
        return view('admin.spaciality.edit');
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

    private function getSpacialityRecord(string $modelClass, int $pageId, ?int $departmentId = null, array $with = [])
    {
        $query = $modelClass::query();

        if (!empty($with)) {
            $query->with($with);
        }

        $query->where('pages_id', $pageId);

        if ($departmentId) {
            return $query->where('department_id', $departmentId)->first();
        }

        return $query->where(function ($departmentQuery) {
            $departmentQuery->whereNull('department_id')
                ->orWhere('department_id', 0);
        })->first();
    }

    private function getSpacialityRecords(string $modelClass, int $pageId, ?int $departmentId = null, array $with = [])
    {
        $query = $modelClass::query();

        if (!empty($with)) {
            $query->with($with);
        }

        $query->where('pages_id', $pageId);

        if ($departmentId) {
            return $query->where('department_id', $departmentId)->get();
        }

        return $query->where(function ($departmentQuery) {
            $departmentQuery->whereNull('department_id')
                ->orWhere('department_id', 0);
        })->get();
    }

    private function redirectToBuilder(Request $request, string $message)
    {
        $routeParameters = ['id' => $request->pages_id];

        $departmentId = $this->resolveDepartmentId($request);

        if ($departmentId) {
            $routeParameters['department_id'] = $departmentId;
        }

        return redirect()
            ->route('admin.Specialities.create', $routeParameters)
            ->with('success', $message)
            ->with('active_tab', $request->input('active_tab', 'bannerSection'));
    }

    private function resolveDepartmentId(Request $request): ?int
    {
        return $request->filled('department_id') ? (int) $request->department_id : null;
    }

    private function uploadFeatureIcon($icon, int $key): string
    {
        $imageName = time() . '_' . $key . '.' . $icon->getClientOriginalExtension();
        $destinationPath = public_path('images/spaciality/feature-icons');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $icon->move($destinationPath, $imageName);

        return 'images/spaciality/feature-icons/' . $imageName;
    }

    private function deleteFeatureIconIfExists(?string $imagePath): void
    {
        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }
    }
}
