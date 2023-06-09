@extends('layouts.main')

@section('content')
    <x-section class="action-list">
        <h1 class="w-100 text-center">{{ trans('menu.actions') }}</h1>
        @foreach ($actions as $action)
            <div class="col-md-4 col-sm-12 action">
                <table>
                    <tr>
                        <td>
                            <div class="action-image image">
                                <img title="{{ $action->text }}" src="{{ asset($action->image_small) }}" />
                            </div>
                            <h2 class="w-100 text-center">@include('blocks.action_text_block')</h2>
                            <p class="w-100 text-center">{{ trans('content.the_promotion_is_valid_until',['date' => date('d.m.Y', $action->limit)]) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="button-cell">@include('blocks.action_button_block')</td>
                    </tr>
                </table>
            </div>
        @endforeach
    </x-section>
@endsection
