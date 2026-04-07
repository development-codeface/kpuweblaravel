@extends('layouts.admin')
@section('content')
    @php
        $pageSources = $pages
            ->map(fn($page) => [
                'name' => $page->title,
                'url' => $page->frontendUrl(),
                'label' => 'Page',
            ])
            ->values()
            ->all();

        $departmentSources = $departments
            ->map(fn($department) => [
                'name' => $department->name,
                'url' => route('doctor.search', ['q' => $department->name], false),
                'label' => 'Department',
            ])
            ->values()
            ->all();

        $oldItems = old('menu_items');

        if (is_array($oldItems)) {
            $initialMenuItems = collect($oldItems)
                ->values()
                ->map(fn($item) => [
                    'id' => $item['id'] ?? null,
                    'name' => $item['name'] ?? '',
                    'url' => $item['url'] ?? '',
                    'submenus' => collect($item['submenus'] ?? [])
                        ->values()
                        ->map(fn($sub) => [
                            'id' => $sub['id'] ?? null,
                            'name' => $sub['name'] ?? '',
                            'url' => $sub['url'] ?? '',
                            'submenus' => [],
                        ])
                        ->all(),
                ])
                ->all();
        } else {
            $initialMenuItems = $menu->menuItems
                ->map(fn($item) => [
                    'id' => $item->id,
                    'name' => $item->name,
                    'url' => $item->url,
                    'submenus' => $item->submenus
                        ->map(fn($sub) => [
                            'id' => $sub->id,
                            'name' => $sub->name,
                            'url' => $sub->url,
                            'submenus' => [],
                        ])
                        ->values()
                        ->all(),
                ])
                ->values()
                ->all();
        }
    @endphp

    <style>
        .menu-builder .builder-card { border: 1px solid #dbe5f0; border-radius: 16px; box-shadow: 0 16px 36px rgba(18, 38, 63, .08); }
        .menu-builder .hero { padding: 24px; margin-bottom: 20px; display: flex; gap: 16px; justify-content: space-between; align-items: start; }
        .menu-builder .hero p { margin: 0; color: #5e7389; }
        .menu-builder .hero small { color: #0d6efd; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        .menu-builder .hero h2 { margin: 8px 0 10px; color: #12314f; font-weight: 700; }
        .menu-builder .panel { padding: 20px; background: #fff; }
        .menu-builder details { border: 1px solid #dbe5f0; border-radius: 14px; background: #f8fbff; margin-bottom: 12px; }
        .menu-builder summary { cursor: pointer; list-style: none; padding: 14px 16px; font-weight: 700; color: #17314b; display: flex; justify-content: space-between; }
        .menu-builder summary::-webkit-details-marker { display: none; }
        .menu-builder .source-body { padding: 0 16px 16px; }
        .menu-builder .source-list { max-height: 260px; overflow: auto; }
        .menu-builder .source-option { display: flex; gap: 10px; padding: 10px 12px; border: 1px solid #dbe5f0; border-radius: 12px; background: #fff; margin-bottom: 10px; }
        .menu-builder .source-option span small { display: block; color: #6b7d90; margin-top: 2px; }
        .menu-builder .structure-note { padding: 14px 16px; border-radius: 12px; background: #eaf3ff; color: #2d5f92; margin-bottom: 16px; }
        .menu-builder .structure-empty { padding: 24px; border: 1px dashed #c9d7e6; border-radius: 14px; background: #f8fbff; color: #6b7d90; text-align: center; }
        .menu-builder .structure-list, .menu-builder .submenu-list { list-style: none; padding: 0; margin: 0; }
        .menu-builder .structure-list > li, .menu-builder .submenu-list > li { margin-top: 14px; }
        .menu-builder .submenu-list { margin-left: 24px; border-left: 2px solid #e1ecfb; padding-left: 14px; }
        .menu-builder .menu-node { border: 1px solid #dbe5f0; border-radius: 14px; background: #fff; overflow: hidden; }
        .menu-builder .node-head { padding: 14px 16px; background: linear-gradient(180deg, #fff 0%, #f8fbff 100%); border-bottom: 1px solid #dbe5f0; display: flex; gap: 12px; justify-content: space-between; }
        .menu-builder .node-head strong, .menu-builder .node-head small { display: block; }
        .menu-builder .node-head small, .menu-builder .node-meta { color: #6b7d90; }
        .menu-builder .node-badge { display: inline-block; padding: 4px 10px; border-radius: 999px; background: #eaf3ff; color: #0d6efd; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .menu-builder .node-actions { display: flex; gap: 8px; flex-wrap: wrap; justify-content: end; }
        .menu-builder .node-body { padding: 16px; }
        .menu-builder .node-meta { margin-top: 12px; font-size: 12px; display: flex; gap: 16px; flex-wrap: wrap; }
        .menu-builder .footer-box { padding: 18px 20px; display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-top: 20px; }
        @media (max-width: 991.98px) { .menu-builder .hero, .menu-builder .footer-box, .menu-builder .node-head { flex-direction: column; } .menu-builder .hero .btn, .menu-builder .footer-box .btn { width: 100%; } .menu-builder .node-actions { justify-content: start; } }
    </style>

    <div class="menu-builder">
        <form method="POST" action="{{ route('admin.menus.save') }}" id="menuBuilderForm">
            @csrf
            <input type="hidden" name="location_id" value="{{ $menu->id }}">

            <div class="builder-card hero bg-white">
                <div>
                    <small>Appearance / Menus</small>
                    <h2>Build "{{ $menu->name }}"</h2>
                    <p>Add pages, departments, and custom links from the left, then arrange them into top-level items and submenus on the right.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-light">Back</a>
                    <button type="submit" class="btn btn-primary">Save menu</button>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 mb-4">
                    <div class="builder-card panel">
                        <div class="mb-4">
                            <label class="font-weight-bold mb-2" for="menu_name">Menu name</label>
                            <input type="text" id="menu_name" name="menu_name"
                                class="form-control {{ $errors->has('menu_name') ? 'is-invalid' : '' }}"
                                value="{{ old('menu_name', $menu->name) }}">
                            @error('menu_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <details open>
                            <summary><span>Pages</span><span>{{ count($pageSources) }}</span></summary>
                            <div class="source-body">
                                @if (count($pageSources))
                                    <div class="source-list">
                                        @foreach ($pageSources as $source)
                                            <label class="source-option">
                                                <input type="checkbox" class="js-source" data-label="{{ $source['label'] }}"
                                                    data-name="{{ $source['name'] }}" data-url="{{ $source['url'] }}">
                                                <span>
                                                    <strong>{{ $source['name'] }}</strong>
                                                    <small>{{ $source['url'] }}</small>
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block js-add-selected">Add selected pages</button>
                                @else
                                    <div class="structure-empty">No pages available.</div>
                                @endif
                            </div>
                        </details>

                        <details>
                            <summary><span>Departments</span><span>{{ count($departmentSources) }}</span></summary>
                            <div class="source-body">
                                @if (count($departmentSources))
                                    <div class="source-list">
                                        @foreach ($departmentSources as $source)
                                            <label class="source-option">
                                                <input type="checkbox" class="js-source" data-label="{{ $source['label'] }}"
                                                    data-name="{{ $source['name'] }}" data-url="{{ $source['url'] }}">
                                                <span>
                                                    <strong>{{ $source['name'] }}</strong>
                                                    <small>{{ $source['url'] }}</small>
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block js-add-selected">Add selected departments</button>
                                @else
                                    <div class="structure-empty">No departments available.</div>
                                @endif
                            </div>
                        </details>

                        <details>
                            <summary><span>Custom Link</span><span>+</span></summary>
                            <div class="source-body">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2" for="customLinkTitle">Link text</label>
                                    <input type="text" id="customLinkTitle" class="form-control" placeholder="Contact Us">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold mb-2" for="customLinkUrl">URL</label>
                                    <input type="text" id="customLinkUrl" class="form-control" placeholder="/contact">
                                </div>
                                <div class="text-danger small d-none" id="customLinkError">Enter both link text and URL.</div>
                                <button type="button" class="btn btn-primary btn-block mt-3" id="addCustomLink">Add custom link</button>
                            </div>
                        </details>
                    </div>
                </div>

                <div class="col-xl-8 mb-4">
                    <div class="builder-card panel">
                        <h4 class="font-weight-bold mb-3">Menu Structure</h4>
                        <div class="structure-note">Use Up and Down to reorder items. Use Submenu to place an item under the item above it. Use Top Level to pull it back out.</div>
                        <div class="structure-empty" id="menuEmpty">Your menu is empty. Add items from the left panel.</div>
                        <ul class="structure-list" id="menuRoot"></ul>
                    </div>
                </div>
            </div>

            <div id="menuHiddenInputs"></div>

            <div class="builder-card footer-box bg-white">
                <span class="text-muted">The structure shown above will be saved exactly as displayed.</span>
                <button type="submit" class="btn btn-primary">Save menu structure</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const initialItems = @json($initialMenuItems);
            const root = document.getElementById('menuRoot');
            const empty = document.getElementById('menuEmpty');
            const form = document.getElementById('menuBuilderForm');
            const hidden = document.getElementById('menuHiddenInputs');
            const customTitle = document.getElementById('customLinkTitle');
            const customUrl = document.getElementById('customLinkUrl');
            const customError = document.getElementById('customLinkError');

            const esc = (value) => String(value || '').replace(/[&<>"']/g, (char) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[char]));
            const childList = (item) => Array.from(item.children).find((node) => node.classList && node.classList.contains('submenu-list'));
            const isSubmenu = (item) => item.parentElement && item.parentElement.classList.contains('submenu-list');

            function syncItem(item) {
                const name = item.querySelector('.js-name').value.trim() || 'Untitled item';
                const url = item.querySelector('.js-url').value.trim() || 'No URL set';
                const parent = isSubmenu(item) ? item.parentElement.closest('li') : null;

                item.querySelector('.js-title').textContent = name;
                item.querySelector('.js-url-text').textContent = url;
                item.querySelector('.js-level').textContent = isSubmenu(item) ? 'Submenu' : 'Top level';
                item.querySelector('.js-parent').textContent = parent ? `Child of "${parent.querySelector('.js-name').value.trim() || 'Untitled item'}"` : 'Main navigation item';
                item.querySelector('.js-indent').disabled = isSubmenu(item) || !item.previousElementSibling;
                item.querySelector('.js-outdent').disabled = !isSubmenu(item);
                item.querySelector('.js-up').disabled = !item.previousElementSibling;
                item.querySelector('.js-down').disabled = !item.nextElementSibling;
            }

            function refresh() {
                root.querySelectorAll('li').forEach(syncItem);
                empty.classList.toggle('d-none', !!root.children.length);
            }

            function createItem(item) {
                const li = document.createElement('li');
                li.dataset.id = item.id || '';
                li.innerHTML = `
                    <div class="menu-node">
                        <div class="node-head">
                            <div>
                                <span class="node-badge js-level">Top level</span>
                                <strong class="js-title">Untitled item</strong>
                                <small class="js-url-text">No URL set</small>
                            </div>
                            <div class="node-actions">
                                <button type="button" class="btn btn-sm btn-outline-primary js-up">Up</button>
                                <button type="button" class="btn btn-sm btn-outline-primary js-down">Down</button>
                                <button type="button" class="btn btn-sm btn-outline-primary js-indent">Submenu</button>
                                <button type="button" class="btn btn-sm btn-outline-primary js-outdent">Top Level</button>
                                <button type="button" class="btn btn-sm btn-outline-danger js-remove">Remove</button>
                            </div>
                        </div>
                        <div class="node-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold mb-2">Navigation Label</label>
                                    <input type="text" class="form-control js-name" value="${esc(item.name || '')}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold mb-2">URL</label>
                                    <input type="text" class="form-control js-url" value="${esc(item.url || '')}">
                                </div>
                            </div>
                            <div class="node-meta">
                                <span><strong>Source:</strong> ${esc(item.label || 'Custom link')}</span>
                                <span class="js-parent">Main navigation item</span>
                            </div>
                        </div>
                    </div>
                    <ul class="submenu-list"></ul>
                `;

                (item.submenus || []).forEach((submenu) => childList(li).appendChild(createItem(submenu)));
                syncItem(li);
                return li;
            }

            function addSourceItems(button) {
                const details = button.closest('details');
                details.querySelectorAll('.js-source:checked').forEach((input) => {
                    root.appendChild(createItem({
                        name: input.dataset.name,
                        url: input.dataset.url,
                        label: input.dataset.label,
                        submenus: []
                    }));
                    input.checked = false;
                });
                refresh();
            }

            function addCustomLink() {
                if (!customTitle.value.trim() || !customUrl.value.trim()) {
                    customError.classList.remove('d-none');
                    return;
                }
                customError.classList.add('d-none');
                root.appendChild(createItem({ name: customTitle.value.trim(), url: customUrl.value.trim(), label: 'Custom link', submenus: [] }));
                customTitle.value = '';
                customUrl.value = '';
                refresh();
            }

            function serialize() {
                hidden.innerHTML = '';
                const append = (name, value) => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = name;
                    input.value = value || '';
                    hidden.appendChild(input);
                };

                Array.from(root.children).forEach((item, index) => {
                    append(`menu_items[${index}][id]`, item.dataset.id);
                    append(`menu_items[${index}][name]`, item.querySelector('.js-name').value.trim());
                    append(`menu_items[${index}][url]`, item.querySelector('.js-url').value.trim());
                    append(`menu_items[${index}][sort_order]`, index);

                    Array.from(childList(item).children).forEach((submenu, subIndex) => {
                        append(`menu_items[${index}][submenus][${subIndex}][id]`, submenu.dataset.id);
                        append(`menu_items[${index}][submenus][${subIndex}][name]`, submenu.querySelector('.js-name').value.trim());
                        append(`menu_items[${index}][submenus][${subIndex}][url]`, submenu.querySelector('.js-url').value.trim());
                        append(`menu_items[${index}][submenus][${subIndex}][sort_order]`, subIndex);
                    });
                });
            }

            initialItems.forEach((item) => root.appendChild(createItem(item)));
            refresh();

            document.querySelectorAll('.js-add-selected').forEach((button) => button.addEventListener('click', () => addSourceItems(button)));
            document.getElementById('addCustomLink').addEventListener('click', addCustomLink);

            root.addEventListener('click', function(event) {
                const button = event.target.closest('button');
                const item = event.target.closest('li');
                if (!button || !item) return;

                if (button.classList.contains('js-up') && item.previousElementSibling) {
                    item.parentElement.insertBefore(item, item.previousElementSibling);
                } else if (button.classList.contains('js-down') && item.nextElementSibling) {
                    item.parentElement.insertBefore(item.nextElementSibling, item);
                } else if (button.classList.contains('js-indent') && !isSubmenu(item) && item.previousElementSibling) {
                    childList(item.previousElementSibling).appendChild(item);
                } else if (button.classList.contains('js-outdent') && isSubmenu(item)) {
                    const parent = item.parentElement.closest('li');
                    parent.parentElement.insertBefore(item, parent.nextElementSibling);
                } else if (button.classList.contains('js-remove')) {
                    const list = item.parentElement;
                    const next = item.nextElementSibling;
                    Array.from(childList(item).children).forEach((child) => list.insertBefore(child, next));
                    item.remove();
                }

                refresh();
            });

            root.addEventListener('input', function(event) {
                const item = event.target.closest('li');
                if (item) refresh();
            });

            form.addEventListener('submit', serialize);
        });
    </script>
@endsection
