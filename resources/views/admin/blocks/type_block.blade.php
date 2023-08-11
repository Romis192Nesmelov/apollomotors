@switch($item->type)
    @case(1)
        <div class="label label-warning">
        @break
    @case(2)
        <div class="label label-info">
        @break
    @case(3)
        <div class="label label-success">
        @break
@endswitch
{{ trans('admin.'.$item->getTable().$item->type) }}</div>
