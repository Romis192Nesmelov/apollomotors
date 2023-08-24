@if (!$record->time)
    @include('admin.blocks.records.not_defined_label_block')
@else
    {{ $record->time }}
@endif
