@extends('layouts.admin')

@section('content')
    @can('delete')
        @include('admin.blocks.modal_delete_block',[
            'action' => 'delete_article',
            'head' => trans('admin.do_you_really_want_delete_this_article')
        ])
    @endcan
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        @include('admin.blocks.datatable_block',[
            'items' => $articles,
            'columns' => ['head','text','active'],
            'addMode' => Gate::allows('edit'),
            'editMode' => Gate::allows('edit'),
            'deleteMode' => Gate::allows('delete'),
        ])
    </div>
@endsection
