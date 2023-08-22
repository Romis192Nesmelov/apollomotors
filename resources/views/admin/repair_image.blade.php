@extends('layouts.admin')

@section('content')
    <form class="form-horizontal" action="{{ route('admin.add_repair_image') }}" method="post">
        @csrf
        @include('admin.blocks.hidden_id_block',['hiddenName' => 'repair_id', 'value' => request()->parent_id])
        <div class="panel panel-flat">
            @include('admin.blocks.title_block')
            <div class="panel-body">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    @include('blocks.input_block', [
                        'label' => trans('admin.image_preview'),
                        'required' => true,
                        'name' => 'preview',
                        'type' => 'text',
                        'max' => 255,
                        'placeholder' => trans('admin.image_preview'),
                        'value' => ''
                    ])
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    @include('blocks.input_block', [
                        'label' => trans('admin.image_full'),
                        'required' => true,
                        'name' => 'image',
                        'type' => 'text',
                        'max' => 255,
                        'placeholder' => trans('admin.image_full'),
                        'value' => ''
                    ])
                </div>
                @include('admin.blocks.save_button_block')
            </div>
        </div>
    </form>
@endsection
