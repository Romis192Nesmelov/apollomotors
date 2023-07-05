<nav id="{{ $id }}" class="main-nav navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-{{ $id }}" aria-controls="navbar-{{ $id }}" aria-expanded="false" aria-label="Переключатель навигации">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-{{ $id }}">
            <ul class="navbar-nav m-auto">
                @foreach($menu as $menuItemKey => $menuItem)
                    @if ($useHome || $menuItemKey != 'home')
                        @include('blocks.nav-item_block')
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>
