@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.content') }}</x-atitle>
        @include('admin.blocks.datatable_block',[
            'items' => $actions,
            'columns' => ['image_small','head','text'],
            'addMode' => Gate::allows('edit'),
            'editMode' => Gate::allows('edit'),
            'deleteMode' => Gate::allows('delete'),
        ])
    </div>
@endsection
