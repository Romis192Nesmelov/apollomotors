<div class="action" style="background: url({{ asset($action->image) }}) center;">
    <table>
        <tr>
            <td>
                <h1>@include('blocks.action_text_block')</h1>
                <p>{{ trans('content.up_to').' '.date('d.m.Y', $action->limit) }}</p>
            </td>
        </tr>
        <tr>
            <td>@include('blocks.action_button_block')</td>
        </tr>
    </table>
</div>
