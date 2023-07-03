<tr>
    <td class="hidden-sm hidden-xs">
        @include('blocks.fancybox_block',[
            'image' => 'storage/images/maps/v3_panorama.jpg',
            'preview' => 'storage/images/maps/v3_preview.jpg',
            'addClass' => 'col-md-12 framed-image'
        ])
    </td>
    <td><span>{{ isset($start) ? $start : '3' }}.</span> {{ trans('contacts.universal_route2') }} </td>
</tr>
<tr>
    <td class="hidden-sm hidden-xs">
        @include('blocks.fancybox_block',[
            'image' => 'storage/images/maps/v4_panorama.jpg',
            'preview' => 'storage/images/maps/v4_preview.jpg',
            'addClass' => 'col-md-12 hidden-sm framed-image'
        ])
    </td>
    <td><span>{{ isset($start) ? $start+1 : '4' }}.</span> {!! trans('contacts.universal_route3') !!}</td>
</tr>
<tr>
    <td class="hidden-sm hidden-xs">
        @include('blocks.fancybox_block',[
            'image' => 'storage/images/maps/v5_panorama.jpg',
            'preview' => 'storage/images/maps/v5_preview.jpg',
            'addClass' => 'col-md-12 hidden-sm framed-image'
        ])
    </td>
    <td><span>{{ isset($start) ? $start+2 : '5' }}.</span> {!! trans('contacts.universal_route3') !!}</td>
</tr>
