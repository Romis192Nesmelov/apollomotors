@if (isset($head) && $head)
    <div class="panel-heading">
        <div class="panel-title">{{ $head }}</div>
    </div>
@endif
<div class="panel-body">
    @if (isset($preview) && $preview)
        <a class="fancybox" href="{{ isset($full) ? asset($full) : asset($preview) }}">
            <img src="{{ asset($preview) }}?{{ md5(rand(1,100000)*time()) }}" />
        </a>
    @else
        <img src="{{ asset('storage/images/placeholder.jpg') }}" />
    @endif
</div>