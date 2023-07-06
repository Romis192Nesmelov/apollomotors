<a href="#" {{ $attributes->has('id') ? 'id='.$attributes->get('id') : '' }} {{ $attributes->class('') }}>{{ $slot }}</a>
