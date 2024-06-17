@extends('layouts.admin')

@section('content')
@include('admin.blocks.records.chart_container_block', [
   'startPos' => 1,
   'endPos' => ($year != date('Y') ? 12 : date('n')),
   'legend' => [
       trans('records.point1'),
       trans('records.point2'),
       trans('records.point3'),
       trans('records.point4'),
       trans('records.point5'),
       trans('records.point6'),
       trans('records.point7')
   ],
   'chartId' => 'records_chart',
   'withOutChart' => true
])
<div class="panel-body">
    @include('admin.blocks.records.years_block')
    <div class="panel panel-flat">
        <h1 class="panel-heading text-center">{{ $year }}</h1>
        <div class="panel-body">
            @include('admin.blocks.add_button_block',[
                'href' => route('admin.records',['slug' => 'add']),
                'text' => trans('records.add_record')
            ])
        </div>
        <div class="panel-body">
            @php $week = 1; @endphp
            @for($month=1;$month<=12;$month++)
                @php
                    $weeksOnMonth = 1;
                    for($d=1;$d<=cal_days_in_month(CAL_GREGORIAN, $month, $year);$d++) {
                        if ($d > 1 && date('N', strtotime($month.'/'.$d.'/'.$year)) == 1) $weeksOnMonth++;
                    }
                @endphp
                <div class="col-md-3 col-sm-4 col-xs-12 records-month">
                    <div class="panel-heading text-center">
                        <h5>{{ trans('timer.m'.$month) }}</h5>
                    </div>
                    <table class="records-calendar">
                        <tr>
                            @for($wd=0;$wd<=7;$wd++)
                                <th>{{ $wd ? trans('timer.'.$wd) : '' }}</th>
                            @endfor
                        </tr>
                        @php $day = 0; @endphp
                        @for($w=1;$w<=$weeksOnMonth;$w++)
                            <tr>
                                @for($wd=0;$wd<=7;$wd++)
                                    @if(!$wd)
                                        <td><b>{{ $week }}</b></td>
                                    @else
                                        @php if ($w == 1 && $wd == date('N', strtotime($month.'/1/'.$year))) $day = 1; @endphp
                                        <td>
                                            @if ($day && $day <= cal_days_in_month(CAL_GREGORIAN, $month, $year))
                                                @php $recordsMatch = false; @endphp
                                                    @foreach ($records as $recordsMonth => $recordsDays)
                                                        @if ($recordsMonth == $month)
                                                            @foreach ($recordsDays as $recordDay => $recordsInDay)
                                                                @if ($recordDay == $day)
                                                                    @php $recordsMatch = $recordsInDay; @endphp
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                            @break
                                                        @endif
                                                    @endforeach
                                                    @php $incrementWeek = true; @endphp

                                                @if ($recordsMatch || $year > date('Y') || ($year == date('Y') && $month > date('n')) || $month == date('n') && ($day >= date('j')))
                                                    @php $recordsCounter = 0; @endphp
                                                    @if ($recordsMatch)
                                                        @foreach($recordsMatch as $record)
                                                            @php $recordsCounter++; @endphp
                                                            @if ($record->point)
                                                                <script>
                                                                    window.statisticsData[0].dataHorAxis[parseInt("{{ $record->point-1 }}")].data[parseInt("{{ $month }}")-1]++;
                                                                </script>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @can('records')
                                                        <a href="{{ url('admin/records?date='.strtotime($month.'/'.$day.'/'.$year)) }}">
                                                            @include('admin.blocks.records.day_records_counter_block')
                                                        </a>
                                                    @else
                                                        @include('admin.blocks.records.day_records_counter_block')
                                                    @endif
                                                @else
                                                    {{ $day }}
                                                @endif
                                            @else
                                                @php $incrementWeek = false; @endphp
                                            @endif
                                        </td>
                                    @endif
                                    @php if ($day && $wd) $day++; @endphp
                                @endfor
                            </tr>
                            @php if ($incrementWeek) $week++; @endphp
                        @endfor
                    </table>
                </div>
            @endfor
        </div>
    </div>
    @include('admin.blocks.records.years_block')
</div>
<div class="panel-body">
    <div class="panel panel-flat">
        <div class="panel-heading"><h1>{{ trans('admin.statistics') }}</h1></div>
        <div class="panel-body">
            <div class="chart-container">
                <div class="chart has-fixed-height" id="records_chart"></div>
            </div>
        </div>
    </div>
</div>

<div class="panel-body">
    <div class="panel panel-flat">
        <div class="panel-heading"><h1>{{ trans('records.idle_mechanics') }}</h1></div>
        <div class="panel-body">
            <table class="idle-mechanics {{ Gate::allows('edit') ? 'edit' : '' }}">
                @for($mech=-1;$mech<count($mechanics);$mech++)
                    <tr>
                        @if ($mech == -1)
                            <th>{{ trans('records.mechanic_name')}}</th>
                        @else
                            <td class="mechanic-name">{{ $mechanics[$mech]->name }}</td>
                        @endif

                        <?php $day = (int)date('d'); $month = (int)date('m'); $year = (int)date('Y'); $dayCount = 1; ?>
                        @for($d=(int)date('d');$d<=(int)date('d')+20;$d++)
                            <?php
                                if ($day > cal_days_in_month(CAL_GREGORIAN, $month, $year)) {
                                    $day = 1;
                                    $month++;
                                    if ($month > 12) {
                                        $year++;
                                        $month = 1;
                                    }
                                }
                                $timestamp = strtotime($month.'/'.$day.'/'.$year);
                                $weekday = date('w',$timestamp);
                            ?>
                            @if ($mech == -1)
                                <th class="{{ $weekday == 6 || !$weekday ? 'text-warning-800' : '' }} {{ $dayCount > 10 ? 'hidden-sm' : '' }} {{ $dayCount > 5 ? 'hidden-xs' : '' }}" >{{ $day }}</th>
                            @else
                                <td date="{{ $timestamp }}" id="{{ $mechanics[$mech]->id }}" class="{{ $dayCount > 10 ? 'hidden-sm' : '' }} {{ $dayCount > 5 ? 'hidden-xs' : '' }}" >
                                    <?php
                                    $missingFlag = false;
                                    foreach($mechanics[$mech]->missingMechanics as $missing) {
                                        if ($missing->date == $timestamp) {
                                            $missingFlag = true;
                                            break;
                                        }
                                    }
                                    ?>
                                    @if ($missingFlag)
                                        <i class="icon-spam text-danger-800"></i>
                                    @else
                                        <i class="icon-checkmark text-success"></i>
                                    @endif
                                </td>
                            @endif
                            <?php $day++; $dayCount++; ?>
                        @endfor
                    </tr>
                @endfor
            </table>
        </div>
    </div>
</div>
@endsection
