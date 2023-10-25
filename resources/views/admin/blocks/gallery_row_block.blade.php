<tr>
    <td class="hidden"></td>
    <td class="id"><i class="{{ $isFile ? 'icon-file-empty' : 'icon-folder'}}"></i></td>
    <td class="image {{ !$isFile ? 'text-uppercase' : '' }}">
        @if (!$isFile)
            <a href="{{ $route.pathinfo($object)['basename'] }}"><b>{{ pathinfo($object)['basename'] }}</b></a>
        @else
            <a class="fancybox" href="{{ asset(str_replace(base_path('public'),'',$object)) }}">
                <img src="{{ asset(str_replace(base_path('public'),'',$object)) }}" />
            </a>
        @endif
    </td>
    <td class="text-center image-path">@if ($isFile){{ str_replace(base_path('public'),'',$object) }}@endif</td>
    <td class="text-center cb-copy">
        @if ($isFile)
            <i class="icon-copy3"></i>
        @endif
    </td>
    @if ($isFile && Gate::allows('delete') && !$lock)
        @include('admin.blocks.delete_cell_block',['id' => str_replace(base_path('public'),'',$object)])
    @else
        <td></td>
    @endif
</tr>
