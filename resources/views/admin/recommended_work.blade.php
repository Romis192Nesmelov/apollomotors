@extends('layouts.admin')

@section('content')
    <form class="form-horizontal" action="{{ route('admin.add_recommended_work') }}" method="post">
        @csrf
        @include('admin.blocks.hidden_id_block',['hiddenName' => 'repair_id', 'value' => request()->parent_id])
        <div class="panel panel-flat">
            @include('admin.blocks.title_block')
            <div class="panel-body">
                @include('admin.blocks.select_block',[
                    'name' => 'work_id',
                    'values' => $free_works,
                    'selected' => 1,
                    'option' => 'head'
                ])
                @include('admin.blocks.save_button_block')
            </div>
        </div>
    </form>
@endsection
