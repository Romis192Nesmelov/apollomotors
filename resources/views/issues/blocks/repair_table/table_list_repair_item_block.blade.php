<tr>
    <td>
        @php
        $routeAttr = [];

        if (isset($car) && $car) $routeAttr[] = $car->brand->slug;
        elseif (isset($brand) && $brand) $routeAttr[] = $brand->slug;

        if (isset($car) && $car) $routeAttr[] = $car->slug;

        $routeAttr[] = $item->slug;
        @endphp
        <a href="{{ route('repair',$routeAttr) }}">
            @include('issues.blocks.table_list_name_block')
        </a>
    </td>
    <td class="price">@include('issues.blocks.table_list_price_block', ['price_from' => $item->price_from, 'price' => $item->price])</td>
</tr>
