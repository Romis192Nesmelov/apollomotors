<a href="#" {{ $attributes->has('id') ? 'id='.$attributes->get('id') : '' }} {{ $attributes->class('') }} data-bs-toggle="modal" data-bs-target="#{{ $attributes->get('modal') }}">{{ $slot }}</a>
