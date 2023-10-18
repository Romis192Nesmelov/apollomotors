@extends('layouts.admin')

@section('content')
    <form class="form-horizontal" action="{{ route('admin.add_repair_spare') }}" method="post">
        @csrf
        @include('admin.blocks.hidden_id_block',['hiddenName' => 'repair_id', 'value' => request()->parent_id])
        <div class="panel panel-flat">
            @include('admin.blocks.title_block')
            {{ request()->id }}
            <div class="panel-body">
                @include('admin.blocks.select_block',[
                    'name' => 'spare_id',
                    'values' => $free_spares,
                    'selected' => request()->has('id') ? request()->id : 1,
                    'option' => 'head'
                ])
                @include('admin.blocks.save_button_block')
            </div>
        </div>
    </form>
@endsection
