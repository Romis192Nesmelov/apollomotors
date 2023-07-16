<x-table class="simple">
    @include('issues.blocks.repair_table.table_list_repair_head_block')
    @foreach($price as $item)
        @include('issues.blocks.repair_table.table_list_repair_item_block')
    @endforeach
</x-table>
