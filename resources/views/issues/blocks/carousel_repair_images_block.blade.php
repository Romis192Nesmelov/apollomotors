<div id="repair-images" class="owl-carousel">
    @foreach ($repair->images as $image)
        <div class="framed-image">
            <a class="fancybox" href="{{ asset($image->image) }}"><img src="{{ asset($image->preview) }}" /></a>
        </div>
    @endforeach
</div>
