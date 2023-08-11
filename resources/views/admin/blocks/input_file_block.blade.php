<x-incover
    name="{{ $name }}"
    required="{{ isset($required) && $required }}"
    error="{{ count($errors) && $errors->has($name) ? $errors->first($name) : '' }}"
    label="{{ isset($label) && $label ? $label : ''  }}"
>
    <input {{ isset($inputId) ? 'id='.$inputId : '' }} type="file" name="{{ $name }}" class="form-control">
</x-incover>
