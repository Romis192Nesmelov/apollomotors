<div class="panel panel-flat">
    <div class="panel-body">
        <table class="table table-striped table-items">
            <tr>
                <th class="text-center w-25">{{ trans('admin.name') }}</th>
                @include('admin.blocks.th_edit_cell_block')
            </tr>
            @foreach ($parts as $part)
                <tr>
                    <td class="text-left">{{ trans('admin.brand_'.$part) }}</td>
                    @include('admin.blocks.edit_cell_block', ['href' => route('admin.brand_'.$part, ['id' => $item->id])])
                </tr>
            @endforeach
        </table>
    </div>
</div>
