<table class="action-announce">
    <tr>
        <td class="action-image">
            <div class="action-image image">
                <img title="{{ $action->head }}" src="{{ asset($action->image_small) }}" />
            </div>
            <h3 class="w-100 text-center mt-3">@include('blocks.action_text_block')</h3>
        </td>
    </tr>
    <tr>
    <tr>
        <td class="button-cell text-center">
            <p class="w-100 text-center">{{ trans('content.the_promotion_is_valid_until',['date' => date('d.m.Y', $action->limit)]) }}</p>
            <a href="{{ route('actions',$action->slug) }}">
                @include('blocks.button_block',[
                    'addClass' => 'mb-3',
                    'primary' => false,
                    'buttonText' => trans('content.details')
                ])
            </a>
        </td>
    </tr>
    </tr>
    <tr>
        <td class="button-cell">@include('blocks.action_button_block')</td>
    </tr>
</table>
