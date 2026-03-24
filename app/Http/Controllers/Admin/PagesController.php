<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\pages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends Controller
{

    public function index()
    {
        $data['pages'] = pages::all();
        return view('admin.pages.index', $data);
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        // Validate and store the page data
        // You can add your validation and storage logic here

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        pages::create([
            'title' => $request->input('title'),
            'slug'  => Str::slug($request->input('title')),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit($id)
    {
        $page = pages::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the page data
        // You can add your validation and update logic here

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $page = pages::findOrFail($id);
        $page->update([
            'title' => $request->input('title'),
            'slug'  => Str::slug($request->input('title')),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy($id)
    {
        $page = pages::findOrFail($id);
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
