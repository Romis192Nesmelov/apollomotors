@extends('layouts.admin')

@section('content')
    @can('edit')
        <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_car') }}" method="post">
            @csrf
            @if (isset($car))
                @include('admin.blocks.hidden_id_block',['value' => $car->id])
            @endif
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    <div class="col-md-3 col-sm-6 col-sm-12">
                        @include('admin.blocks.input_image_block',[
                            'head' => trans('admin.image_preview'),
                            'name' => 'image_preview',
                            'preview' => isset($car) && $car->image_preview ? $car->image_preview : ''
                        ])
                    </div>
                    <div class="col-md-3 col-sm-6 col-sm-12">
                        @include('admin.blocks.input_image_block',[
                            'head' => trans('admin.image_full'),
                            'name' => 'image_full',
                            'preview' => isset($car) && $car->image_full ? $car->image_full : ''
                        ])
                    </div>
                    <div class="col-md-6 col-sm-12 col-sm-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                <div class="panel panel-flat">
                                    <x-atitle>{{ trans('admin.edit_car_parent') }}</x-atitle>
                                    <div class="panel-body">
                                        @include('admin.blocks.select_block',[
                                            'name' => 'brand_id',
                                            'values' => $brands,
                                            'selected' => isset($car) ? $car->brand_id : request()->parent_id,
                                            'option' => 'name_'.app()->getLocale()
                                        ])
                                    </div>
                                </div>

                                @include('admin.blocks.name_triple_block',['item' => isset($car) ? $car : null])

                                @include('blocks.checkbox_block', [
                                    'name' => 'active',
                                    'checked' => isset($car) ? $car->active : true,
                                    'label' => trans('admin.active')
                                ])
                                <p><sup>*</sup>{{ trans('admin.these_fields_are_required') }}</p>
                            </div>
                        </div>
                    </div>
                    @include('admin.blocks.save_button_block')
                </div>
            </div>
        </form>
    @else
        <div class="col-md-4 col-sm-6 col-sm-12">
            <div class="panel panel-flat">
                @include('admin.blocks.image_block',[
                    'preview' => $car->image_preview,
                    'full' => $car->image_full
                ])
            </div>
        </div>
        <div class="col-md-8 col-sm-6 col-sm-12">
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    @include('admin.blocks.active_status_block',['active' => $car->active])
                </div>
            </div>
        </div>
    @endcan
    @if (isset($car))
        @include('admin.blocks.rms_content_block', [
            'part_name' => 'car',
            'item' => $car,
            'parts' => ['repairs','maintenance','spare']
        ])
    @endif
@endsection
