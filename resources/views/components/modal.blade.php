<div {{ $attributes->class('modal fade') }} id="{{ $attributes->get('id') }}" tabindex="-1" aria-labelledby="{{ $attributes->get('id') }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5">{{ $attributes->get('head') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ trans('content.close') }}"></button>
            </div>
            {{ $slot }}
{{--            <div class="modal-footer">--}}
{{--                @include('blocks.button_block',[--}}
{{--                    'primary' => false,--}}
{{--                    'dataDismiss' => true,--}}
{{--                    'buttonText' => trans('content.close')--}}
{{--                ])--}}
{{--            </div>--}}
        </div>
    </div>
</div>

