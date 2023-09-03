<x-table class="simple">
    <tr>
        <th class="text-left">{{ trans('content.name') }}</th>
        <th class="text-left">{{ trans('content.part_code') }}</th>
        <th class="text-center">{{ trans('content.price').' '.trans('content.by_original') }} ₽</th>
        <th class="text-center">{{ trans('content.price').' '.trans('content.by_non_original') }} ₽</th>
    </tr>
    @foreach ($spares as $item)
        @include('issues.blocks.spares_table.table_list_spare_item_block')
    @endforeach
</x-table>
