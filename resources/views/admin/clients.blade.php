@extends('layouts.admin')

@section('content')
    @can('delete')
        @include('admin.blocks.modal_delete_block',[
            'action' => 'delete_client',
            'head' => trans('admin.do_you_really_want_delete_this_client')
        ])
    @endcan
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        @include('admin.blocks.datatable_block',[
            'items' => $clients,
            'columns' => ['image','name','active'],
            'addMode' => Gate::allows('edit'),
            'editMode' => Gate::allows('edit'),
            'deleteMode' => Gate::allows('delete'),
        ])
    </div>
@endsection
