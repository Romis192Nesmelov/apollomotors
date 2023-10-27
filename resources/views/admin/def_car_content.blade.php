@extends('layouts.admin')

@section('content')

    @can('delete')
        @include('admin.blocks.modal_delete_block',[
            'id' => 'delete-modal-repair',
            'action' => 'delete_repair',
            'head' => trans('admin.do_you_really_want_delete_this_position')
        ])
    @endcan

    @can('edit')
        <form class="form-horizontal" action="{{ route('admin.edit_def_car') }}" method="post">
            @csrf
            @include('admin.blocks.hidden_id_block',['hiddenName' => 'slug', 'value' => $content[0]->slug])
            @include('admin.blocks.seo_block',['item' => $content[0]->seo])
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    @include('blocks.input_block', [
                        'label' => trans('admin.head'),
                        'required' => true,
                        'name' => 'head',
                        'type' => 'text',
                        'max' => 255,
                        'placeholder' => trans('admin.head'),
                        'value' => $content[0]->head
                    ])
                    @include('admin.blocks.textarea_block',[
                        'required' => true,
                        'name' => $content[0]->slug == 'repair' ? 'text1' : 'text',
                        'label' => trans('admin.content'),
                        'value' => $content[0]->text
                    ])

                    @if ($content[0]->slug == 'repair')
                        <div class="panel panel-flat">
                            <x-atitle>{{ trans('content.repair_prices', ['car' => trans('admin.by_def_car')]) }}</x-atitle>
                            <div class="panel-body">
                                @include('admin.blocks.datatable_block',[
                                    'items' => $content[0]->priceRepairs,
                                    'route' => 'def_repairs',
                                    'columns' => ['head', 'price','active'],
                                    'addMode' => Gate::allows('edit'),
                                    'editMode' => Gate::allows('edit'),
                                    'deleteMode' => Gate::allows('delete'),
                                    'modal' => 'delete-modal-repair',
                                    'addButtonText' => trans('admin.add_repair')
                                ])
                            </div>
                        </div>

                        @include('admin.blocks.textarea_block',[
                             'required' => true,
                             'name' => 'text2',
                             'label' => trans('admin.content'),
                             'value' => $content[1]->text
                         ])
                    @endif

                    @include('admin.blocks.edit_button_block')
                </div>
            </div>
        </form>
    @else
        <div class="panel panel-flat">
            @include('admin.blocks.title_block')
            <div class="panel-body">
                {!! $content[0]->text !!}
                @if ($content[0]->slug == 'repair')
                    {!! $content[1]->text !!}
                @endif
            </div>
        </div>
    @endcan
@endsection
