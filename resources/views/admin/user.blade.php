@extends('layouts.admin')

@section('content')
    @can('edit')
        <form class="form-horizontal" action="{{ route('admin.edit_user') }}" method="post">
            @csrf
            @if (isset($user))
                @include('admin.blocks.hidden_id_block',['value' => $user->id])
            @endif
            <div class="col-md-4 col-sm-6 col-sm-12">
                <div class="panel panel-flat">
                    <x-atitle>{{ trans('admin.user_rights') }}</x-atitle>
                    <div class="panel-body">
                        @include('admin.blocks.radio_button_block',[
                            'values' => [
                                    ['val' => 1, 'descript' => trans('admin.users1')],
                                    ['val' => 2, 'descript' => trans('admin.users2')],
                                    ['val' => 3, 'descript' => trans('admin.users3')],
                                ],
                            'name' => 'type',
                            'activeValue' => isset($user) ? $user->type : 3
                        ])
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-6 col-sm-12">
                <div class="panel panel-flat">
                    @include('admin.blocks.title_block')
                    <div class="panel-body">
                        @include('blocks.input_block', [
                            'label' => 'E-mail',
                            'required' => true,
                            'name' => 'email',
                            'type' => 'email',
                            'max' => 100,
                            'placeholder' => 'E-mail',
                            'value' => isset($user) ? $user->email : ''
                        ])
                        <div class="panel panel-flat">
                            @if (isset($user))
                                <div class="panel-heading">
                                    <h4 class="text-grey-300">{{ trans('admin.if_you_doesnt_want_to_change_password') }}</h4>
                                </div>
                            @endif

                            <div class="panel-body">
                                @include('blocks.input_block', [
                                    'required' => false,
                                    'label' => trans('admin.user_password'),
                                    'name' => 'password',
                                    'type' => 'password',
                                    'max' => 50,
                                    'placeholder' => trans('admin.user_password'),
                                    'value' => ''
                                ])

                                @include('blocks.input_block', [
                                    'required' => false,
                                    'label' => trans('admin.confirm_password'),
                                    'name' => 'password_confirmation',
                                    'type' => 'password',
                                    'max' => 50,
                                    'placeholder' => trans('admin.confirm_password'),
                                    'value' => ''
                                ])
                            </div>
                        </div>
                        @include('admin.blocks.edit_button_block')
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h4>{{ trans('admin.user_rights') }}</h4>
                @include('admin.blocks.type_block', ['item' => $user])
            </div>
            <div class="panel-body">
                <h1>E-mail: {{ $user->email }}</h1>
            </div>
        </div>
    @endcan
@endsection
