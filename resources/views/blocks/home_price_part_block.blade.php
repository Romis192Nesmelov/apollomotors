<ul class="price col-xs-12 col-lg-6">
    @for ($i=$start;$i<$end;$i++)
        @if ($brand->prices[$i]->active)
            @include('blocks.price_item_block',[
                'name' => $brand->prices[$i]->name,
                'value' => $brand->prices[$i]->value
            ])
        @endif
    @endfor
</ul>
