<div class="panel panel-flat">
    <div class="panel-body">
        <table class="table table-striped table-items">
            <tr>
                <th class="text-center w-25">{{ trans('admin.name') }}</th>
                @include('admin.blocks.th_edit_cell_block')
            </tr>
            @foreach ($parts as $part)
                <tr>
                    <td class="text-left">{{ trans('admin.'.$part_name.'_'.$part) }}</td>
                    @include('admin.blocks.edit_cell_block', [
                        'href' => route('admin.'.$part_name.'_'.$part, [
                            'id' => $item->id,
                            'parent_id' => Request::has('parent_id') ? Request::input('parent_id') : null
                        ])
                    ])
                </tr>
            @endforeach
        </table>
    </div>
</div>
