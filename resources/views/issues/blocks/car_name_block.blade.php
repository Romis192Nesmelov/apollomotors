@if ($simple)
    @include('issues.blocks.brand_name_block', ['simple' => true, 'brand' => $car->brand])
    {{ $car['name_'.app()->getLocale()] }}
@else
    @include('issues.blocks.brand_name_block', ['simple' => true, 'brand' => $car->brand])
    {{ $car['name_'.(app()->getLocale() == 'en' ? 'en' : 'ru')].' ('.$car->brand['name_'.(app()->getLocale() == 'en' ? 'ru' : 'en')].' '.$car['name_'.(app()->getLocale() == 'en' ? 'ru' : 'en')].')' }}
@endif
