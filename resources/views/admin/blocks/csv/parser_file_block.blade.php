<div class="panel panel-flat">
    <div class="panel-heading">
        <h4 class="panel-title">{{ $head }}</h4>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" enctype="multipart/form-data" action="{{ $url }}" method="post">
            @csrf
            @include('admin.blocks.input_file_block', [
                'label' => $head,
                'name' => $name
            ])
            @include('blocks.button_block', [
                'buttonType' => 'submit',
                'addClass' => 'pull-right',
                'icon' => 'icon-file-upload',
                 'buttonText' => trans('admin.send')
             ])
        </form>
    </div>
</div>
