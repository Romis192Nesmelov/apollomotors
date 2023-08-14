@extends('layouts.admin')

@section('content')
    @can('edit')
        <form class="form-horizontal" action="{{ route('admin.edit_action_question') }}" method="post">
            @csrf
            @if (isset($action_question))
                @include('admin.blocks.hidden_id_block',['value' => $action_question->id])
            @endif
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    <div class="panel panel-flat">
                    <x-atitle>{{ trans('admin.action') }}</x-atitle>
                    <div class="panel-body">
                        @include('admin.blocks.select_block',[
                            'name' => 'action_id',
                            'values' => $actions,
                            'selected' => isset($action_question) ? $action_question->action_id : request()->parent_id,
                            'option' => 'head'
                        ])
                    </div>
                </div>

                    @include('blocks.input_block', [
                        'label' => trans('admin.question'),
                        'required' => true,
                        'name' => 'question',
                        'type' => 'text',
                        'max' => 255,
                        'placeholder' => trans('admin.question'),
                        'value' => isset($action_question) ? $action_question->question : ''
                    ])
                    @include('admin.blocks.textarea_block',[
                        'required' => true,
                        'simple' => true,
                        'name' => 'answer',
                        'label' => trans('admin.answer'),
                        'value' => isset($action_question) ? $action_question->answer : ''
                    ])
                    @include('blocks.checkbox_block', [
                        'name' => 'active',
                        'checked' => isset($action_question) ? $action_question->active : true,
                        'label' => trans('admin.active')
                    ])
                    @include('admin.blocks.edit_button_block')
                </div>
            </div>
        </form>
    @else
        <div class="panel panel-flat">
            @include('admin.blocks.title_block')
            <div class="panel-body">
                <h2>{{ trans('admin.answer') }}:</h2>
                <p>{{ $action_question->answer }}</p>
                @include('admin.blocks.active_status_block',['active' => $action_question->active])
            </div>
        </div>
    @endcan
@endsection
