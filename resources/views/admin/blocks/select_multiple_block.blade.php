<x-incover
    name="{{ $name }}"
    required="{{ isset($required) && $required }}"
    error="{{ count($errors) && $errors->has($name) ? $errors->first($name) : '' }}"
    label="{{ isset($label) && $label ? $label : ''  }}"
>
    <select multiple="multiple" name="{{ $name }}[]" class="select form-control">
        @foreach ($values as $value)
            <option value="{{ $value->id }}" {{ in_array($value->id, $selectedIds) ? 'selected=selected' : '' }}>{{ $value[$option] }}</option>
        @endforeach
    </select>
</x-incover>
