@extends('layouts.admin')

@section('content')
    @can('edit')
        <form class="form-horizontal" action="{{ route('admin.edit_mechanic') }}" method="post">
            @csrf
            @if (isset($mechanic))
                @include('admin.blocks.hidden_id_block',['value' => $mechanic->id])
            @endif

            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    @include('blocks.input_block', [
                        'label' => trans('admin.mechanic_name'),
                        'required' => true,
                        'name' => 'name',
                        'type' => 'text',
                        'max' => 255,
                        'placeholder' => trans('admin.mechanic_name'),
                        'value' => isset($mechanic) ? $mechanic->name : ''
                    ])
                    @include('admin.blocks.edit_button_block')
                </div>
            </div>
        </form>
    @else
        <div class="panel panel-flat">
            <div class="panel-body">
                <h1>{{ trans('admin.mechanic_name').': '.$mechanic->name }}</h1>
            </div>
        </div>
    @endcan
@endsection
