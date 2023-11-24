<div class="action" style="background: url({{ asset($action->image) }}) center;">
    <a href="{{ route('actions',$action->slug) }}">
        <table>
            <tr>
                <td>
                    @if (isset($useCounter) && $useCounter)
                        @include('actions.blocks.counter_block',['time' => $action->limit])
                    @else
                        <h1>@include('blocks.action_text_block')</h1>
                        <p>{{ trans('content.up_to').' '.date('d.m.Y', $action->limit) }}</p>
                    @endif
                </td>
            </tr>
    {{--        <tr>--}}
    {{--            <td class="action-button-cell">@include('blocks.action_button_block')</td>--}}
    {{--        </tr>--}}
        </table>
    </a>
</div>
