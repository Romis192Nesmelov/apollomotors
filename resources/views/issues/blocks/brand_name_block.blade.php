@if ($simple)
    {{ $brand['name_'.app()->getLocale()] }}
@else
    {{ $brand['name_'.(app()->getLocale() == 'en' ? 'en' : 'ru')].' ('.$brand['name_'.(app()->getLocale() == 'en' ? 'ru' : 'en')].')' }}
@endif
