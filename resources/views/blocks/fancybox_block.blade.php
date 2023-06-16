<div class="image{{ isset($addClass) && $addClass ? ' '.$addClass : '' }}">
    <i class="icon-search4 {{ isset($iconBlack) && $iconBlack ? 'black' : '' }}"></i>
    <a class="fancybox" href="{{ asset($image) }}"><img src="{{ asset(isset($preview) &&  $preview ? $preview : $image) }}" {{ isset($title) ? 'title='.$title : '' }} /></a>
</div>
