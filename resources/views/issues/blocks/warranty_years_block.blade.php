{{ trans('indicator.warranty_years'.($repair->warranty_years <= 4 ? '1' : '2'), ['years' => $repair->warranty_years]) }}
