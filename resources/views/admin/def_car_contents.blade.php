@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <x-atitle>{{ trans('admin_menu.def_cars') }}</x-atitle>
        @include('admin.blocks.datatable_block',[
            'items' => $contents,
            'columns' => ['slug','head','text'],
            'slugMode' => true,
            'addMode' => false,
            'editMode' => Gate::allows('edit'),
            'editSlugMode' => true,
            'deleteMode' => false,
        ])
    </div>
@endsection
