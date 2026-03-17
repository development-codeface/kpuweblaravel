@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <p><i class="fi fi-br-edit mr_15_icc"></i>
                {{ trans('global.create') }} Menus </p>
        </div>

        <div class="card-body">
            {{-- <form method="POST" action="{{ route('admin.menus.save') }}">
                @csrf

                <!-- LOCATION ID -->
                <input type="hidden" name="location_id" value="{{ $menu->id ?? '' }}">

                <!-- MENU LOCATION -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label class="required">Menu Location Name</label>
                        <input type="text" name="menu_name" value="{{ old('menu_name', $menu->name ?? '') }}"
                            class="form-control {{ $errors->has('menu_name') ? 'is-invalid' : '' }}">

                        @error('menu_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- MENU ITEMS -->
                <div id="menu-items">

                    @php $oldItems = old('menu_items'); @endphp

                    @if ($oldItems || isset($menu))
                        @foreach ($oldItems ?? $menu->menuItems as $i => $item)
                            <div class="menu-item card mb-3 p-3">

                                <!-- MENU ITEM ID -->
                                <input type="hidden" name="menu_items[{{ $i }}][id]"
                                    value="{{ $oldItems ? $item['id'] ?? '' : $item->id }}">

                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="text" name="menu_items[{{ $i }}][name]"
                                            value="{{ $oldItems ? $item['name'] : $item->name }}" placeholder="Menu Name"
                                            class="form-control {{ $errors->has('menu_items.' . $i . '.name') ? 'is-invalid' : '' }}">

                                        @error('menu_items.' . $i . '.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-5">
                                        <input type="text" name="menu_items[{{ $i }}][url]"
                                            value="{{ $oldItems ? $item['url'] : $item->url }}" placeholder="Menu URL"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger w-100 remove-menu">Remove</button>
                                    </div>
                                </div>

                                <!-- SUBMENUS -->
                                <div class="submenus mt-3">

                                    @foreach ($oldItems ? $item['submenus'] ?? [] : $item->submenus as $j => $sub)
                                        <div class="submenu border p-2 mb-2">

                                            <!-- SUBMENU ID -->
                                            <input type="hidden"
                                                name="menu_items[{{ $i }}][submenus][{{ $j }}][id]"
                                                value="{{ $oldItems ? $sub['id'] ?? '' : $sub->id }}">

                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="text"
                                                        name="menu_items[{{ $i }}][submenus][{{ $j }}][name]"
                                                        value="{{ $oldItems ? $sub['name'] ?? '' : $sub->name }}"
                                                        placeholder="Submenu Name"
                                                        class="form-control {{ $errors->has('menu_items.' . $i . '.submenus.' . $j . '.name') ? 'is-invalid' : '' }}">

                                                    @error('menu_items.' . $i . '.submenus.' . $j . '.name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-5">
                                                    <input type="text"
                                                        name="menu_items[{{ $i }}][submenus][{{ $j }}][url]"
                                                        value="{{ $oldItems ? $sub['url'] ?? '' : $sub->url }}"
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

                                <button type="button" class="btn btn-primary btn-sm add-submenu mt-2">+ Add
                                    Submenu</button>

                            </div>
                        @endforeach
                    @else
                        <!-- DEFAULT -->
                        <div class="menu-item card mb-3 p-3">

                            <input type="hidden" name="menu_items[0][id]">

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

                            <button type="button" class="btn btn-primary btn-sm add-submenu mt-2">+ Add Submenu</button>
                        </div>
                    @endif

                </div>

                <button type="button" id="add-menu" class="btn btn-success">+ Add Menu</button>

                <br><br>

                <button type="submit" class="btn btn-primary">Save</button>
            </form> --}}
            <form method="POST" action="{{ route('admin.menus.save') }}">
                @csrf

                <input type="hidden" name="location_id" value="{{ $menu->id ?? '' }}">

                <!-- MENU LOCATION -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label class="required">Menu Location Name</label>
                        <input type="text" name="menu_name" value="{{ old('menu_name', $menu->name ?? '') }}"
                            class="form-control {{ $errors->has('menu_name') ? 'is-invalid' : '' }}">

                        @error('menu_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @php $oldItems = old('menu_items'); @endphp

                <!-- MENU ITEMS -->
                <div id="menu-items">

                    @if ($oldItems || isset($menu))
                        @foreach ($oldItems ?? $menu->menuItems as $i => $item)
                            <div class="menu-item card mb-3 p-3">

                                <input type="hidden" name="menu_items[{{ $i }}][id]"
                                    value="{{ $oldItems ? $item['id'] ?? '' : $item->id }}">

                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="text" name="menu_items[{{ $i }}][name]"
                                            value="{{ $oldItems ? $item['name'] ?? '' : $item->name ?? '' }}"
                                            placeholder="Menu Name"
                                            class="form-control {{ $errors->has('menu_items.' . $i . '.name') ? 'is-invalid' : '' }}">

                                        @error('menu_items.' . $i . '.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-5">
                                        <input type="text" name="menu_items[{{ $i }}][url]"
                                            value="{{ $oldItems ? $item['url'] ?? '' : $item->url ?? '' }}"
                                            placeholder="Menu URL" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger w-100 remove-menu">Remove</button>
                                    </div>
                                </div>

                                <!-- SUBMENUS -->
                                <div class="submenus mt-3">

                                    @foreach ($oldItems ? $item['submenus'] ?? [] : $item->submenus ?? [] as $j => $sub)
                                        <div class="submenu border p-2 mb-2">

                                            <input type="hidden"
                                                name="menu_items[{{ $i }}][submenus][{{ $j }}][id]"
                                                value="{{ $oldItems ? $sub['id'] ?? '' : $sub->id ?? '' }}">

                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="text"
                                                        name="menu_items[{{ $i }}][submenus][{{ $j }}][name]"
                                                        value="{{ $oldItems ? $sub['name'] ?? '' : $sub->name ?? '' }}"
                                                        placeholder="Submenu Name"
                                                        class="form-control {{ $errors->has('menu_items.' . $i . '.submenus.' . $j . '.name') ? 'is-invalid' : '' }}">

                                                    @error('menu_items.' . $i . '.submenus.' . $j . '.name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-5">
                                                    <input type="text"
                                                        name="menu_items[{{ $i }}][submenus][{{ $j }}][url]"
                                                        value="{{ $oldItems ? $sub['url'] ?? '' : $sub->url ?? '' }}"
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

                                <button type="button" class="btn btn-primary btn-sm add-submenu mt-2">+ Add
                                    Submenu</button>

                            </div>
                        @endforeach
                    @else
                        <!-- DEFAULT -->
                        <div class="menu-item card mb-3 p-3">
                            <input type="hidden" name="menu_items[0][id]">

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

                            <button type="button" class="btn btn-primary btn-sm add-submenu mt-2">+ Add Submenu</button>
                        </div>
                    @endif

                </div>

                <button type="button" id="add-menu" class="btn btn-success">+ Add Menu</button>

                <br><br>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    <script>
        let menuIndex =
            {{ old('menu_items') ? count(old('menu_items')) : (isset($menu) ? $menu->menuItems->count() : 1) }};


        // ADD MENU
        document.getElementById('add-menu').addEventListener('click', function() {

            let html = `
    <div class="menu-item card mb-3 p-3">

        <input type="hidden" name="menu_items[${menuIndex}][id]">

        <div class="row">
            <div class="col-md-5">
                <input type="text" name="menu_items[${menuIndex}][name]" class="form-control" placeholder="Menu Name">
            </div>

            <div class="col-md-5">
                <input type="text" name="menu_items[${menuIndex}][url]" class="form-control" placeholder="Menu URL">
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-danger w-100 remove-menu">Remove</button>
            </div>
        </div>

        <div class="submenus mt-3"></div>

        <button type="button" class="btn btn-primary btn-sm add-submenu mt-2">+ Add Submenu</button>
    </div>`;

            document.getElementById('menu-items').insertAdjacentHTML('beforeend', html);
            menuIndex++;
        });


        // ADD SUBMENU (FIXED)
        document.addEventListener('click', function(e) {

            if (e.target.classList.contains('add-submenu')) {

                let parent = e.target.closest('.menu-item');
                let index = parent.querySelector('input[name^="menu_items"]').name.match(/\d+/)[0];

                let container = parent.querySelector('.submenus');

                let subIndex = container.querySelectorAll('.submenu').length;

                let html = `
        <div class="submenu border p-2 mb-2">

            <input type="hidden" name="menu_items[${index}][submenus][${subIndex}][id]">

            <div class="row">
                <div class="col-md-5">
                    <input type="text"
                        name="menu_items[${index}][submenus][${subIndex}][name]"
                        class="form-control" placeholder="Submenu Name">
                </div>

                <div class="col-md-5">
                    <input type="text"
                        name="menu_items[${index}][submenus][${subIndex}][url]"
                        class="form-control" placeholder="Submenu URL">
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100 remove-submenu">X</button>
                </div>
            </div>
        </div>`;

                container.insertAdjacentHTML('beforeend', html);
            }
        });


        // REMOVE MENU
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-menu')) {
                if (document.querySelectorAll('.menu-item').length > 1) {
                    e.target.closest('.menu-item').remove();
                }
            }
        });


        // REMOVE SUBMENU
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-submenu')) {
                e.target.closest('.submenu').remove();
            }
        });
    </script>
@endsection
