<ul class="price col-md-6 col-xs-12">
    @for ($i=$start;$i<$end;$i++)
        <li>
            <div class="job-name">{{ $brand->prices[$i]->name }}</div>
            <div class="dots"><div></div></div>
            <div class="job-price">{{ $brand->prices[$i]->value }} р.</div>
        </li>
    @endfor
</ul>
