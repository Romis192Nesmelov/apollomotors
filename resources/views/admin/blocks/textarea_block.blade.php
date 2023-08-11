<x-incover
    name="{{ $name }}"
    required="{{ isset($required) && $required }}"
    error="{{ count($errors) && $errors->has($name) ? $errors->first($name) : '' }}"
    label="{{ isset($label) && $label ? $label : ''  }}"
>
    <textarea class="form-control {{ !isset($simple) || !$simple ? 'ckeditor' : 'simple' }}" name="{{ $name }}" {{ isset($disabled) && $disabled ? 'disabled=disabled' : '' }}>{{ count($errors) ? old($name) : (isset($value) ? $value : '') }}</textarea>
</x-incover>
