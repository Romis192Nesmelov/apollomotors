<x-section>
    <h2 class="w-100 text-center">{{ trans('content.in_the_waiting_room_for_each_client') }}</h2>
    @foreach (['fa fa-wifi', 'icon-cup2', 'icon-tv', 'icon-eye'] as $k => $icon)
        @include('blocks.big_icon_block',[
            'colMd' => 3,
            'colSm' => 6,
            'icon' => $icon,
            'iconText' => trans('content.for_each_client_icon'.($k+1))
        ])
    @endforeach
</x-section>
