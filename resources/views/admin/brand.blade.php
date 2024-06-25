@extends('layouts.admin')

@section('content')
    @can('delete')
        @include('admin.blocks.modal_delete_block',[
            'action' => 'delete_car',
            'head' => trans('admin.do_you_really_want_delete_this_car')
        ])
    @endcan

    @can('edit')
        <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_brand') }}" method="post">
            @csrf
            @if (isset($brand))
                @include('admin.blocks.hidden_id_block',['value' => $brand->id])
            @endif
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    <div class="col-md-2 col-sm-6 col-sm-12">
                        @include('admin.blocks.input_image_block',[
                            'name' => 'logo',
                            'preview' => isset($brand) ? $brand->logo : ''
                        ])
                    </div>
                    <div class="col-md-4 col-sm-6 col-sm-12">
                        @include('admin.blocks.input_image_block',[
                            'name' => 'image',
                            'preview' => isset($brand) && $brand->image ? $brand->image : ''
                        ])
                    </div>
                    <div class="col-md-6 col-sm-12 col-sm-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('admin.blocks.name_triple_block',['item' => isset($brand) ? $brand : null])
                                @include('blocks.checkbox_block', [
                                    'name' => 'active',
                                    'checked' => isset($brand) ? $brand->active : true,
                                    'label' => trans('admin.active')
                                ])
                                @include('blocks.checkbox_block', [
                                    'name' => 'elected',
                                    'checked' => isset($brand) ? $brand->elected : true,
                                    'label' => trans('admin.elected')
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
        <div class="row">
            <div class="col-md-4 col-sm-6 col-sm-12">
                <div class="panel panel-flat">
                    @include('admin.blocks.image_block',[
                        'preview' => $brand->image
                    ])
                </div>
            </div>
            <div class="col-md-8 col-sm-6 col-sm-12">
                <div class="panel panel-flat">
                    @include('admin.blocks.title_block')
                    <div class="panel-body">
                        @include('admin.blocks.active_status_block',['active' => $brand->active])
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @if (isset($brand))
        @include('admin.blocks.rms_content_block', [
            'part_name' => 'brand',
            'item' => $brand,
            'parts' => ['repairs','maintenances','spare']
        ])
        <div class="panel panel-flat">
            <x-atitle>{{ trans('admin.cars') }}</x-atitle>
            <div class="panel-body">
                @include('admin.blocks.datatable_block',[
                    'items' => $brand->cars,
                    'route' => 'cars',
                    'parentId' => $brand->id,
                    'columns' => ['image_preview', 'name_'.app()->getLocale(),'active'],
                    'addMode' => Gate::allows('edit'),
                    'editMode' => Gate::allows('edit'),
                    'deleteMode' => Gate::allows('delete'),
                    'addButtonText' => trans('admin.add_car')
                ])
            </div>
        </div>
    @endif
@endsection
