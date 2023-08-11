@extends('layouts.admin')

@section('content')
    @can('edit')
    <form class="form-horizontal" action="{{ route('admin.edit_check') }}" method="post">
        @csrf
        @if (isset($check))
            @include('admin.blocks.hidden_id_block',['id' => $check->id])
        @endif
        <div class="panel panel-flat">
            @include('admin.blocks.title_block')
            <div class="panel-body">
                <div class="panel panel-flat">
                    <x-atitle>{{ trans('admin.edit_check_parent') }}</x-atitle>
                    <div class="panel-body">
                        @include('admin.blocks.select_block',[
                            'name' => 'free_check_id',
                            'values' => $free_checks,
                            'selected' => isset($check) ? $check->free_check_id : request()->parent_id,
                            'option' => 'name'
                        ])
                    </div>
                </div>

                @include('blocks.input_block', [
                    'label' => trans('admin.name'),
                    'required' => true,
                    'name' => 'name',
                    'type' => 'text',
                    'max' => 255,
                    'placeholder' => trans('admin.name'),
                    'value' => isset($check) ? $check->name : ''
                ])
                @include('blocks.checkbox_block', [
                    'name' => 'active',
                    'checked' => isset($check) ? $check->active : true,
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
                @include('admin.blocks.active_status_block',['active' => $check->active])
            </div>
        </div>
    @endcan
@endsection
