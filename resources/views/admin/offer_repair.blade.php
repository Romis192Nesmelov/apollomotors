@extends('layouts.admin')

@section('content')
    @can('edit')
        <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_offer_repair') }}" method="post">
            @csrf
            @if (isset($offer_repair))
                @include('admin.blocks.hidden_id_block',['value' => $offer_repair->id])
            @endif
            <div class="col-md-4 col-sm-6 col-sm-12">
                @include('admin.blocks.input_image_block',[
                    'name' => 'image',
                    'preview' => isset($offer_repair) ? asset($offer_repair->image) : ''
                ])
            </div>
            <div class="col-md-8 col-sm-6 col-sm-12">
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
                            'value' => isset($offer_repair) ? $offer_repair->name : ''
                        ])
                        @include('blocks.checkbox_block', [
                            'name' => 'active',
                            'checked' => isset($offer_repair) ? $offer_repair->active : true,
                            'label' => trans('admin.active')
                        ])
                        @include('admin.blocks.edit_button_block')
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="col-md-4 col-sm-6 col-sm-12">
            <div class="panel panel-flat">
                @include('admin.blocks.image_block',[
                    'preview' => asset($offer_repair->image)
                ])
            </div>
        </div>
        <div class="col-md-8 col-sm-6 col-sm-12">
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    @include('admin.blocks.active_status_block',['active' => $offer_repair->active])
                </div>
            </div>
        </div>
    @endcan
@endsection
