<tr>
    @for ($i=0;$i<=10;$i++)
        <th>{!! $i ? $text.'-'.$i : '' !!}</th>
    @endfor
</tr>
