<td class="text-center image">
    <a href="{{ isset($item->image_full) ? asset($item->image_full) : asset($item[$column]) }}" class="fancybox">
        <img src="{{ isset($column_preview) ? asset($item[$column_preview]) : asset($item[$column]) }}" />
    </a>
</td>
