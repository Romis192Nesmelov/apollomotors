{{--$data = [<br>--}}
{{--@foreach ($records as $record)--}}
{{--[<br>--}}
{{--'car' => {{ $record->car ? '\''.$record->car.'\'' : 'null' }},<br>--}}
{{--'title' => '{{ $record->title }}',<br>--}}
{{--'name' => {{ $record->name ? '\''.$record->name.'\'' : 'null' }},<br>--}}
{{--'email' => {{ $record->email ? '\''.$record->email.'\'' : 'null' }},<br>--}}
{{--'phone' => {{ $record->phone ? '\''.$record->phone.'\'' : 'null' }},<br>--}}
{{--'status' => {{ $record->status ? '\''.$record->status.'\'' : 'null' }},<br>--}}
{{--'point' => {{ $record->point ? '\''.$record->point.'\'' : 'null' }},<br>--}}
{{--'date' => {{ $record->date }},<br>--}}
{{--'time' => {{ $record->time ? '\''.$record->time.'\'' : 'null' }},<br>--}}
{{--'duration' => {{ $record->duration ? '\''.$record->duration.'\'' : 'null' }},<br>--}}
{{--'send_notice' => {{ $record->send_notice ? $record->send_notice : 'null' }},<br>--}}
{{--'sent_notice' => {{ $record->sent_notice ? $record->sent_notice : 'null' }},<br>--}}
{{--'car_id' => {{ $record->car_id ? $record->car_id : 'null' }},<br>--}}
{{--'user_id' => {{ $record->user_id ? $record->user_id : 'null' }},<br>--}}
{{--],<br>--}}
{{--@endforeach--}}
{{--];--}}

$data = [<br>
@foreach ($missing_mechanics as $missing_mechanic)
[<br>
'date' => {{ $missing_mechanic->date }},<br>
'mechanic_id' => {{ $missing_mechanic->mechanic_id }}<br>
],<br>
@endforeach
];
