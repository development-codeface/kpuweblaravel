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
        $edit_banner = DirectorBanner::where('pages_id', $id)->first();
        $edit_content = DirectorContent::where('pages_id', $id)->with('directorBlog')->first();
        return view('admin.directors.create', compact('id', 'edit_banner', 'edit_content'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'image'              => $request->banner_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->banner_id) {
            $banner = DirectorBanner::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new DirectorBanner();
        }

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/directors/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/directors/banner/' . $imageName;
        }

        $banner->pages_id    = $request->pages_id;
        $banner->title       = $request->title;
        $banner->button_text = $request->button_text;
        $banner->save();

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
            'blog_image'     => 'nullable|array',
            'blog_image.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->content_id) {
            $directorContent = DirectorContent::findOrFail($request->content_id);

            $directorContent->update([
                'title'       => $request->title,
                'description' => $request->description,
            ]);
        } else {
            $directorContent = DirectorContent::create([
                'pages_id'    => $request->pages_id,
                'title'       => $request->title,
                'description' => $request->description,
            ]);
        }

        $savedIds = [];

        foreach ($request->heading as $key => $value) {

            $blogId = $request->blog_id[$key] ?? null;

            if ($blogId) {
                $directorBlog = DirectorBlog::find($blogId);
            } else {
                $directorBlog = new DirectorBlog();
                $directorBlog->director_contents_id = $directorContent->id;
            }

            $imagePath = $directorBlog->image ?? null;

            // IMAGE UPLOAD
            if ($request->hasFile('blog_image') && isset($request->file('blog_image')[$key])) {

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

            $directorBlog->heading     = $request->heading[$key];
            $directorBlog->designation = $request->designation[$key];
            $directorBlog->text        = $request->text[$key];
            $directorBlog->image       = $imagePath;
            $directorBlog->save();

            $savedIds[] = $directorBlog->id;
        }

        // OPTIONAL DELETE REMOVED ROWS
        // DirectorBlog::where('director_contents_id', $directorContent->id)
        //     ->whereNotIn('id', $savedIds)
        //     ->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Director blog created successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
