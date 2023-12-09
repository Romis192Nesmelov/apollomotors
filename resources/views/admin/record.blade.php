@extends('layouts.admin')

@section('content')
    @if (count($records))
        <x-modal class="delete-modal" id="delete-modal" head="{{ trans('admin.warning') }}">
            <form action="{{ route('admin.delete_record') }}" method="post">
                @csrf
                @include('admin.blocks.hidden_id_block',['value' => ''])
                <div class="modal-body modal-delete">
                    <h3>{{ trans('records.delete_record') }}</h3>
                </div>
                <div class="modal-footer">
                    @include('blocks.button_block',[
                        'id' => null,
                        'buttonType' => 'submit',
                        'primary' => true,
                        'addClass' => 'm-auto mt-3',
                        'buttonText' => trans('content.yes')
                    ])
                    @include('blocks.button_block',[
                        'id' => null,
                        'primary' => true,
                        'dataDismiss' => true,
                        'addClass' => 'm-auto mt-3',
                        'buttonText' => trans('content.no')
                    ])
                </div>
            </form>
        </x-modal>
    @endif
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ trans('records.records_by').date('j',$date).' '.trans('timer.'.date('m',$date).'_r').' '.date('Y',$date).trans('timer.year') }}</h4>
            <h5>{{ trans('records.mechanics') }}: {{ count($mechanics) - count($missing_mechanics) }}</h5>
        </div>
        <?php $mCount = 0; ?>
        <div class="panel-body">
            <div class="col-md-2 col-sm-3 col-xs-12">
                @foreach($mechanics as $mechanic)
                    <div class="mechanic"><span class="label label-{{ in_array($mechanic->id, $missing_mechanics) ? 'warning' : 'success' }}">{{ $mechanic->name }}</span></div>
                    <?php $mCount++; ?>
                    @if ($mCount == 3)
                        <?php $mCount = 0; ?>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-12">
                    @endif
                @endforeach
            </div>
        </div>
        <div class="panel-body">
            <div class="big-table-container">
                <table class="records hidden-xs">
                    <tr>
                        @for($t=0;$t<count($times)-1;$t++)
                            <th class="text-center">{{ !$t ? '' : $times[$t].'-'.$times[$t+1] }}</th>
                        @endfor
                    </tr>
                    @for($r=0;$r<7;$r++)
                        <?php $mergingCells = 0; ?>
                        <tr>
                            @for($t=0;$t<count($times)-1;$t++)
                                @if (!$t)
                                    <td class="point {{ $r > 3 ? 'sub-point' : '' }}">{{ trans('records.point'.($r+1)) }}</td>
                                @else
                                    @php
                                        $currentRecord = null;
                                        if (count($records)) {
                                            foreach ($records as $recordItem) {
                                                if ($recordItem->time == $times[$t] && $recordItem->point == ($r+1) && $recordItem->status != 5) {
                                                    $currentRecord = $recordItem;
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp
                                    @if (!$currentRecord && !$mergingCells)
                                        <td>
                                            @if (strtotime(date('m').'/'.date('d').'/'.date('Y')) <= $date)
                                                <a href="{{ route('admin.records', ['slug' => 'add', 'date' => $date, 'time' => $times[$t], 'point' => ($r+1)]) }}#record">{{ trans('records.record_open') }}</a>
                                            @else
                                                {{ trans('records.record_forbidden') }}
                                            @endif
                                        </td>
                                    @elseif (!$mergingCells)
                                        @php
                                            $durationParts = explode(':',$currentRecord->duration);
                                            $mergingCells = (int)$durationParts[0] * 2;
                                            $mergingCells += ($durationParts[1] == '30' ? 1 : 0);
                                            list($label, $status) = getRecordLabelAndStatus($currentRecord);
                                        @endphp
                                        <td {{ $mergingCells > 1 ? 'colspan='.$mergingCells : '' }} class="record label-{{ $label }}">
                                            @can('edit')
                                                <div class="record_{{ $currentRecord->id }}">
                                                    <a title="{{ $currentRecord->title.' '.$currentRecord->email.' '.($currentRecord->phone ? $currentRecord->phone : '').' '.($currentRecord->name ? $currentRecord->name : '') }}" href="{{ route('admin.records', ['id' => $currentRecord->id]) }}#record">
                                                        @include('admin.blocks.records.table_record_cell_block', ['record' => $currentRecord])
                                                    </a>
                                                </div>
                                            @else
                                                @include('admin.blocks.records.table_record_cell_block', ['record' => $currentRecord])
                                            @endcan
                                        </td>
                                    @endif
                                    @if ($mergingCells)
                                        <?php $mergingCells--; ?>
                                    @endif
                                @endif
                            @endfor
                        </tr>
                    @endfor
                </table>
            </div>
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">{{ trans('records.record_time') }}</th>
                    <th class="text-center">{!! trans('records.record_post').'&<br>'.trans('records.record_title') !!}</th>
                    <th class="text-center">{{ trans('records.brand_and_car') }}</th>
                    <th class="text-center">{{ trans('records.record_user_creds') }}</th>
                    <th class="text-center">{{ trans('records.status') }}/<br>{{ trans('records.record_made_by') }}</th>
                    @include('admin.blocks.th_delete_cell_block')
                </tr>
                @foreach($records as $currentRecord)
                    <tr id="record_{{ $currentRecord->id }}">
                        <td class="text-center bigger">
                            @can('owner', $currentRecord)
                                <a href="{{ route('admin.records', ['id' => $currentRecord->id]) }}">
                                    @include('admin.blocks.records.table_record_item_block',['record' => $currentRecord])
                                </a>
                            @else
                                @include('admin.blocks.records.table_record_item_block',['record' => $currentRecord])
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="bigger">
                                @if (!$currentRecord->point)
                                    @include('admin.blocks.records.not_defined_label_block')
                                @else
                                    {{ trans('records.point'.$currentRecord->point) }}
                                @endif
                            </div>
                            {{ $currentRecord->title }}
                        </td>
                        <td class="text-center">
                            <img width="50" src="{{ $currentRecord->car_id ? asset($currentRecord->carLink->image_preview) : asset('storage/images/car_placeholder.jpg') }}"><br>
                            <b>{{ $currentRecord->car_id ? ucfirst($currentRecord->carLink->brand['name_'.app()->getLocale()]).' '.$currentRecord['name_'.app()->getLocale()] : ucfirst($currentRecord->car) }}</b>
                        </td>
                        <td class="text-center">{{ $currentRecord->name }}<br>{{ $currentRecord->phone }}<br><a href="mailto:{{ $currentRecord->email }}">{{ $currentRecord->email }}</a></td>
                        <td class="text-center">
                            @php list($label, $status) = getRecordLabelAndStatus($currentRecord); @endphp
                            <span class="label label-{{ $label }}">{{ $status }}</span><br>
                            @if (isset($currentRecord->user))
                                <a href="{{ route('admin.users', ['id' => $currentRecord->user_id]) }}">{{ $currentRecord->user->email }}</a><br>
                            @endif
                            <div>{{ $currentRecord->created_at ? $currentRecord->created_at : '' }}</div>
                        </td>
                        @can('owner', $currentRecord)
                            @include('admin.blocks.delete_cell_block',['id' => $currentRecord->id])
                        @else
                            <td></td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    @if (isset($record))
        <a name="record"></a>
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h4 class="panel-title">{{ $record ? trans('records.record_at',['date' => date('d.m.Y',$record->date)]) : trans('records.adding_record') }}</h4>
            </div>
            <div class="panel-body">
                <form id="record-form" class="form-horizontal" action="{{ route('admin.edit_record') }}" method="post">
                    @csrf
                    @if ($record)
                        @include('admin.blocks.hidden_id_block',['value' => $record->id])
                    @endif
                    <div class="row">
                        <div class="col-md-2 col-sm-12 col-xs-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    {{ trans('records.brand_and_car') }}
                                </div>
                                <div class="panel-body">
                                    @include('admin.blocks.combobox_group_block',[
                                        'label' => null,
                                        'useNull' => true,
                                        'name' => 'car_id',
                                        'items' => $cars,
                                        'selected' => $record ? $record->car_id : null
                                    ])
                                </div>
                            </div>
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    {{ trans('records.record_date_and_time') }}
                                </div>
                                <div class="panel-body">
                                    @include('admin.blocks.date_block', [
                                        'label' => trans('records.record_date'),
                                        'name' => 'date',
                                        'value' => $record ? $record->date : (request()->has('date') ? request()->input('date') : strtotime(date('m').'/'.date('d').'/'.date('Y')))
                                    ])

                                    @include('admin.blocks.time_block',[
                                        'name' => 'time',
                                        'placeholder' => trans('records.record_time'),
                                        'start' => 0,
                                        'min' => 10,
                                        'max' => 21,
                                        'interval' => 30,
                                        'value' => $record ? $record->time : (request()->has('time') ? request()->input('time') : '10:00')
                                    ])
                                </div>
                            </div>
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    {{ trans('records.record_duration') }}
                                </div>
                                <div class="panel-body">
                                    @include('admin.blocks.time_block',[
                                        'name' => 'duration',
                                        'placeholder' => trans('records.record_duration'),
                                        'start' => 30,
                                        'min' => 0.5,
                                        'max' => 11,
                                        'interval' => 30,
                                        'value' => $record ? $record->duration : '1:00'
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="panel panel-flat union-height">
                                <div class="panel-heading">
                                    {{ trans('records.record_post') }}
                                </div>
                                <div class="panel-body">
                                    @include('admin.blocks.radio_button_block',[
                                        'name' => 'point',
                                        'values' => $points,
                                        'activeValue' => $record ? $record->point : (request()->has('point') ? request()->input('point') : 1)
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="panel panel-flat union-height">
                                <div class="panel-heading">
                                    {{ trans('records.status') }}
                                </div>
                                <div class="panel-body">
                                    @include('admin.blocks.radio_button_block',[
                                        'name' => 'status',
                                        'values' => [
                                            ['val' => 0, 'descript' => trans('records.record_status_new')],
                                            ['val' => 1, 'descript' => trans('records.record_status_arrived')],
                                            ['val' => 2, 'descript' => trans('records.record_status_in_work')],
                                            ['val' => 3, 'descript' => trans('records.record_status_done')],
                                            ['val' => 4, 'descript' => trans('records.record_status_leave')],
                                            ['val' => 5, 'descript' => trans('records.record_status_cancel')]
                                        ],
                                        'activeValue' => $record ? $record->status : 0
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="panel panel-flat union-height">
                                <div class="panel-body">
                                    @include('admin.blocks.select_block',[
                                        'label' => trans('records.made_record'),
                                        'name' => 'user_id',
                                        'option' => 'email',
                                        'values' => $users,
                                        'icon' => 'icon-user',
                                        'selected' => $record ? $record->user_id : auth()->user()->id
                                    ])

                                    @include('blocks.input_block', [
                                        'label' => trans('records.brand_and_car'),
                                        'name' => 'car',
                                        'type' => 'text',
                                        'placeholder' => trans('records.brand_and_car'),
                                        'icon' => 'icon-car',
                                        'value' => $record ? $record->car : ''
                                    ])

                                    @include('blocks.input_block', [
                                        'label' => trans('records.record_title'),
                                        'name' => 'title',
                                        'type' => 'text',
                                        'placeholder' => trans('records.record_title'),
                                        'icon' => 'icon-wrench',
                                        'value' => $record ? $record->title : ''
                                    ])

                                    @include('blocks.input_block', [
                                        'label' => trans('records.user_name'),
                                        'name' => 'name',
                                        'type' => 'text',
                                        'icon' => 'icon-user-check',
                                        'placeholder' => trans('records.user_name'),
                                        'value' => $record ? $record->name : ''
                                    ])

                                    @include('blocks.input_block', [
                                        'label' => 'E-mail',
                                        'name' => 'email',
                                        'type' => 'text',
                                        'placeholder' => 'E-mail',
                                        'icon' => ' icon-envelop4',
                                        'value' => $record ? $record->email : ''
                                    ])

                                    @include('blocks.input_block', [
                                        'label' => trans('records.phone'),
                                        'name' => 'phone',
                                        'type' => 'tel',
                                        'placeholder' => '+7(___)___-__-__',
                                        'icon' => ' icon-iphone',
                                        'value' => $record ? $record->phone : ''
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @include('blocks.checkbox_block',[
                            'name' => 'send_notice_now',
                            'checked' => $record ? $record->send_notice : true,
                            'label' => trans('records.send_notice_now')
                        ])

                        @include('blocks.checkbox_block',[
                            'name' => 'send_notice',
                            'checked' => $record ? $record->send_notice : true,
                            'label' => trans('records.send_notice')
                        ])
                    </div>
                    @include('blocks.button_block',[
                        'primary' => true,
                        'buttonType' => 'submit',
                        'icon' => ' icon-floppy-disk',
                        'buttonText' => trans('admin.save'),
                        'addClass' => 'pull-right'
                    ])
                </form>
            </div>
        </div>
    @endif
    @if (isset($mechanics) && count($mechanics))
        <a name="mechanics"></a>
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h4 class="panel-title">{{ trans('records.mechanics') }}</h4>
            </div>
            <form id="record-form" class="form-horizontal" action="{{ route('admin.edit_missing_mechanics') }}" method="post">
                @csrf
                @include('admin.blocks.hidden_id_block',['hiddenName' => 'date', 'value' => $date])
                <div class="panel-body">
                    <div class="row">
                        <select name="missing_mechanics[]" multiple="multiple" class="form-control listbox-filter-disabled">
                            @foreach($mechanics as $mechanic)
                                <option value="{{ $mechanic->id }}" {{ in_array($mechanic->id, $missing_mechanics) ? 'selected=selected' : '' }}>{{ $mechanic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="panel-body">
                    @include('blocks.button_block',[
                        'primary' => true,
                        'buttonType' => 'submit',
                        'icon' => ' icon-floppy-disk',
                        'buttonText' => trans('admin.save'),
                        'addClass' => 'pull-right'
                    ])
                </div>
            </form>
        </div>
    @endif
@endsection
