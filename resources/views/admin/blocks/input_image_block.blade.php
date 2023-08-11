<div class="panel panel-flat edit-image-preview">
    @include('admin.blocks.image_block')
    <div class="panel-body">
        @include('admin.blocks.input_file_block', ['label' => '', 'name' =>  isset($name) && $name ? $name : 'image'])
    </div>
</div>
