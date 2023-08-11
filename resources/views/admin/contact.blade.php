@extends('layouts.admin')

@section('content')
    @can('edit')
        <form class="form-horizontal" action="{{ route('admin.edit_contact') }}" method="post">
            @csrf
            @include('admin.blocks.hidden_id_block',['id' => $contact->id])
            <div class="panel panel-flat">
                @include('admin.blocks.title_block')
                <div class="panel-body">
                    @include('blocks.input_block', [
                        'label' => trans('admin.contact'),
                        'required' => true,
                        'name' => 'contact',
                        'type' => 'text',
                        'max' => 255,
                        'placeholder' => trans('admin.contact'),
                        'value' => $contact->contact
                    ])
                    @include('blocks.checkbox_block', [
                        'name' => 'active',
                        'checked' => $contact->active,
                        'label' => trans('admin.active')
                    ])
                    @include('admin.blocks.edit_button_block')
                </div>
            </div>
        </form>
    @else
        <div class="panel panel-flat">
            @include('admin.blocks.title_block')
            <div class="panel-body">
                <h4><i class="{{ $contact->icon }}"></i> {{ $contact->contact }}</h4>
                @include('admin.blocks.active_status_block',['active' => $contact->active])
            </div>
        </div>
    @endcan
@endsection
