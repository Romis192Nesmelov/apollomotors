@extends('layouts.admin')

@section('content')
    <form class="form-horizontal" action="{{ route('admin.edit_sub_repair') }}" method="post">
        @csrf
        @if (isset($sub_repair))
            @include('admin.blocks.hidden_id_block',['value' => $sub_repair->id])
        @endif
        <div class="panel panel-flat">
            @include('admin.blocks.title_block')
            <div class="panel-body">
                <div class="col-md-3 col-sm-4 col-sm-12">
                    <div class="panel panel-flat">
                        <x-atitle>{{ trans('admin.repairs') }}</x-atitle>
                        <div class="panel-body">
                            @include('admin.blocks.select_block',[
                                'name' => 'repair_id',
                                'values' => $repairs,
                                'selected' => isset($sub_repair) ? $sub_repair->repair_id : request()->parent_id,
                                'option' => 'head'
                            ])
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8 col-sm-12">
                    @include('blocks.input_block', [
                        'label' => trans('admin.name'),
                        'required' => true,
                        'name' => 'name',
                        'type' => 'text',
                        'max' => 255,
                        'placeholder' => trans('admin.name'),
                        'value' => isset($sub_repair) ? $sub_repair->name : ''
                    ])
                    @include('blocks.input_block', [
                        'label' => trans('admin.price').' ₽',
                        'required' => true,
                        'name' => 'price',
                        'type' => 'number',
                        'max' => 1000000,
                        'placeholder' => trans('admin.price'),
                        'value' => isset($sub_repair) ? $sub_repair->price : 100
                    ])
                </div>
                @include('admin.blocks.edit_button_block')
            </div>
        </div>
    </form>
@endsection
