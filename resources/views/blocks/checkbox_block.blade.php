<?php if (isset($addAttr) && is_array($addAttr)) {
    $attrStr = '';
    foreach ($addAttr as $attr => $value) {
        $attrStr .= $attr.'="'.$value.'"';
    }
}
?>
<div class="form-group mt-3 {{ isset($addClass) && $addClass ? $addClass : '' }}" @if (isset($attrStr) && $attrStr) {!! $attrStr !!} @endif >
    <label class="checkbox-inline">
        <input class="styled" type="checkbox" name="{{ $name }}" {{ !count($errors) ? (isset($checked) && $checked ? 'checked=checked' : '') : (old($name) == 'on' ? 'checked=checked' : '') }} {{ isset($disabled) && $disabled ? 'disabled=disabled' : '' }}>
        @if (isset($label) && $label)
            {!! $label !!}
        @endif
    </label>
    @include('blocks.error_block')
</div>
