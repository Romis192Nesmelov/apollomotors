<div {{ $attributes->class('modal fade') }} id="{{ $attributes->get('id') }}" tabindex="-1" aria-labelledby="{{ $attributes->get('id') }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if ($attributes->has('head'))
                    <h2 class="modal-title fs-5">{{ $attributes->get('head') }}</h2>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ trans('content.close') }}"></button>
            </div>
            {{ $slot }}
            @if ($attributes->has('footer') && $attributes->get('footer'))
                <div class="modal-footer">
                    @include('blocks.button_block',[
                        'primary' => true,
                        'dataDismiss' => true,
                        'addClass' => 'm-auto mt-3',
                        'buttonText' => trans('content.close')
                    ])
                </div>
            @endif
        </div>
    </div>
</div>

