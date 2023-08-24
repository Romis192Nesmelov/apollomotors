@if ($record->car_id)
    <div>
        <img class="brand" title="{{ $currentRecord->title.' '.$currentRecord->email.' '.($currentRecord->phone ? $currentRecord->phone : '').' '.($currentRecord->name ? $currentRecord->name : '') }}" src="{{ asset($record->carLink->brand->logo) }}" />
    </div>
@endif
{{--<img class="car" src="{{ $record->car_id ? $record->carLink->preview : asset('images/car_placeholder.jpg') }}">--}}
<div class="record-title">{{ $record->car_id ? ucfirst($record->carLink->brand->eng).' '.$record->carLink->eng : ucfirst($record->car) }}</div>
<div>{{ $record->title }}</div>
