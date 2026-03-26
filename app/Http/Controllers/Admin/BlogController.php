<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategories;
use App\Models\Blog;

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
            'name' => 'required|string|max:255',
        ]);

        BlogCategories::create([
            'name' => $request->name,
        ]);

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
            'name' => 'required|string|max:255',
        ]);

        $category = BlogCategories::findOrFail($id);

        $category->update([
            'name' => $request->name,
        ]);

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
            'category'    => 'required|exists:blog_categories,id',
            'title'       => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/blog');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/blog/' . $imageName;
        }

        Blog::create([
            'blog_category_id' => $request->category,
            'title'            => $request->title,
            'content'      => $request->content,
            'image'            => $imagePath,
        ]);

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
            'category'    => 'required|exists:blog_categories,id',
            'title'       => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        $imagePath = $blog->image;

        if ($request->hasFile('image')) {

            if ($blog->image && file_exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/blog');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/blog/' . $imageName;
        }

        $blog->update([
            'blog_category_id' => $request->category,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
