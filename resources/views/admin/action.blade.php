@extends('layouts.admin')

@section('content')
    @can('delete')
        @include('admin.blocks.modal_delete_block',[
            'action' => 'delete_action_question',
            'head' => trans('admin.do_you_really_want_delete_this_question')
        ])
    @endcan

    @can('edit')
        <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.edit_action') }}" method="post">
            @csrf
            @if (isset($action))
                @include('admin.blocks.hidden_id_block',['value' => $action->id])
            @endif
            @include('admin.blocks.seo_block',['item' => isset($action) ? $action->seo : null])
            <div class="row">
                <div class="col-12">
                    <div class="panel panel-flat">
                        @include('admin.blocks.title_block')
                        <div class="panel-body">
                            @include('admin.blocks.input_image_block',[
                                'name' => 'image',
                                'preview' => isset($action) && $action->image ? $action->image : '',
                                'height' => '55%'
                            ])
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-sm-12">
                    @include('admin.blocks.input_image_block',[
                        'head' => trans('admin.image_small'),
                        'name' => 'image_small',
                        'preview' => isset($action) ? $action->image_small : ''
                    ])
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin.blocks.select_multiple_block',[
                                'name' => 'brands_id',
                                'label' => trans('admin.brands_in_action'),
                                'values' => $brands,
                                'selectedIds' => $selected_ids,
                                'option' => 'name_'.app()->getLocale()
                            ])
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-6 col-sm-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('blocks.input_block', [
                                'label' => trans('admin.href'),
                                'required' => true,
                                'name' => 'slug',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('admin.href'),
                                'value' => isset($action) ? $action->slug : ''
                            ])
                            @include('blocks.input_block', [
                                'label' => trans('admin.name'),
                                'required' => true,
                                'name' => 'head',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('admin.name'),
                                'value' => isset($action) ? $action->head : ''
                            ])
                            @include('admin.blocks.textarea_block',[
                                'required' => true,
                                'name' => 'text',
                                'label' => trans('admin.content'),
                                'value' => isset($action) ? $action->text : ''
                            ])
                            @include('blocks.checkbox_block', [
                                'name' => 'active',
                                'checked' => isset($action) ? $action->active : true,
                                'label' => trans('admin.active')
                            ])
                            @include('admin.blocks.edit_button_block')
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="col-md-4 col-sm-6 col-sm-12">
            <div class="panel panel-flat">
                @include('admin.blocks.image_block',[
                    'preview' => $action->image_small,
                    'full' => $action->image
                ])
            </div>
        </div>
        <div class="col-md-8 col-sm-6 col-sm-12">
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    @include('admin.blocks.active_status_block',['active' => $action->active])
                </div>
                <div class="panel-body">
                    {!! $action->text !!}
                </div>
            </div>
        </div>
    @endcan
    @if (isset($action))
        <div class="col-12">
            <div class="panel panel-flat">
                <x-atitle>{{ trans('admin.action_faq') }}</x-atitle>
                <div class="panel-body">
                    @include('admin.blocks.datatable_block',[
                        'items' => $action->questions,
                        'route' => 'action_questions',
                        'parentId' => $action->id,
                        'columns' => ['question', 'answer', 'active'],
                        'addMode' => Gate::allows('edit'),
                        'editMode' => Gate::allows('edit'),
                        'deleteMode' => Gate::allows('delete'),
                        'addButtonText' => trans('admin.add_action_question')
                    ])
                </div>
            </div>
        </div>
    @endif
@endsection
