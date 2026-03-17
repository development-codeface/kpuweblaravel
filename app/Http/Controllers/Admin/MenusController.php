<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MenuLocations;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['menu_locations'] =  MenuLocations::where('status', 'published')->get();
        return view('admin.menus.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    public function menuItems($id)
    {
        $data['id'] = $id;
        $data['menu'] = MenuLocations::with('menuItems.submenus')->find(1);
        return view('admin.menus.menu-items-create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:draft,published',
        ]);

        // ✅ Create Data
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name), // auto slug
            'status' => $request->status,
        ];

        MenuLocations::create($data);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu Location saved successfully.');
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
        //
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
}
