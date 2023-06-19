<div class="accordion-item">
    <h3 class="accordion-header" id="{{ $attributes->get('itemId') }}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $attributes->get('itemId') }}" aria-expanded="false" aria-controls="collapse{{ $attributes->get('itemId') }}">{!! ($attributes->has('icon') ? '<i class="'.$attributes->get('icon').'"></i> ' : '').$attributes->get('itemHead') !!}</button>
    </h3>
    <div id="collapse{{ $attributes->get('itemId') }}" class="accordion-collapse collapse" aria-labelledby="{{ $attributes->get('itemId') }}" data-bs-parent="#{{ $attributes->get('parentId') }}">
        <div class="accordion-body">{{ $slot }}</div>
    </div>
</div>
