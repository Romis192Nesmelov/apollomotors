@extends('layouts.admin')

@section('content')
    @can('edit')
        <form class="form-horizontal" action="{{ route('admin.edit_question') }}" method="post">
            @csrf
            @if (isset($question))
                @include('admin.blocks.hidden_id_block',['value' => $question->id])
            @endif
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    @include('blocks.input_block', [
                        'label' => trans('admin.question'),
                        'required' => true,
                        'name' => 'question',
                        'type' => 'text',
                        'max' => 255,
                        'placeholder' => trans('admin.question'),
                        'value' => isset($question) ? $question->question : ''
                    ])
                    @include('admin.blocks.textarea_block',[
                        'required' => true,
                        'simple' => true,
                        'name' => 'answer',
                        'label' => trans('admin.answer'),
                        'value' => isset($question) ? $question->answer : ''
                    ])
                    @include('blocks.checkbox_block', [
                        'name' => 'active',
                        'checked' => isset($question) ? $question->active : true,
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
                <p>{{ $question->answer }}</p>
                @include('admin.blocks.active_status_block',['active' => $question->active])
            </div>
        </div>
    @endcan
@endsection
