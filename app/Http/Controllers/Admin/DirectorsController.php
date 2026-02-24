<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectorBanner;
use App\Models\DirectorContent;
use App\Models\DirectorBlog;

class DirectorsController extends Controller
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
        return view('admin.directors.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/directors/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/directors/banner/' . $imageName;
        }

        DirectorBanner::create([
            'pages_id'   => $request->pages_id,
            'title'      => $request->title,
            'button_text' => $request->button_text,
            'image'      => $imagePath,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Director banner created successfully.');
    }

    public function blogStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'heading.*' => 'required|string|max:255',
            'designation.*' => 'required|string|max:255',
            'text.*' => 'required|string|max:255',
            'blog_image'     => 'required|array',
            'blog_image.*'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // ✅ 1️⃣ Insert into director_contents (Single)
        $directorContent = DirectorContent::create([
            'pages_id' => $request->pages_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // ✅ 2️⃣ Insert multiple director_blogs
        foreach ($request->heading as $key => $value) {

            $imagePath = null;

            // Upload image for this row
            if ($request->hasFile('blog_image') && isset($request->file('blog_image')[$key])) {

                $image = $request->file('blog_image')[$key];

                $imageName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('images/directors/blog');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);

                $imagePath = 'images/directors/blog/' . $imageName;
            }

            DirectorBlog::create([
                'director_contents_id' => $directorContent->id,
                'heading' => $request->heading[$key],
                'designation' => $request->designation[$key],
                'text' => $request->text[$key],
                'image' => $imagePath,
            ]);
        }
        return redirect()->route('admin.pages.index')->with('success', 'Director blog created successfully.');
    }

    public function blogUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'heading.*' => 'required|string|max:255',
            'designation.*' => 'required|string|max:255',
            'text.*' => 'required|string|max:255',
            'blog_image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // 1️⃣ Update main content
        $directorContent = DirectorContent::findOrFail($request->content_id);

        $directorContent->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Keep existing blog IDs
        $existingIds = [];

        foreach ($request->heading as $key => $value) {

            $blogId = $request->blog_id[$key] ?? null;

            // Check if existing row
            if ($blogId) {
                $directorBlog = DirectorBlog::find($blogId);
                $existingIds[] = $blogId;
            } else {
                $directorBlog = new DirectorBlog();
                $directorBlog->director_contents_id = $directorContent->id;
            }

            $imagePath = $directorBlog->image ?? null;

            // 2️⃣ If new image uploaded
            if ($request->hasFile('blog_image') && isset($request->file('blog_image')[$key])) {

                // Delete old image
                if ($directorBlog->image && file_exists(public_path($directorBlog->image))) {
                    unlink(public_path($directorBlog->image));
                }

                $image = $request->file('blog_image')[$key];
                $imageName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('images/directors/blog');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);
                $imagePath = 'images/directors/blog/' . $imageName;
            }

            // 3️⃣ Save row
            $directorBlog->heading = $request->heading[$key];
            $directorBlog->designation = $request->designation[$key];
            $directorBlog->text = $request->text[$key];
            $directorBlog->image = $imagePath;
            $directorBlog->save();
        }

        // 4️⃣ Delete removed rows (if user deleted some rows)
        // DirectorBlog::where('director_contents_id', $directorContent->id)
        //     ->whereNotIn('id', $existingIds)
        //     ->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Director blog updated successfully.');
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
        $data['id'] = $id;
        $data['edit_banner'] = DirectorBanner::where('pages_id', $id)->first();
        $data['edit_content'] = DirectorContent::where('pages_id', $id)->with('directorBlog')->first();
        return view('admin.directors.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $banner = DirectorBanner::findOrFail($request->banner_id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $banner->image; // keep old image by default

        if ($request->hasFile('image')) {

            // Delete old image
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/directors/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $imagePath = 'images/directors/banner/' . $imageName;
        }

        $banner->update([
            'title'       => $request->title,
            'button_text' => $request->button_text,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Director banner updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
