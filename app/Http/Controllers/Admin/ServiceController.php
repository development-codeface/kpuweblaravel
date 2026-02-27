<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\ServiceContent;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
        $data['menu'] = Menu::get();
        $data['content'] = ServiceContent::where('pages_id', $id)->get();
        return view('admin.service.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'menu' => 'required|array',
            'menu.*' => 'required|exists:menus,id',
            'title.*' => 'required|string|max:255',
            'description.*' => 'required|string',
        ]);

        $savedIds = [];

        foreach ($request->title as $index => $title) {

            $id = $request->content_id[$index] ?? null;

            if (!empty($id)) {

                ServiceContent::where('id', $id)->update([
                    'menus_id' => $request->menu[$index],
                    'title' => $title,
                    'description' => $request->description[$index],
                ]);

                $savedIds[] = $id;
            } else {

                $new = ServiceContent::create([
                    'pages_id' => $request->pages_id,
                    'menus_id' => $request->menu[$index],
                    'title' => $title,
                    'description' => $request->description[$index],
                ]);

                $savedIds[] = $new->id;
            }
        }

        // Delete removed rows
        // ServiceContent::where('pages_id', $request->pages_id)
        //     ->whereNotIn('id', $savedIds)
        //     ->delete();

       return redirect()->route('admin.pages.index')
            ->with('success', 'Content saved successfully.');
    }

    public function menuStore(Request $request)
    {
        $request->validate([
            'name'   => 'required|array',
            'name.*' => 'required|string|max:255',
        ]);

        $menuIds = [];

        foreach ($request->name as $index => $name) {

            $id = $request->menu_id[$index] ?? null;

            if (!empty($id)) {

                // UPDATE
                Menu::where('id', $id)->update([
                    'name' => $name,
                ]);

                $menuIds[] = $id;
            } else {

                // INSERT
                $newMenu = Menu::create([
                    'pages_id' => $request->pages_id,
                    'name'     => $name,
                ]);

                $menuIds[] = $newMenu->id;
            }
        }

        return redirect()->route('admin.pages.index')
            ->with('success', 'Menu saved successfully.');
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
