@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        @include('admin.blocks.datatable_block',[
            'items' => $contacts,
            'columns' => ['icon','contact','active'],
            'slugMode' => false,
            'addMode' => false,
            'editMode' => Gate::allows('edit'),
            'deleteMode' => false,
        ])
    </div>
@endsection
