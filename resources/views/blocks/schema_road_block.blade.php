<table class="schema-road">
    @foreach($roads as $k => $road)
        <tr>
            <td class="hidden-sm hidden-xs">
                @include('blocks.fancybox_block',[
                    'image' => 'storage/images/maps/'.$road['image'].'_panorama.jpg',
                    'preview' => 'storage/images/maps/'.$road['image'].'_preview.jpg',
                    'addClass' => 'col-md-12 framed-image'
                ])
            </td>
            <td><span>{{ $k+1 }}.</span> {{ $road['description'] }}</td>
        </tr>
    @endforeach
    @foreach($uCount as $count)
        @include('blocks.maps_universal'.$count.'_block')
    @endforeach
</table>
