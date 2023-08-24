<script>
    window.statisticsData.push({
        legend:[],
        dataHorAxis:[],
        chartId:"{{ $chartId }}"
    });

    var xAxis = [],
        xAxisData = [];
</script>
@for ($i=$startPos-1;$i<$endPos;$i++)
    <script>
        xAxis.push(window.allMonths[parseInt("{{ $i }}")]);
        xAxisData.push(0);
    </script>
@endfor

@foreach($legend as $item)
    <script>
        window.statisticsData[window.statisticsData.length-1].legend.push("{{ $item }}");
        window.statisticsData[window.statisticsData.length-1].dataHorAxis.push({
            name: "{{ $item }}",
            type: 'line',
            data: cloneArrayData(xAxisData)
        });
    </script>
@endforeach

@if (!isset($withOutChart) || !$withOutChart)
    <div class="chart-container">
        <div class="chart has-fixed-height" id="{{ $chartId }}"></div>
    </div>
@endif