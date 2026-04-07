<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MenuLocations;
use App\Models\MenuItem;
use App\Models\SubMenu;
use App\Models\Department;
use App\Models\pages;
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
        $data['menu'] = MenuLocations::with('menuItems.submenus')->findOrFail($id);
        $data['pages'] = pages::orderBy('title')->get();
        $data['departments'] = Department::orderBy('name')->get();

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
            'location_id' => 'required|integer|exists:menu_locations,id',
            'menu_name' => 'required|string|max:255',
            'menu_items' => 'nullable|array',
            'menu_items.*.name' => 'required|string|max:255',
            'menu_items.*.url' => 'nullable|string|max:2048',
            'menu_items.*.sort_order' => 'nullable|integer|min:0',
            'menu_items.*.submenus' => 'nullable|array',
            'menu_items.*.submenus.*.name' => 'required|string|max:255',
            'menu_items.*.submenus.*.url' => 'nullable|string|max:2048',
            'menu_items.*.submenus.*.sort_order' => 'nullable|integer|min:0',
        ]);

        $menu = DB::transaction(function () use ($request) {
            $menu = MenuLocations::findOrFail($request->location_id);
            $menu->update([
                'name' => $request->menu_name,
            ]);

            $menuItems = $request->input('menu_items', []);
            $menuItemIds = [];

            foreach ($menuItems as $itemIndex => $item) {
                $menuItem = MenuItem::updateOrCreate(
                    ['id' => $item['id'] ?? null],
                    [
                        'menu_locations_id' => $menu->id,
                        'name' => $item['name'],
                        'url' => $item['url'] ?? null,
                        'sort_order' => $item['sort_order'] ?? $itemIndex,
                    ]
                );

                $menuItemIds[] = $menuItem->id;

                $subIds = [];

                foreach ($item['submenus'] ?? [] as $subIndex => $sub) {
                    $submenu = SubMenu::updateOrCreate(
                        ['id' => $sub['id'] ?? null],
                        [
                            'menu_items_id' => $menuItem->id,
                            'name' => $sub['name'],
                            'url' => $sub['url'] ?? null,
                            'sort_order' => $sub['sort_order'] ?? $subIndex,
                        ]
                    );

                    $subIds[] = $submenu->id;
                }

                $removedSubmenus = SubMenu::where('menu_items_id', $menuItem->id);
                if (!empty($subIds)) {
                    $removedSubmenus->whereNotIn('id', $subIds);
                }
                $removedSubmenus->delete();
            }

            $removedMenuItems = MenuItem::where('menu_locations_id', $menu->id);
            if (!empty($menuItemIds)) {
                $removedMenuItems->whereNotIn('id', $menuItemIds);
            }

            $removedMenuItemIds = (clone $removedMenuItems)->pluck('id');
            if ($removedMenuItemIds->isNotEmpty()) {
                SubMenu::whereIn('menu_items_id', $removedMenuItemIds)->delete();
            }
            $removedMenuItems->delete();

            return $menu;
        });

        return redirect()->route('admin.menus.items', $menu->id)
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
