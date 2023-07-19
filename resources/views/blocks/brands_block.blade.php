<x-section>
    <div id="brands-block" class="owl-carousel{{ isset($addClass) && $addClass ? ' '.$addClass : '' }}">
        @foreach ($brands as $brand)
            <a brand="{{ $brand->slug }}" href="#"><img class="w-75 m-auto" title="{{ $brand->name_ru }}" src="{{ asset($brand->logo) }}" /></a>
        @endforeach
    </div>
</x-section>
