<div class="panel-body">
    <table class="table datatable-basic table-items">
        <tr>
            @if (count($columns) == 3)
                @include('admin.blocks.th_id_cell_block')
            @endif
            @foreach ($columns as $column)
                @if ($column == 'slug' && $slugMode)
                    <th class="text-center">{{ trans('admin.title') }}</th>
                @elseif (strpos($column, 'image') !== false)
                    <th class="text-center">{{ trans('admin.image') }}</th>
                @elseif ($column == 'created_at')
                    @include('admin.blocks.th_created_at_cell_block')
                @elseif ($column == 'updated_at')
                    @include('admin.blocks.th_updated_at_cell_block')
                @else
                    <th class="text-center">{{ trans('admin.'.$column) }}</th>
                @endif
            @endforeach
            @include('admin.blocks.th_edit_cell_block')
            @include('admin.blocks.th_delete_cell_block')
        </tr>
        @foreach ($items as $item)
            <tr role="row">
                @if (count($columns) == 3)
                    <td class="id">{{ $item->id }}</td>
                @endif
                @foreach ($columns as $column)
                    @if ($column == 'slug' && $slugMode)
                        <td class="text-left">{{ trans('admin.'.$item->slug) }}</td>
                    @elseif (strpos($column, 'image') !== false)
                        <td class="text-center image">
                            <a href="{{ isset($item->image_full) ? asset($item->image_full) : asset($item[$column]) }}" class="fancybox">
                                <img src="{{ asset($item[$column]) }}" />
                            </a>
                        </td>
                    @elseif ($column == 'icon')
                        <td class="text-center"><i class="{{ $item->icon }}"></i></td>
                    @elseif ($column == 'parent_brand')
                        <td class="text-center w-25"><img class="w-100" src="{{ asset($item->brand->logo) }}" /></td>
                    @elseif ($column == 'active')
                        <td class="text-center w-25">@include('admin.blocks.active_status_block', ['active' => $item->active])</td>
                    @elseif ($column == 'type')
                        <td class="text-center">@include('admin.blocks.type_block')</td>
                    @elseif ($column == 'text' || $column == 'answer')
                        <td class="text-left">@include('blocks.cropped_content_block',['content' => $item[$column], 'length' => 300])</td>
                    @else
                        <td class="text-center {{ ($column == 'email' || $column == 'head' || $column == 'name') ? 'head' : '' }}">{{ $item[$column] }}</td>
                    @endif
                @endforeach
                @include('admin.blocks.edit_cell_block', ['href' => isset($route) ? route('admin.'.$route, ['id' => $item->id, 'parent_id' => (isset($parentId) && $parentId ? $parentId : '')]) : route($menu[$menu_key]['href'], ['id' => $item->id])])
                @if ($deleteMode)
                    @include('admin.blocks.delete_cell_block',['id' => $item->id])
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
    </table>
</div>
@if ($addMode)
    <div class="panel-body">
        @include('admin.blocks.add_button_block',[
            'href' => isset($route) ? route('admin.'.$route).'/add'.(isset($parentId) && $parentId ? '?parent_id='.$parentId : '') : route($menu[$menu_key]['href']).'/add',
            'text' => trans('admin.add_'.$menu_key)
        ])
    </div>
@endif
