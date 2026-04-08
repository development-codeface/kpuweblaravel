<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\pages;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends Controller
{

    public function index()
    {
        $data['pages'] = pages::get();
        return view('admin.pages.index', $data);
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'seo_author' => 'nullable|string|max:255',
            'seo_robots' => 'nullable|string|max:255',
            'seo_canonical_url' => 'nullable|url|max:255',
        ]);

        $page = pages::create([
            'title' => $request->input('title'),
            'slug'  => Str::slug($request->input('title')),
        ]);

        $page->seo()->create([
            'title' => $request->input('seo_title'),
            'description' => $request->input('seo_description'),
            'image' => $this->uploadSeoImage($request),
            'author' => $request->input('seo_author'),
            'robots' => $request->input('seo_robots'),
            'canonical_url' => $request->input('seo_canonical_url'),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit($id)
    {
        $page = pages::with('seo')->findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'seo_author' => 'nullable|string|max:255',
            'seo_robots' => 'nullable|string|max:255',
            'seo_canonical_url' => 'nullable|url|max:255',
            'existing_seo_image' => 'nullable|string|max:255',
        ]);

        $page = pages::with('seo')->findOrFail($id);
        $page->update([
            'title' => $request->input('title'),
            'slug'  => Str::slug($request->input('title')),
        ]);

        $seoImagePath = $request->input('existing_seo_image');

        if ($request->hasFile('seo_image')) {
            $this->deleteImageIfExists($page->seo->image ?? null);
            $seoImagePath = $this->uploadSeoImage($request);
        }

        $page->seo()->updateOrCreate([], [
            'title' => $request->input('seo_title'),
            'description' => $request->input('seo_description'),
            'image' => $seoImagePath,
            'author' => $request->input('seo_author'),
            'robots' => $request->input('seo_robots'),
            'canonical_url' => $request->input('seo_canonical_url'),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy($id)
    {
        $page = pages::with('seo')->findOrFail($id);

        if ($page->seo) {
            $this->deleteImageIfExists($page->seo->image);
            $page->seo->delete();
        }

        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }

    private function uploadSeoImage(Request $request): ?string
    {
        if (!$request->hasFile('seo_image')) {
            return null;
        }

        $image = $request->file('seo_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('images/seo');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $image->move($destinationPath, $imageName);

        return 'images/seo/' . $imageName;
    }

    private function deleteImageIfExists(?string $imagePath): void
    {
        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }
    }
}
