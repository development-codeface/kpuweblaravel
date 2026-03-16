<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HealthPakageBanner;
use App\Models\HealthPackagecontent;
use Illuminate\Support\Facades\DB;
use App\Models\HealthPackageBlog;

class HealthPackagesController extends Controller
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
        $data['id'] = $id;
        $data["banner"]  = HealthPakageBanner::where('pages_id', $id)->first();
        $data["content"] = HealthPackagecontent::where('pages_id', $id)->first();
        $data['blog']    = HealthPackageBlog::where('pages_id', $id)->get();
        $data["category"] = DB::table('category')->select('id', 'name')->get();
        return view('admin.health_package.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'button_text' => 'required|string|max:255',
            'description' => 'required',
            'image'              => $request->banner_id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->banner_id) {
            $banner = HealthPakageBanner::findOrFail($request->banner_id);
            $banner->image = $banner->image;
        } else {
            $banner = new HealthPakageBanner();
        }

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/health_package/banner');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $banner->image = 'images/health_package/banner/' . $imageName;
        }

        $banner->pages_id    = $request->pages_id;
        $banner->title       = $request->title;
        $banner->description      = $request->description;
        $banner->button_text = $request->button_text;
        $banner->save();

        return redirect()->route('admin.pages.index')->with('success', 'Package banner created successfully.');
    }

    public function ContentStore(Request $request)
    {
        $request->validate([
            'content_title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
        ]);

        if ($request->content_id) {
            $content = HealthPackagecontent::find($request->content_id);

            $content->update([
                'title'      => $request->content_title,
                'sub_title' => $request->sub_title,
            ]);
        } else {

            HealthPackagecontent::create([
                'pages_id'   => $request->pages_id,
                'title'      => $request->content_title,
                'sub_title' => $request->sub_title,
            ]);
        }

        return redirect()->route('admin.pages.index')->with('success', 'Package content created successfully.');
    }

    public function blogStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'category_id.*'        => 'required',
            'blog_title.*'         => 'required|string|max:255',
            'sub_titles.*'     => 'required|string|max:255',
            'name.*'          => 'required|string|max:255',
            'designation.*'   => 'required|string|max:255',
            'image.*'         => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $savedIds = [];

        foreach ($request->blog_title as $key => $value) {

            $blogId = $request->blog_id[$key] ?? null;

            if ($blogId) {
                $blog = HealthPackageBlog::find($blogId);
            } else {
                $blog = new HealthPackageBlog();
                $blog->pages_id = $request->pages_id;
            }

            $imagePath = $blog->image ?? null;

            // IMAGE UPLOAD
            if ($request->hasFile('image') && isset($request->file('image')[$key])) {

                // delete old image
                if ($blog->image && file_exists(public_path($blog->image))) {
                    unlink(public_path($blog->image));
                }

                $image = $request->file('image')[$key];
                $imageName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('images/health_package/blog');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $imageName);
                $imagePath = 'images/health_package/blog/' . $imageName;
            }

            $blog->category_id = $request->category_id[$key];
            $blog->title       = $request->blog_title[$key];
            $blog->sub_title   = $request->sub_titles[$key];
            $blog->name        = $request->name[$key];
            $blog->designation = $request->designation[$key];
            $blog->image       = $imagePath;
            $blog->save();

            $savedIds[] = $blog->id;
        }

        // DELETE REMOVED ROWS
        // HealthPackageBlog::where('pages_id', $request->pages_id)
        //     ->whereNotIn('id', $savedIds)
        //     ->delete();


        return redirect()->route('admin.pages.index')->with('success', 'Career content created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
