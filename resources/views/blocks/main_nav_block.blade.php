<nav id="{{ $id }}" class="main-nav navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar{{ ucfirst($id) }}" aria-controls="navbar{{ ucfirst($id) }}" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar{{ ucfirst($id) }}">
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
