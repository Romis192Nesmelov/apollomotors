<div class="col-12">
    @include('blocks.button_block', [
        'buttonType' => 'submit',
        'primary' => true,
        'icon' => ' icon-floppy-disk',
        'buttonText' => trans('admin.save'),
        'addClass' => 'pull-right'
    ])
</div>
