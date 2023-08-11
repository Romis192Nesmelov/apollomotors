<a href="{{ $href }}">@include('blocks.button_block', [
    'primary' => true,
    'type' => 'button',
    'icon' => 'icon-database-add',
    'buttonText' => $text,
    'addClass' => (isset($addClass) ? $addClass.' ' : '').'pull-right'])
</a>
