@extends('layouts.admin')

@section('content')
    @can('edit')
        <form class="form-horizontal" action="{{ route('admin.edit_spare') }}" method="post">
            @csrf
            @if (isset($spare))
                @include('admin.blocks.hidden_id_block',['value' => $spare->id])
            @endif
            @include('admin.blocks.seo_block',['item' => isset($spare) ? $spare->seo : null])
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    @include('admin.blocks.select_block',[
                                        'label' => trans('admin.car'),
                                        'name' => 'car_id',
                                        'values' => $cars,
                                        'selected' => isset($spare) ? $spare->car_id : request()->parent_id,
                                        'option' => 'name_'.app()->getLocale()
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    @include('blocks.input_block', [
                                        'label' => trans('admin.slug'),
                                        'required' => false,
                                        'name' => 'slug',
                                        'type' => 'text',
                                        'max' => 255,
                                        'placeholder' => trans('admin.slug'),
                                        'value' => isset($spare) ? $spare->slug : ''
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('blocks.input_block', [
                                    'label' => trans('admin.head'),
                                    'required' => true,
                                    'name' => 'head',
                                    'type' => 'text',
                                    'max' => 255,
                                    'placeholder' => trans('admin.head'),
                                    'value' => isset($spare) ? $spare->head : ''
                                ])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('blocks.input_block', [
                                    'label' => trans('admin.spare_code'),
                                    'required' => false,
                                    'name' => 'code',
                                    'type' => 'text',
                                    'max' => 255,
                                    'placeholder' => trans('admin.spare_code'),
                                    'value' => isset($spare) ? $spare->code : ''
                                ])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('blocks.input_block', [
                                    'label' => trans('admin.price_original').' ₽',
                                    'required' => true,
                                    'name' => 'price_original',
                                    'type' => 'number',
                                    'max' => 1000000,
                                    'placeholder' => trans('admin.price_original').' ₽',
                                    'value' => isset($spare) ? $spare->price_original : 100
                                ])
                                @include('blocks.checkbox_block', [
                                    'name' => 'upon_reaching_conditions',
                                    'checked' => isset($spare) ? $spare->price_original_from : true,
                                    'label' => trans('admin.price_original_from')
                                ])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('blocks.input_block', [
                                    'label' => trans('admin.price_non_original').' ₽',
                                    'required' => true,
                                    'name' => 'price_non_original',
                                    'type' => 'number',
                                    'max' => 1000000,
                                    'placeholder' => trans('admin.price_non_original').' ₽',
                                    'value' => isset($spare) ? $spare->price_non_original : 100
                                ])
                                @include('blocks.checkbox_block', [
                                    'name' => 'upon_reaching_conditions',
                                    'checked' => isset($spare) ? $spare->price_non_original_from : true,
                                    'label' => trans('admin.price_non_original_from')
                                ])
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('admin.blocks.textarea_block',[
                            'name' => 'text',
                            'label' => trans('admin.text'),
                            'value' => isset($spare) ? $spare->text : ''
                        ])
                    </div>
                    @include('admin.blocks.save_button_block')
                </div>
            </div>
        </form>
    @else
        <div class="panel panel-flat">
            @include('admin.blocks.title_block')
            <div class="panel-body">
                <h3>{{ trans('admin.spare_code') }}: {{ $spare->code }}</h3>
                <h3>{{ trans('admin.price_original').( $spare->price_original_from ? trans('content.from') : '').': '.$spare->price_original }}₽</h3>
                <h3>{{ trans('admin.price_non_original').($spare->price_non_original_from ? trans('content.from') : '').': '.$spare->price_non_original }}₽</h3>
                <div class="panel-body">{!! $spare->text !!}</div>
                <div class="panel-body">
                    @include('admin.blocks.active_status_block',['active' => $spare->active])
                </div>
            </div>
        </div>
    @endcan
@endsection
