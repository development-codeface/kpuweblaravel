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
                'url' => route('Specialities.index', ['department_id' => $department->id], false),
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
        .menu-builder .builder-card {
            border: 1px solid #dbe5f0;
            border-radius: 16px;
            box-shadow: 0 16px 36px rgba(18, 38, 63, .08);
        }

        .menu-builder .hero {
            padding: 24px;
            margin-bottom: 20px;
            display: flex;
            gap: 16px;
            justify-content: space-between;
            align-items: start;
        }

        .menu-builder .hero p {
            margin: 0;
            color: #5e7389;
        }

        .menu-builder .hero small {
            color: #0d6efd;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .menu-builder .hero h2 {
            margin: 8px 0 10px;
            color: #12314f;
            font-weight: 700;
        }

        .menu-builder .panel {
            padding: 20px;
            background: #fff;
        }

        .menu-builder details {
            border: 1px solid #dbe5f0;
            border-radius: 14px;
            background: #f8fbff;
            margin-bottom: 12px;
        }

        .menu-builder summary {
            cursor: pointer;
            list-style: none;
            padding: 14px 16px;
            font-weight: 700;
            color: #17314b;
            display: flex;
            justify-content: space-between;
        }

        .menu-builder summary::-webkit-details-marker {
            display: none;
        }

        .menu-builder .source-body {
            padding: 0 16px 16px;
        }

        .menu-builder .source-list {
            max-height: 260px;
            overflow: auto;
        }

        .menu-builder .source-option {
            display: flex;
            gap: 10px;
            padding: 10px 12px;
            border: 1px solid #dbe5f0;
            border-radius: 12px;
            background: #fff;
            margin-bottom: 10px;
        }

        .menu-builder .source-option span small {
            display: block;
            color: #6b7d90;
            margin-top: 2px;
        }

        .menu-builder .structure-note {
            padding: 14px 16px;
            border-radius: 12px;
            background: #eaf3ff;
            color: #2d5f92;
            margin-bottom: 16px;
            line-height: 1.6;
        }

        .menu-builder .structure-empty {
            padding: 24px;
            border: 1px dashed #c9d7e6;
            border-radius: 14px;
            background: #f8fbff;
            color: #6b7d90;
            text-align: center;
        }

        .menu-builder .structure-list,
        .menu-builder .submenu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-builder .structure-list > li,
        .menu-builder .submenu-list > li {
            margin-top: 10px;
        }

        .menu-builder .submenu-list {
            min-height: 8px;
        }

        .menu-builder .menu-node {
            border: 1px solid #dbe5f0;
            border-radius: 14px;
            background: #fff;
            overflow: hidden;
        }

        .menu-builder .node-head {
            padding: 12px 14px;
            background: linear-gradient(180deg, #fff 0%, #f8fbff 100%);
            display: flex;
            gap: 12px;
            justify-content: space-between;
            align-items: center;
            cursor: grab;
            user-select: none;
        }

        .menu-builder .node-head:active {
            cursor: grabbing;
        }

        .menu-builder .node-head-main {
            display: flex;
            gap: 14px;
            align-items: center;
            min-width: 0;
            flex: 1;
        }

        .menu-builder .node-head-meta {
            min-width: 0;
            flex: 1;
        }

        .menu-builder .node-head strong,
        .menu-builder .node-head small {
            display: block;
        }

        .menu-builder .node-head strong {
            color: #17314b;
            word-break: break-word;
        }

        .menu-builder .node-head small,
        .menu-builder .node-meta,
        .menu-builder .submenu-drop {
            color: #6b7d90;
        }

        .menu-builder .node-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            background: #eaf3ff;
            color: #0d6efd;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .menu-builder .node-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: end;
            align-items: center;
        }

        .menu-builder .node-handle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border: 1px dashed #bad0ea;
            border-radius: 12px;
            background: #fff;
            color: #56718f;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .menu-builder .node-toggle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #dbe5f0;
            border-radius: 10px;
            background: #fff;
            color: #4f6985;
            font-size: 12px;
            font-weight: 700;
            padding: 8px 12px;
        }

        .menu-builder .node-toggle i {
            transition: transform .2s ease;
        }

        .menu-builder .menu-item.is-open .node-toggle i {
            transform: rotate(180deg);
        }

        .menu-builder .node-body {
            display: none;
            padding: 14px;
            border-top: 1px solid #dbe5f0;
        }

        .menu-builder .menu-item.is-open .node-body {
            display: block;
        }

        .menu-builder .node-meta {
            margin-top: 10px;
            font-size: 12px;
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .menu-builder .submenu-wrap {
            display: none;
            padding: 0 14px 12px 54px;
        }

        .menu-builder .submenu-label {
            margin-bottom: 6px;
            font-size: 11px;
            font-weight: 700;
            color: #33506d;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .menu-builder .submenu-drop {
            border: 1px dashed #c9d7e6;
            border-radius: 12px;
            background: #f8fbff;
            padding: 8px 10px;
            font-size: 12px;
        }

        .menu-builder .drop-target {
            border-color: #74a9f7 !important;
            background: #edf5ff !important;
        }

        .menu-builder .is-submenu .submenu-wrap {
            display: none;
        }

        .menu-builder .menu-item.has-children:not(.is-submenu) .submenu-wrap,
        .menu-builder .menu-item.submenu-drop-active:not(.is-submenu) .submenu-wrap,
        .menu-builder .menu-item.is-open:not(.is-submenu) .submenu-wrap {
            display: block;
        }

        .menu-builder .menu-item.dragging {
            opacity: .55;
        }

        .menu-builder .footer-box {
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-top: 20px;
        }

        @media (max-width: 991.98px) {
            .menu-builder .hero,
            .menu-builder .footer-box,
            .menu-builder .node-head {
                flex-direction: column;
            }

            .menu-builder .hero .btn,
            .menu-builder .footer-box .btn {
                width: 100%;
            }

            .menu-builder .node-actions {
                justify-content: start;
            }
        }
    </style>

    <div class="menu-builder">
        <form method="POST" action="{{ route('admin.menus.save') }}" id="menuBuilderForm">
            @csrf
            <input type="hidden" name="location_id" value="{{ $menu->id }}">

            <div class="builder-card hero bg-white">
                <div>
                    <small>Appearance / Menus</small>
                    <h2>Build "{{ $menu->name }}"</h2>
                    <p>Add pages, departments, and custom links from the left, then drag menu items into position on the right.</p>
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
                        <div class="structure-note">
                            Drag by the handle to change order. Open an item only when you need to edit it. Drop under a parent item to make it a submenu.
                        </div>
                        <div class="structure-empty" id="menuEmpty">Your menu is empty. Add items from the left panel.</div>
                        <ul class="structure-list js-sort-container" data-level="root" id="menuRoot"></ul>
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
            let draggedItem = null;
            let activeDropTarget = null;

            const esc = (value) => String(value || '').replace(/[&<>"']/g, (char) => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[char]));

            const childList = (item) => item.querySelector('.submenu-list');
            const submenuNote = (item) => item.querySelector('.js-submenu-note');
            const isSubmenu = (item) => item.parentElement && item.parentElement.classList.contains('submenu-list');
            const hasChildren = (item) => !!childList(item).children.length;

            function syncItem(item) {
                const name = item.querySelector('.js-name').value.trim() || 'Untitled item';
                const url = item.querySelector('.js-url').value.trim() || 'No URL set';
                const parent = isSubmenu(item) ? item.parentElement.closest('.menu-item') : null;

                item.classList.toggle('is-submenu', isSubmenu(item));
                item.classList.toggle('has-children', hasChildren(item));
                item.querySelector('.js-title').textContent = name;
                item.querySelector('.js-url-text').textContent = url;
                item.querySelector('.js-level').textContent = isSubmenu(item) ? 'Submenu' : 'Top level';
                item.querySelector('.js-toggle-details').setAttribute('aria-expanded', item.classList.contains('is-open') ? 'true' : 'false');
                item.querySelector('.js-parent').textContent = parent ?
                    `Child of "${parent.querySelector('.js-name').value.trim() || 'Untitled item'}"` :
                    'Main navigation item';

                if (!isSubmenu(item)) {
                    submenuNote(item).textContent = hasChildren(item) ?
                        'Drop another menu item here to add more submenus.' :
                        'Drop a menu item here to make it a submenu.';
                }
            }

            function refresh() {
                root.querySelectorAll('.menu-item').forEach(syncItem);
                empty.classList.toggle('d-none', !!root.children.length);
            }

            function createItem(item) {
                const li = document.createElement('li');
                li.className = 'menu-item';
                li.dataset.id = item.id || '';
                li.innerHTML = `
                    <div class="menu-node">
                        <div class="node-head js-drag-handle" draggable="true">
                            <div class="node-head-main">
                                <span class="node-handle">
                                    <i class="fas fa-grip-vertical"></i>
                                    Drag
                                </span>
                                <div class="node-head-meta">
                                    <span class="node-badge js-level">Top level</span>
                                    <strong class="js-title">Untitled item</strong>
                                    <small><span class="js-source-inline">${esc(item.label || 'Custom link')}</span> / <span class="js-url-text">No URL set</span></small>
                                </div>
                            </div>
                            <div class="node-actions">
                                <button type="button" class="node-toggle js-toggle-details" aria-expanded="false">
                                    Edit
                                    <i class="fas fa-chevron-down"></i>
                                </button>
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
                                <span><strong>Source:</strong> <span class="js-source-label">${esc(item.label || 'Custom link')}</span></span>
                                <span class="js-parent">Main navigation item</span>
                            </div>
                        </div>
                        <div class="submenu-wrap">
                            <div class="submenu-label">Submenu Drop Area</div>
                            <div class="submenu-drop js-submenu-note">Drop a menu item here to make it a submenu.</div>
                            <ul class="submenu-list js-sort-container" data-level="submenu"></ul>
                        </div>
                    </div>
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
                root.appendChild(createItem({
                    name: customTitle.value.trim(),
                    url: customUrl.value.trim(),
                    label: 'Custom link',
                    submenus: []
                }));
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

            function setActiveDropTarget(container) {
                if (activeDropTarget && activeDropTarget !== container) {
                    activeDropTarget.classList.remove('drop-target');
                    const previousParentItem = activeDropTarget.closest('.menu-item');
                    if (previousParentItem) {
                        previousParentItem.classList.remove('submenu-drop-active');
                    }
                }

                activeDropTarget = container;

                if (activeDropTarget) {
                    activeDropTarget.classList.add('drop-target');
                    const parentItem = activeDropTarget.closest('.menu-item');
                    if (parentItem) {
                        parentItem.classList.add('submenu-drop-active');
                    }
                }
            }

            function clearActiveDropTarget() {
                if (activeDropTarget) {
                    activeDropTarget.classList.remove('drop-target');
                    const parentItem = activeDropTarget.closest('.menu-item');
                    if (parentItem) {
                        parentItem.classList.remove('submenu-drop-active');
                    }
                }

                activeDropTarget = null;
            }

            function getDragAfterElement(container, y) {
                const items = [...container.querySelectorAll(':scope > .menu-item:not(.dragging)')];

                return items.reduce((closest, child) => {
                    const box = child.getBoundingClientRect();
                    const offset = y - box.top - box.height / 2;

                    if (offset < 0 && offset > closest.offset) {
                        return {
                            offset,
                            element: child
                        };
                    }

                    return closest;
                }, {
                    offset: Number.NEGATIVE_INFINITY,
                    element: null
                }).element;
            }

            function canDropInContainer(container) {
                if (!draggedItem || !container) {
                    return false;
                }

                if (container.contains(draggedItem) && container === childList(draggedItem)) {
                    return false;
                }

                if (draggedItem.contains(container)) {
                    return false;
                }

                if (container.dataset.level === 'root') {
                    return true;
                }

                const parentItem = container.closest('.menu-item');

                if (!parentItem || isSubmenu(parentItem) || parentItem === draggedItem) {
                    return false;
                }

                if (hasChildren(draggedItem)) {
                    return false;
                }

                return true;
            }

            initialItems.forEach((item) => root.appendChild(createItem(item)));
            refresh();

            document.querySelectorAll('.js-add-selected').forEach((button) => {
                button.addEventListener('click', () => addSourceItems(button));
            });

            document.getElementById('addCustomLink').addEventListener('click', addCustomLink);

            root.addEventListener('click', function(event) {
                const toggleButton = event.target.closest('.js-toggle-details');
                const removeButton = event.target.closest('.js-remove');
                const item = event.target.closest('.menu-item');

                if (toggleButton && item) {
                    item.classList.toggle('is-open');
                    toggleButton.setAttribute('aria-expanded', item.classList.contains('is-open') ? 'true' : 'false');
                    refresh();
                    return;
                }

                if (!removeButton || !item) {
                    return;
                }

                const list = item.parentElement;
                const next = item.nextElementSibling;

                Array.from(childList(item).children).forEach((child) => {
                    list.insertBefore(child, next);
                });

                item.remove();
                refresh();
            });

            root.addEventListener('input', function(event) {
                const item = event.target.closest('.menu-item');

                if (item) {
                    refresh();
                }
            });

            root.addEventListener('dragstart', function(event) {
                const handle = event.target.closest('.js-drag-handle');

                if (!handle) {
                    return;
                }

                draggedItem = handle.closest('.menu-item');

                if (!draggedItem) {
                    return;
                }

                event.dataTransfer.effectAllowed = 'move';
                event.dataTransfer.setData('text/plain', draggedItem.dataset.id || 'menu-item');

                requestAnimationFrame(() => draggedItem.classList.add('dragging'));
            });

            root.addEventListener('dragend', function() {
                if (draggedItem) {
                    draggedItem.classList.remove('dragging');
                }

                draggedItem = null;
                clearActiveDropTarget();
                refresh();
            });

            document.addEventListener('dragover', function(event) {
                const container = event.target.closest('.js-sort-container');

                if (!canDropInContainer(container)) {
                    return;
                }

                event.preventDefault();
                setActiveDropTarget(container);

                const afterElement = getDragAfterElement(container, event.clientY);

                if (!afterElement) {
                    container.appendChild(draggedItem);
                } else {
                    container.insertBefore(draggedItem, afterElement);
                }
            });

            document.addEventListener('drop', function(event) {
                if (!draggedItem) {
                    return;
                }

                event.preventDefault();
                clearActiveDropTarget();
                refresh();
            });

            form.addEventListener('submit', serialize);
        });
    </script>
@endsection
