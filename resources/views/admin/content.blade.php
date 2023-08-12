@extends('layouts.admin')

@section('content')
    @can('edit')
        <form class="form-horizontal" action="{{ route('admin.edit_content') }}" method="post">
            @csrf
            @include('admin.blocks.hidden_id_block',['value' => $content->id])
            @include('admin.blocks.seo_block',['item' => $content])
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    @include('blocks.input_block', [
                        'label' => trans('admin.head'),
                        'required' => true,
                        'name' => 'head',
                        'type' => 'text',
                        'max' => 255,
                        'placeholder' => trans('admin.head'),
                        'value' => $content->head
                    ])
                    @include('admin.blocks.textarea_block',[
                        'required' => true,
                        'name' => 'text',
                        'label' => trans('admin.content'),
                        'value' => $content->text
                    ])
                    @include('admin.blocks.edit_button_block')
                </div>
            </div>
        </form>
    @else
        <div class="panel panel-flat">
            @include('admin.blocks.title_block')
            <div class="panel-body">
                {!! $content->text !!}
            </div>
        </div>
    @endcan
@endsection
