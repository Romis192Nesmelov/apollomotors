@extends('layouts.main')

@section('content')
    <x-section class="action-list">
        <x-head level="1">{{ trans('menu.actions') }}</x-head>
        @foreach ($actions as $action)
            <div class="col-md-4 col-sm-12 action">
                @include('actions.blocks.action_block')
            </div>
        @endforeach
    </x-section>
@endsection
