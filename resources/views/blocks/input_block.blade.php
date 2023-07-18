<div class="form-group">
    @if (isset($label) && $label)
        <label for="{{ $name }}">{{ $label }} {{ $required ? '<sup>*</sup>' : '' }}</label>
    @endif
    <input type="{{ isset($type) && $type ? $type : 'text' }}" name="{{ $name }}" value="{{ old($name, '') }}" class="form-control {{ isset($icon) && $icon ? 'has-icon' : '' }} @error($name) error @enderror" placeholder="{{ isset($placeholder) && $placeholder ? $placeholder : '' }}">

    @if (isset($icon) && $icon)
        <i class="{{ $icon }}"></i>
    @endif

    @if (isset($ajax))
        @include('blocks.error_block')
    @else
        @error($name)
            @include('blocks.error_block')
        @enderror
    @endif
</div>
