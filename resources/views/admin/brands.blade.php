@extends('layouts.admin')

@section('content')
    @if (Gate::allows('delete'))
        @include('admin.blocks.modal_delete_block',[
            'action' => 'delete_brand',
            'head' => trans('admin.do_you_really_want_delete_this_brand')
        ])
    @endif
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        @include('admin.blocks.datatable_block',[
            'items' => $brands,
            'columns' => ['name_'.app()->getLocale(),'elected','active'],
            'addMode' => Gate::allows('edit'),
            'editMode' => Gate::allows('edit'),
            'deleteMode' => Gate::allows('delete'),
        ])
    </div>
@endsection
