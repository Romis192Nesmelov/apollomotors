@extends('layouts.admin')

@section('content')
    @can('edit')
        <form class="form-horizontal" action="{{ route('admin.edit_article') }}" method="post">
            @csrf
            @if (isset($article))
                @include('admin.blocks.hidden_id_block',['id' => $article->id])
                @include('admin.blocks.seo_block',['item' => $article])
            @endif
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
                        'value' => isset($article) ? $article->head : ''
                    ])
                    @include('admin.blocks.textarea_block',[
                        'required' => true,
                        'name' => 'text',
                        'label' => trans('admin.text'),
                        'value' => isset($article) ? $article->text : ''
                    ])
                    @include('blocks.checkbox_block', [
                        'name' => 'active',
                        'checked' => isset($article) ? $article->active : true,
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
                {!! $article->text !!}
                @include('admin.blocks.active_status_block',['active' => $article->active])
            </div>
        </div>
    @endcan
@endsection
