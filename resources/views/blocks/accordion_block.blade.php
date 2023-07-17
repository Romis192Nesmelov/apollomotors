<div class="accordion accordion-flush" id="{{ $id }}">
    @foreach ($questions as $k => $item)
        @if ($item->active)
            <x-accordion itemId="question{{ $k }}" parentId="{{ $id }}" icon="fa fa-lightbulb-o" itemHead="{{ $item->question }}">{{ $item->answer }}</x-accordion>
        @endif
    @endforeach
</div>
