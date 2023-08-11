@extends('layouts.admin')

@section('content')
    @can('edit')
        @can('delete')
            @include('admin.blocks.modal_delete_block',[
                'action' => 'delete_check',
                'head' => trans('admin.do_you_really_want_delete_this_position')
            ])
        @endif
        <form class="form-horizontal" action="{{ route('admin.edit_free_check') }}" method="post">
            @csrf
            @if (isset($free_check))
                @include('admin.blocks.hidden_id_block',['id' => $free_check->id])
            @endif
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    @include('blocks.input_block', [
                        'label' => trans('admin.name'),
                        'required' => true,
                        'name' => 'name',
                        'type' => 'text',
                        'max' => 255,
                        'placeholder' => trans('admin.name'),
                        'value' => isset($free_check) ? $free_check->name : ''
                    ])
                    @include('blocks.checkbox_block', [
                        'name' => 'active',
                        'checked' => isset($free_check) ? $free_check->active : true,
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
                @include('admin.blocks.active_status_block',['active' => $free_check->active])
            </div>
        </div>
    @endcan
    @if (isset($free_check))
        <div class="panel panel-flat">
            <x-atitle>{{ trans('admin.checks') }}</x-atitle>
            <div class="panel-body">
                @include('admin.blocks.datatable_block',[
                    'items' => $free_check->checks,
                    'route' => 'checks',
                    'parentId' => $free_check->id,
                    'columns' => ['name','active','created_at'],
                    'addMode' => Gate::allows('edit'),
                    'editMode' => Gate::allows('edit'),
                    'deleteMode' => Gate::allows('delete'),
                ])
            </div>
        </div>
    @endif
@endsection
