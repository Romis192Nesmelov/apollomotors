@if ($simple)
    @include('issues.blocks.brand_name_block', ['simple' => true, 'brand' => isset($car) && $car ? $car->brand : $brand])
    @if ($car)
        {{ $car['name_'.app()->getLocale()] }}
    @endif
@else
    @include('issues.blocks.brand_name_block', ['simple' => true, 'brand' => isset($car) && $car ? $car->brand : $brand])
    @if (isset($car) && $car)
        {{ $car['name_'.(app()->getLocale() == 'en' ? 'en' : 'ru')].' ('.$car->brand['name_'.(app()->getLocale() == 'en' ? 'ru' : 'en')].' '.$car['name_'.(app()->getLocale() == 'en' ? 'ru' : 'en')].')' }}
    @endif
@endif
