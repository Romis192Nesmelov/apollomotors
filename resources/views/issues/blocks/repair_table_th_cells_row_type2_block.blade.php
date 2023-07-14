<tr>
    @for ($i=0;$i<=10;$i++)
        <th>{!! $i ? $i * $factor : $text !!}</th>
    @endfor
</tr>
