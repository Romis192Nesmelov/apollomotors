{{ $repair->upon_reaching_years }}
@if (substr($repair->upon_reaching_years, -1) == 1)
    {{ trans('indicator.years1') }}
@else
    {{ trans('indicator.years2') }}
@endif
