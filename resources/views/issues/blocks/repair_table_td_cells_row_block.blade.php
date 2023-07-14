<tr>
    @for ($i=0;$i<=10;$i++)
        <td {{ $i ? 'class=price' : '' }}>{!! $i ? (!isset($cellsToSkip) || !in_array($i, $cellsToSkip) ? '✔' : '') : $text !!}</td>
    @endfor
</tr>
