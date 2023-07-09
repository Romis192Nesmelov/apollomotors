<ul class="price col-md-6 col-xs-12">
    @for ($i=$start;$i<$end;$i++)
        @if ($brand->prices[$i]->active)
            <li>
                <div class="job-name">{{ $brand->prices[$i]->name }}</div>
                <div class="dots"><div></div></div>
                <div class="job-price">{{ $brand->prices[$i]->value }} р.</div>
            </li>
        @endif
    @endfor
</ul>
