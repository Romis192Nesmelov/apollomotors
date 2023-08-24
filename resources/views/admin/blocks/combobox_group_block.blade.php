<x-incover
    name="{{ $name }}"
    required="{{ isset($required) && $required }}"
    error="{{ count($errors) && $errors->has($name) ? $errors->first($name) : '' }}"
    label="{{ isset($label) && $label ? $label : ''  }}"
>
    <select name="{{ $name }}" class="form-control ac-combo">
        @if (isset($useNull) && $useNull)
            <option value="0" {{ (!count($errors) ? !$selected : !old($name)) ? 'selected' : '' }}>{{ trans('admin.no') }}</option>
        @endif
        @foreach ($items as $value => $option)
            <option value="{{ $value }}" {{ (!count($errors) ? $value == $selected : $value == old($name)) ? 'selected' : '' }}>{{ $option }}</option>
        @endforeach
    </select>
</x-incover>
