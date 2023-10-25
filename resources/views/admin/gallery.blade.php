@extends('layouts.admin')

@section('content')
    @can('delete')
        @can('delete')
            @include('admin.blocks.modal_delete_block',[
                'action' => 'delete_image',
                'head' => trans('admin.do_you_really_want_delete_this_image')
            ])
        @endcan
    @endcan

    @if (Gate::allows('edit') && isset($lock) && !$lock)
        <div class="col-md-3 col-sm-6 col-sm-12">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('admin.add_image') }}" method="post">
                @csrf
                @include('admin.blocks.hidden_id_block',[
                    'hiddenName' => 'folder',
                    'value' => $base_folder
                ])
                @include('admin.blocks.input_image_block',[
                    'name' => 'image',
                    'preview' => ''
                ])
                <div class="panel panel-flat">
                    <div class="panel-body">
                        @include('blocks.button_block', [
                            'buttonType' => 'submit',
                            'primary' => true,
                            'icon' => ' icon-file-upload',
                            'buttonText' => trans('admin.upload'),
                            'addAttr' => ['style' => 'width:100%']
                        ])
                    </div>
                </div>
            </form>
        </div>
    @endif

    <div @if (Gate::allows('edit') && isset($lock) && !$lock) class="col-md-9 col-sm-6 col-sm-12" @endif>
        <div class="panel panel-flat">
            @include('admin.blocks.title_block')
            <div class="panel-body">
                <h5 class="text-uppercase">{{ trans('admin.folder',['folder' => $folder]) }}</h5>
                @if (isset($up_to))
                    <div class="panel-body">
                        <a href="{{ $up_to }}"><i class="icon-folder-upload" style="font-size: 2em;"></i></a>
                    </div>
                @endif
                <table class="table datatable-basic table-items">
                    <tr>
                        <th class="hidden"></th>
                        <th class="text-center">{{ trans('admin.type') }}</th>
                        <th class="text-center">{{ trans('admin.image') }}</th>
                        <th class="text-center">{{ trans('admin.path_to_image') }}</th>
                        <th class="text-center">{{ trans('admin.copy_to_clipboard') }}</th>
                        @include('admin.blocks.th_delete_cell_block')
                    </tr>
                    @foreach($objects as $object)
                        @if (!is_file($object) && !in_array(pathinfo($object)['basename'],$skipping_folders))
                            @include('admin.blocks.gallery_row_block',['isFile' => false])
                        @endif
                    @endforeach
                    @if (isset($up_to))
                        @foreach($objects as $object)
                            @if (is_file($object))
                                @include('admin.blocks.gallery_row_block',['isFile' => true])
                            @endif
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
