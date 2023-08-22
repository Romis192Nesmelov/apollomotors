@extends('layouts.admin')

@section('content')
    @can('delete')
        @include('admin.blocks.modal_delete_block',[
            'id' => 'delete-modal-sub-repair',
            'action' => 'delete_sub_repair',
            'head' => trans('admin.do_you_really_want_delete_this_sub_repair')
        ])
        @include('admin.blocks.modal_delete_block',[
            'id' => 'delete-modal-repair-image',
            'action' => 'delete_repair_image',
            'head' => trans('admin.do_you_really_want_delete_this_image')
        ])
        @include('admin.blocks.modal_delete_block',[
            'id' => 'delete-modal-recommended-work',
            'action' => 'delete_recommended_work',
            'head' => trans('admin.do_you_really_want_delete_this_position')
        ])
        @include('admin.blocks.modal_delete_block',[
            'id' => 'delete-modal-repair-spare',
            'action' => 'delete_repair_spare',
            'head' => trans('admin.do_you_really_want_delete_this_position')
        ])
    @endcan

    @can('edit')
        <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_repair') }}" method="post">
            @csrf
            @if (isset($repair))
                @include('admin.blocks.hidden_id_block',['value' => $repair->id])
            @endif
            @include('admin.blocks.seo_block',['item' => isset($repair) ? $repair->seo : null])
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    <div class="col-md-3 col-sm-4 col-sm-12">
                        <div class="panel panel-flat">
                            <x-atitle>{{ trans('admin.cars') }}</x-atitle>
                            <div class="panel-body">
                                @include('admin.blocks.select_block',[
                                    'label' => trans('admin.car'),
                                    'name' => 'car_id',
                                    'values' => $cars,
                                    'selected' => isset($repair) ? $repair->car_id : request()->parent_id,
                                    'option' => 'name_'.app()->getLocale()
                                ])
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('blocks.checkbox_block', [
                                    'name' => 'price_from',
                                    'checked' => isset($repair) ? $repair->price_from : true,
                                    'label' => trans('admin.price_from')
                                ])
                                @include('blocks.input_block', [
                                    'label' => trans('admin.price').' ₽',
                                    'required' => true,
                                    'name' => 'price',
                                    'type' => 'number',
                                    'max' => 10000000,
                                    'placeholder' => trans('admin.price').' ₽',
                                    'value' => isset($repair) ? $repair->price : 100
                                ])
                                @include('blocks.input_block', [
                                    'label' => trans('admin.old_price').' ₽',
                                    'required' => true,
                                    'name' => 'old_price',
                                    'type' => 'number',
                                    'max' => 10000000,
                                    'placeholder' => trans('admin.old_price').' ₽',
                                    'value' => isset($repair) ? $repair->old_price : 100
                                ])
                                @include('blocks.input_block', [
                                    'label' => trans('indicator.issue_duration').' '.trans('indicator.hour'),
                                    'required' => true,
                                    'name' => 'work_time',
                                    'step' => 0.1,
                                    'type' => 'number',
                                    'max' => 1000,
                                    'placeholder' => trans('indicator.issue_duration').' '.trans('indicator.hour'),
                                    'value' => isset($repair) ? $repair->work_time : 2
                                ])
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                <h4>{!! trans('indicator.recommendation') !!}</h4>
                                @include('blocks.input_block', [
                                    'label' => trans('indicator.years2'),
                                    'required' => false,
                                    'name' => 'upon_reaching_years',
                                    'type' => 'number',
                                    'max' => 100,
                                    'icon' => 'icon-hour-glass2',
                                    'placeholder' => trans('indicator.years1'),
                                    'value' => isset($repair) ? $repair->upon_reaching_years : 2
                                ])
                                @include('blocks.input_block', [
                                    'label' => trans('indicator.mileage'),
                                    'required' => false,
                                    'name' => 'upon_reaching_mileage',
                                    'type' => 'number',
                                    'max' => 1000000,
                                    'icon' => 'icon-meter-fast',
                                    'placeholder' => trans('indicator.years1'),
                                    'value' => isset($repair) ? $repair->upon_reaching_mileage : 10000
                                ])
                                @include('blocks.checkbox_block', [
                                    'name' => 'upon_reaching_conditions',
                                    'checked' => isset($repair) ? $repair->upon_reaching_conditions : true,
                                    'label' => trans('indicator.general_condition')
                                ])
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('blocks.checkbox_block', [
                                    'name' => 'free_diagnostics',
                                    'checked' => isset($repair) ? $repair->free_diagnostics : true,
                                    'label' => trans('indicator.free_diagnostics')
                                ])
                                @include('blocks.input_block', [
                                    'label' => trans('admin.warranty_years'),
                                    'required' => false,
                                    'name' => 'warranty_years',
                                    'step' => 0.5,
                                    'type' => 'number',
                                    'max' => 20,
                                    'icon' => 'icon-calendar52',
                                    'placeholder' => trans('admin.warranty_years'),
                                    'value' => isset($repair) ? $repair->warranty_years : 2
                                ])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-8 col-sm-12">
                        <div class="panel panel-flat">
                            <x-atitle>{{ trans('admin.sub_repairs') }}</x-atitle>
                            <div class="panel-body">
                                @include('blocks.input_block', [
                                    'label' => trans('admin.slug'),
                                    'required' => false,
                                    'name' => 'slug',
                                    'type' => 'text',
                                    'max' => 255,
                                    'placeholder' => trans('admin.slug'),
                                    'value' => isset($repair) ? $repair->slug : ''
                                ])
                                @include('blocks.input_block', [
                                    'label' => trans('admin.head'),
                                    'required' => true,
                                    'name' => 'head',
                                    'type' => 'text',
                                    'max' => 255,
                                    'placeholder' => trans('admin.head'),
                                    'value' => isset($repair) ? $repair->head : ''
                                ])
                            </div>
                            @if (isset($repair))
                                @include('admin.blocks.datatable_block',[
                                    'items' => $repair->subRepairs,
                                    'columns' => ['name','price'],
                                    'addMode' => true,
                                    'editMode' => true,
                                    'deleteMode' => Gate::allows('delete'),
                                    'route' => 'sub_repairs',
                                    'modal' => 'delete-modal-sub-repair',
                                    'addButtonText' => trans('admin.add_sub_repairs'),
                                    'parentId' => $repair->id
                                ])
                            @endif
                        </div>

                        @if (isset($repair))
                            <div class="panel panel-flat">
                                <x-atitle>{{ trans('admin.repair_images') }}</x-atitle>
                                <div class="panel-body">
                                    @include('admin.blocks.datatable_block',[
                                        'items' => $repair->images,
                                        'columns' => ['image','preview'],
                                        'addMode' => true,
                                        'editMode' => false,
                                        'deleteMode' => Gate::allows('delete'),
                                        'route' => 'repair_images',
                                        'modal' => 'delete-modal-repair-image',
                                        'addButtonText' => trans('admin.add_repair_image'),
                                        'parentId' => $repair->id
                                    ])
                                </div>
                            </div>
                        @endif

                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('admin.blocks.textarea_block',[
                                    'name' => 'text',
                                    'label' => trans('admin.text'),
                                    'value' => isset($repair) ? $repair->text : ''
                                ])
                            </div>
                        </div>

                        @if (isset($repair))
                            <div class="panel panel-flat">
                                <x-atitle>{{ trans('content.we_recommend_with_this_work') }}</x-atitle>
                                <div class="panel-body">
                                    @include('admin.blocks.datatable_block',[
                                        'items' => $repair->recommendedWorks,
                                        'relation' => 'work',
                                        'columns' => ['head','price'],
                                        'addMode' => $free_works_count,
                                        'editMode' => false,
                                        'deleteMode' => Gate::allows('delete'),
                                        'route' => 'recommended_works',
                                        'modal' => 'delete-modal-recommended-work',
                                        'addButtonText' => trans('admin.add_sub_repairs'),
                                        'parentId' => $repair->id
                                    ])
                                </div>
                            </div>
                        @endif

                        <div class="panel panel-flat">
                            <x-atitle>{{ trans('content.you_can_purchase_the_necessary_spare_parts_from_us') }}</x-atitle>
                            <div class="panel-body">
                                <div class="col-md-3 col-sm-4 col-xs-12">
                                    @include('admin.blocks.input_image_block',[
                                        'name' => 'spares_image',
                                        'preview' => isset($repair) && $repair->spares_image ? $repair->spares_image : ''
                                    ])
                                </div>
                                @if (isset($repair))
                                    <div class="col-md-9 col-sm-8 col-xs-12">
                                        @include('admin.blocks.datatable_block',[
                                            'items' => $repair->repairSpares,
                                            'relation' => 'spare',
                                            'columns' => ['head','active'],
                                            'addMode' => $free_spares_count,
                                            'editMode' => false,
                                            'deleteMode' => Gate::allows('delete'),
                                            'route' => 'repair_spares',
                                            'modal' => 'delete-modal-repair-spare',
                                            'addButtonText' => trans('admin.add_repair_spare'),
                                            'parentId' => $repair->id
                                        ])
                                    </div>
                                @endif
                            </div>
                        </div>
                        @include('blocks.checkbox_block', [
                            'name' => 'active',
                            'checked' => isset($repair) ? $repair->active : true,
                            'label' => trans('admin.active')
                        ])
                        @include('admin.blocks.edit_button_block')
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="panel panel-flat">
            @include('admin.blocks.title_block')
            <div class="panel-body">
                <div class="col-md-3 col-sm-4 col-sm-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <h3>{{ trans('admin.price') }} @include('issues.blocks.price_from_block') {{ $repair->price }} ₽</h3>
                            <h4>{{ trans('admin.old_price') }} @include('issues.blocks.price_from_block') {{ $repair->old_price }} ₽</h4>
                            <h4>{{ trans('indicator.issue_duration').' ~'.$repair->work_time.trans('indicator.hour') }}</h4>
                        </div>
                    </div>
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <h4>{!! trans('indicator.recommendation') !!}</h4>
                            @if ($repair->upon_reaching_years)
                                <p><i class="icon-hour-glass2"></i> @include('issues.blocks.upon_reaching_years_block')</p>
                            @endif
                            @if ($repair->upon_reaching_mileage)
                                <p><i class="icon-meter-fast"></i> {{ $repair->upon_reaching_mileage.' '.trans('indicator.mileage') }}</p>
                            @endif
                            @if ($repair->upon_reaching_conditions)
                                <p><i class="icon-wrench"></i> {{ trans('indicator.general_condition') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @if ($repair->free_diagnostics)
                                <p><i class="icon-hammer-wrench"></i> {{ trans('indicator.free_diagnostics') }}</p>
                            @endif
                            @if ($repair->warranty_years)
                                <p><i class="icon-calendar52"></i> @include('issues.blocks.warranty_years_block')</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8 col-sm-12">

                    @if (count($repair->subRepairs))
                        <div class="panel panel-flat">
                            <x-atitle>{{ trans('admin.sub_repairs') }}</x-atitle>
                            <div class="panel-body">
                                <x-table class="simple">
                                    @include('issues.blocks.repair_table.table_list_repair_head_block')
                                    @foreach ($repair->subRepairs as $subRepair)
                                        <tr>
                                            <td class="text-left">{{ $subRepair->name }}</td>
                                            <td class="text-center"><b>{{ $subRepair->price }}₽</b></td>
                                        </tr>
                                    @endforeach
                                </x-table>
                            </div>
                        </div>
                    @endif

                    @if (count($repair->images))
                        <div class="panel panel-flat">
                            <x-atitle>{{ trans('admin.repair_images') }}</x-atitle>
                            <div class="panel-body">
                                @include('issues.blocks.carousel_repair_images_block')
                            </div>
                        </div>
                    @endif

                    @if ($repair->text)
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                {!! $repair->text !!}
                            </div>
                        </div>
                    @endif

                    @if (count($repair->recommendedWorks))
                        <div class="panel panel-flat">
                            <x-atitle>{{ trans('content.we_recommend_with_this_work') }}</x-atitle>
                            <div class="panel-body">
                                <x-table class="simple">
                                    @include('issues.blocks.repair_table.table_list_repair_head_block')
                                    @foreach($repair->recommendedWorks as $recommendedWork)
                                        @if ($recommendedWork->work->active)
                                            <tr>
                                                <td>@include('issues.blocks.repair_table.table_list_repair_name_block',['item' => $recommendedWork->work])                                                    </td>
                                                <td class="text-center">
                                                    @include('issues.blocks.repair_table.table_list_repair_price_block', [
                                                        'car' => $recommendedWork->work->car,
                                                        'item' => $recommendedWork->work
                                                    ])
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </x-table>
                            </div>
                        </div>
                    @endif

                    @if (count($repair->spares))
                        <div class="panel panel-flat">
                            <x-atitle>{{ trans('content.you_can_purchase_the_necessary_spare_parts_from_us') }}</x-atitle>
                            <div class="panel-body">
                                <div class="w-100">
                                    @if ($repair->spares_image)
                                        <div class="col-md-3 col-sm-4 col-xs-12 framed-image">
                                            <a href="{{ asset($repair->spares_image) }}" class="fancybox">
                                                <img src="{{ asset($repair->spares_image) }}" />
                                            </a>
                                        </div>
                                    @endif
                                    <ul>
                                        @foreach ($repair->spares as $spare)
                                            <li>{{ $spare->head }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endcan
@endsection
