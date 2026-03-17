@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <p><i class="fi fi-br-edit mr_15_icc"></i>
                {{ trans('global.create') }} Menus </p>
        </div>

        <div class="card-body">
            <form method="POST"
                action="">

                @csrf
                @if (isset($menu))
                    @method('PUT')
                @endif

                <!-- MENU LOCATION NAME -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="required">Menu Location Name</label>
                            <input type="text" name="menu_name" value="{{ old('menu_name', $menu->name ?? '') }}"
                                class="form-control {{ $errors->has('menu_name') ? 'is-invalid' : '' }}">

                            @error('menu_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- MENU ITEMS -->
                <div id="menu-items">

                    @php
                        $oldItems = old('menu_items');
                    @endphp

                    {{-- OLD / EDIT --}}
                    @if ($oldItems || isset($menu))
                        @foreach ($oldItems ?? ($menu->menuItems ?? []) as $i => $item)
                            <div class="menu-item card mb-3 p-3">

                                <div class="row">
                                    <!-- MENU NAME -->
                                    <div class="col-md-5">
                                        <label>Menu Name</label>
                                        <input type="text" name="menu_items[{{ $i }}][name]"
                                            value="{{ $oldItems ? $item['name'] : $item->name }}"
                                            class="form-control {{ $errors->has('menu_items.' . $i . '.name') ? 'is-invalid' : '' }}">

                                        @error('menu_items.' . $i . '.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- MENU URL -->
                                    <div class="col-md-5">
                                        <label>Menu URL</label>
                                        <input type="text" name="menu_items[{{ $i }}][url]"
                                            value="{{ $oldItems ? $item['url'] : $item->url }}"
                                            class="form-control {{ $errors->has('menu_items.' . $i . '.url') ? 'is-invalid' : '' }}">
                                    </div>

                                    <!-- REMOVE -->
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger w-100 remove-menu">Remove</button>
                                    </div>
                                </div>

                                <!-- SUBMENUS -->
                                <div class="submenus mt-3">

                                    @foreach ($oldItems ? $item['submenus'] ?? [] : $item->submenus ?? [] as $j => $sub)
                                        <div class="submenu border p-2 mb-2">
                                            <div class="row">

                                                <div class="col-md-5">
                                                    <input type="text"
                                                        name="menu_items[{{ $i }}][submenus][{{ $j }}][name]"
                                                        value="{{ $oldItems ? $sub['name'] : $sub->name }}"
                                                        placeholder="Submenu Name"
                                                        class="form-control {{ $errors->has('menu_items.' . $i . '.submenus.' . $j . '.name') ? 'is-invalid' : '' }}">

                                                    @error('menu_items.' . $i . '.submenus.' . $j . '.name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-5">
                                                    <input type="text"
                                                        name="menu_items[{{ $i }}][submenus][{{ $j }}][url]"
                                                        value="{{ $oldItems ? $sub['url'] : $sub->url }}"
                                                        placeholder="Submenu URL" class="form-control">
                                                </div>

                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-danger w-100 remove-submenu">X</button>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <button type="button" class="btn btn-sm btn-primary add-submenu mt-2">+ Add
                                    Submenu</button>

                            </div>
                        @endforeach
                    @else
                        {{-- DEFAULT FIRST ROW --}}
                        <div class="menu-item card mb-3 p-3">

                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" name="menu_items[0][name]" class="form-control"
                                        placeholder="Menu Name">
                                </div>

                                <div class="col-md-5">
                                    <input type="text" name="menu_items[0][url]" class="form-control"
                                        placeholder="Menu URL">
                                </div>

                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger w-100 remove-menu">Remove</button>
                                </div>
                            </div>

                            <div class="submenus mt-3"></div>

                            <button type="button" class="btn btn-sm btn-primary add-submenu mt-2">+ Add Submenu</button>

                        </div>
                    @endif

                </div>

                <!-- ADD MENU -->
                <button type="button" id="add-menu" class="btn btn-success">+ Add Menu</button>

                <br><br>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <script>
        let menuIndex =
            {{ old('menu_items') ? count(old('menu_items')) : (isset($menu) ? $menu->menuItems->count() : 1) }};


        // ✅ ADD MENU
        document.getElementById('add-menu').addEventListener('click', function() {

            let html = `
    <div class="menu-item card mb-3 p-3">

        <div class="row">
            <div class="col-md-5">
                <input type="text" name="menu_items[${menuIndex}][name]"
                    class="form-control" placeholder="Menu Name">
            </div>

            <div class="col-md-5">
                <input type="text" name="menu_items[${menuIndex}][url]"
                    class="form-control" placeholder="Menu URL">
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-danger w-100 remove-menu">Remove</button>
            </div>
        </div>

        <div class="submenus mt-3"></div>

        <button type="button" class="btn btn-sm btn-primary add-submenu mt-2">+ Add Submenu</button>
    </div>`;

            document.getElementById('menu-items').insertAdjacentHTML('beforeend', html);
            menuIndex++;
        });


        // ✅ ADD SUBMENU
        document.addEventListener('click', function(e) {

            if (e.target.classList.contains('add-submenu')) {

                let parent = e.target.closest('.menu-item');
                let index = parent.querySelector('input[name^="menu_items"]').name.match(/\d+/)[0];

                let html = `
        <div class="submenu border p-2 mb-2">
            <div class="row">

                <div class="col-md-5">
                    <input type="text"
                        name="menu_items[${index}][submenus][][name]"
                        placeholder="Submenu Name"
                        class="form-control">
                </div>

                <div class="col-md-5">
                    <input type="text"
                        name="menu_items[${index}][submenus][][url]"
                        placeholder="Submenu URL"
                        class="form-control">
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100 remove-submenu">X</button>
                </div>

            </div>
        </div>`;

                parent.querySelector('.submenus').insertAdjacentHTML('beforeend', html);
            }
        });


        // ✅ REMOVE MENU
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-menu')) {
                if (document.querySelectorAll('.menu-item').length > 1) {
                    e.target.closest('.menu-item').remove();
                }
            }
        });


        // ✅ REMOVE SUBMENU
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-submenu')) {
                e.target.closest('.submenu').remove();
            }
        });
    </script>
@endsection
