<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::with('category')->get();
        return view('admin.blog.index', compact('blog'));
    }

    public function categoryPage()
    {
        $category = BlogCategories::get();
        return view('admin.blog.category.index', compact('category'));
    }

    public function categoryCreate(Request $request)
    {
        return view('admin.blog.category.create');
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'seo_title'         => 'nullable|string|max:255',
            'seo_description'   => 'nullable|string',
            'seo_author'        => 'nullable|string|max:255',
            'seo_robots'        => 'nullable|string|max:255',
            'seo_canonical_url' => 'nullable|url|max:2048',
            'seo_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $category = BlogCategories::create([
            'name' => $request->name,
        ]);

        $this->syncSeoData($category, $request, 'images/blog/category/seo');

        return redirect()->route('admin.blog.category.index')->with('success', 'Category created successfully.');
    }

    public function categoryEdit($id)
    {
        $edit = BlogCategories::find($id);
        return view('admin.blog.category.edit', compact('edit'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'seo_title'         => 'nullable|string|max:255',
            'seo_description'   => 'nullable|string',
            'seo_author'        => 'nullable|string|max:255',
            'seo_robots'        => 'nullable|string|max:255',
            'seo_canonical_url' => 'nullable|url|max:2048',
            'seo_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $category = BlogCategories::findOrFail($id);

        $category->update([
            'name' => $request->name,
        ]);

        $this->syncSeoData($category, $request, 'images/blog/category/seo');

        return redirect()->route('admin.blog.category.index')->with('success', 'Category update successfully.');
    }

    public function categoryDestroy($id)
    {
        $category = BlogCategories::find($id);
        $category->delete();
        return redirect()->route('admin.blog.category.index')->with('success', 'Category deleted successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = BlogCategories::get();
        return view('admin.blog.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category'          => 'required|exists:blog_categories,id',
            'title'             => 'required|string|max:255',
            'content'           => 'nullable|string',
            'image'             => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'seo_title'         => 'nullable|string|max:255',
            'seo_description'   => 'nullable|string',
            'seo_author'        => 'nullable|string|max:255',
            'seo_robots'        => 'nullable|string|max:255',
            'seo_canonical_url' => 'nullable|url|max:2048',
            'seo_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $this->storeUploadedImage($request->file('image'), 'images/blog');

        $blog = Blog::create([
            'blog_category_id' => $request->category,
            'title'            => $request->title,
            'content'          => $request->content,
            'image'            => $imagePath,
        ]);

        $this->syncSeoData($blog, $request, 'images/blog/seo');

        return redirect()->route('admin.blog.post.index')->with('success', 'Blog created successfully!');
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
        $edit = Blog::findOrFail($id);
        $category = BlogCategories::get();
        return view('admin.blog.edit', compact('edit', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category'          => 'required|exists:blog_categories,id',
            'title'             => 'required|string|max:255',
            'content'           => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'seo_title'         => 'nullable|string|max:255',
            'seo_description'   => 'nullable|string',
            'seo_author'        => 'nullable|string|max:255',
            'seo_robots'        => 'nullable|string|max:255',
            'seo_canonical_url' => 'nullable|url|max:2048',
            'seo_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        $imagePath = $blog->image;

        if ($request->hasFile('image')) {
            $this->deleteUploadedImage($blog->image);
            $imagePath = $this->storeUploadedImage($request->file('image'), 'images/blog');
        }

        $blog->update([
            'blog_category_id' => $request->category,
            'title'            => $request->title,
            'content'          => $request->content,
            'image'            => $imagePath,
        ]);

        $this->syncSeoData($blog, $request, 'images/blog/seo');

        return redirect()->route('admin.blog.post.index')->with('success', 'Blog updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
}
