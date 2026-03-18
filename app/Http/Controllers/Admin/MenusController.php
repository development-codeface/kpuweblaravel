<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MenuLocations;
use App\Models\MenuItem;
use App\Models\SubMenu;
use Illuminate\Support\Facades\DB;

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
        $data['menu'] = MenuLocations::with('menuItems.submenus')->find($id);
        return view('admin.menus.menu-items-create', $data);
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


    public function saveMenu(Request $request)
    {
        $request->validate([
            'menu_name' => 'required',
            'menu_items.*.name' => 'required',
            'menu_items.*.submenus.*.name' => 'required',
        ]);

        // MENU LOCATION
        $menu = MenuLocations::updateOrCreate(
            ['id' => $request->location_id],
            [
                'name' => $request->menu_name,
                'slug' => Str::slug($request->menu_name),
            ]
        );

        $menuItemIds = [];

        foreach ($request->menu_items as $item) {

            $menuItem = MenuItem::updateOrCreate(
                ['id' => $item['id'] ?? null],
                [
                    'menu_locations_id' => $menu->id,
                    'name' => $item['name'],
                    'url' => $item['url'] ?? null,
                ]
            );

            $menuItemIds[] = $menuItem->id;

            $subIds = [];

            if (!empty($item['submenus'])) {
                foreach ($item['submenus'] as $sub) {

                    $submenu = SubMenu::updateOrCreate(
                        ['id' => $sub['id'] ?? null],
                        [
                            'menu_items_id' => $menuItem->id,
                            'name' => $sub['name'],
                            'url' => $sub['url'] ?? null,
                        ]
                    );

                    $subIds[] = $submenu->id;
                }
            }

            SubMenu::where('menu_items_id', $menuItem->id)
                ->whereNotIn('id', $subIds)
                ->delete();
        }

        MenuItem::where('menu_locations_id', $menu->id)
            ->whereNotIn('id', $menuItemIds)
            ->delete();

        DB::commit();

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
