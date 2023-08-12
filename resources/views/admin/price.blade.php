@extends('layouts.admin')

@section('content')
    @can('edit')
        <form class="form-horizontal" action="{{ route('admin.edit_price') }}" method="post">
            @csrf
            @if (isset($price))
                @include('admin.blocks.hidden_id_block',['value' => $price->id])
            @endif
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    <div class="panel panel-flat">
                        <x-atitle>{{ trans('admin.parent_brand') }}</x-atitle>
                        <div class="panel-body">
                            @include('admin.blocks.select_block',[
                                'name' => 'brand_id',
                                'values' => $brands,
                                'selected' => isset($price) ? $price->brand_id : 1,
                                'option' => 'name_'.app()->getLocale()
                            ])
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            @include('blocks.input_block', [
                                'label' => trans('admin.name'),
                                'required' => true,
                                'name' => 'name',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('admin.name'),
                                'value' => isset($price) ? $price->name : ''
                            ])
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            @include('blocks.input_block', [
                                'label' => trans('admin.value'),
                                'required' => true,
                                'name' => 'value',
                                'type' => 'number',
                                'max' => 100000,
                                'placeholder' => trans('admin.value'),
                                'value' => isset($price) ? $price->value : 100
                            ])
                        </div>
                    </div>
                    @include('blocks.checkbox_block', [
                        'name' => 'active',
                        'checked' => isset($price) ? $price->active : true,
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
                <h1>{{ $price->value }}₽</h1>
                @include('admin.blocks.active_status_block',['active' => $price->active])
            </div>
        </div>
    @endcan
@endsection
