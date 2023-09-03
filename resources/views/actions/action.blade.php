@extends('layouts.main')

@section('content')
    <x-section>
        <x-head level="1">{{ $action->head }}</x-head>
        <x-head level="2">{{ trans('content.the_promotion_is_valid_until', ['date' => date('d.m.Y',$action->limit)]) }}</x-head>
        <div id="action-block" class="mb-4">
            @include('blocks.action_block', ['useCounter' => true])
        </div>
        <div class="action-content">
            {!! $action->text !!}
        </div>
    </x-section>
    <x-section class="gray">
        <x-head level="2">{{ trans('content.faq') }}</x-head>
        @include('blocks.accordion_block',['id' => 'faq', 'questions' => $action->questions])
    </x-section>
    <x-section>
        @include('blocks.online_record_block',[
            'type' => 'online_registration_for_the_promotion',
            'actionId' => $action->id
        ])
    </x-section>
@endsection
