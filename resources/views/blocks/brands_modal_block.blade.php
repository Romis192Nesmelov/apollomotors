<x-modal id="nav-modal">
    <ul class="navbar-nav m-auto">
        @foreach ($menu as $menuItemKey => $menuItem)
            @if (isset($menuItem['href']) && !$menuItem['href'])
                @include('blocks.nav-item_block', [
                    'id' => 'modal-nav',
                    'nlAddClass' => 'menu-nav'
                ])
            @endif
        @endforeach
    </ul>
</x-modal>
