@extends('layouts.admin')

@section('content')
    @can('edit')
        <form class="form-horizontal" action="{{ $route }}" method="post">
            @csrf
            @include('admin.blocks.hidden_id_block',['value' => $item->id])

            @if ( ($relation == 'repairs' || $relation == 'maintenances') && isset($item->$relation[0]) && isset($item->$relation[0]->seo) )
                @php $seoItem = $item->$relation[0]->seo; @endphp
            @elseif (isset($item->$relation) && isset($item->$relation->seo))
                @php $seoItem = $item->$relation->seo; @endphp
            @else
                @php $seoItem = null; @endphp
            @endif
            @include('admin.blocks.seo_block',['item' => $seoItem])

            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    @if ($relation == 'repairs' || $relation == 'maintenances')
                        @include('admin.blocks.textarea_block',[
                            'required' => true,
                            'name' => 'text1',
                            'label' => trans('admin.content').' №1',
                            'value' => isset($item->$relation[0]) ? $item->$relation[0]->text : ''
                        ])
                        @include('admin.blocks.textarea_block',[
                            'required' => true,
                            'name' => 'text2',
                            'label' => trans('admin.content').' №2',
                            'value' => isset($item->$relation[1]) ? $item->$relation[1]->text : ''
                        ])
                    @else
                        @include('admin.blocks.textarea_block',[
                            'required' => true,
                            'name' => 'text',
                            'label' => trans('admin.content'),
                            'value' => isset($item->$relation) ? $item->$relation->text : ''
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
                @if ($relation == 'repairs' || $relation == 'maintenances')
                    @foreach ($item->$relation as $relation)
                        {!! $relation->text !!}
                    @endforeach
                @else
                    {!! $content->text !!}
                @endif
            </div>
        </div>
    @endcan
@endsection
