@extends('layouts.main')

@section('content')
    <x-section class="pb-0">
        <x-head level="1">
            {{ $repair->head.' ' }}
            @if (isset($brand))
                @include('issues.blocks.car_name_block', ['simple' => false])
            @endif
        </x-head>

        <?php $count = 0; ?>
        <div id="indicator">
            <div class="dial left">
                @for ($i=0;$i<count($left_digits);$i++)
                    <div class="digits" style="margin-top:{{ $left_digits[$i]['top'] }}px; left:{{ $left_digits[$i]['indent'].($i < 6 ? 'px' : '') }}; {{ $i == 6 ? 'transform:translate(-50%);' : '' }}">{{ $price_step * $count }}</div>
                    <?php $count++; ?>
                @endfor
                @for ($i=count($left_digits)-2;$i>=0;$i--)
                    <?php $count++; ?>
                    <div class="digits" style="margin-top:{{ $left_digits[$i]['top'] }}px; right:{{ $left_digits[$i]['indent'] }}px; {{ $i<=2 ? 'color:red;' : '' }}">{{ $price_step * $count }}</div>
                @endfor
                <div class="arrow" style="transform:rotate(60deg);"></div>
                <div class="center">
                    <div>
                        <div class="descr">{{ trans('indicator.price') }}</div>
                        <div class="value">
                            @include('issues.blocks.price_from_block')
                            {{ $price }}<span>₽</span>
                        </div>
                        <div class="old-price">
                            <img src="{{ asset('storage/images/indicator/red_line.svg') }}" />
                            @include('issues.blocks.price_from_block')
                            {{ $old_price }}<span>₽</span>
                        </div>
                    </div>
                </div>
                <div class="saving">
                    <span>{{ trans('indicator.saving') }}</span><br>
                    @include('issues.blocks.price_from_block')
                    {{ $old_price - $price }}<span>₽</span>
                </div>
            </div>
            <div class="middle-dial">
                {!! trans('indicator.recommendation') !!}
                @if ($repair->upon_reaching_years)
                    <div class="block first">
                        <img src="{{ asset('storage/images/indicator/sand_clock_icon.svg') }}" />
                        <div>@include('issues.blocks.upon_reaching_years_block')</div>
                    </div>
                @endif
                @if ($repair->upon_reaching_mileage)
                    <div class="block second"><img src="{{ asset('storage/images/indicator/wheel_icon.svg') }}" /><div>{{ $repair->upon_reaching_mileage }}<br><span>{{ trans('indicator.mileage') }}</span></div></div>
                @endif
                @if ($repair->upon_reaching_conditions)
                    <div class="block third"><img src="{{ asset('storage/images/indicator/tool_icon.svg') }}" /><div>{{ trans('indicator.general_condition') }}</div></div>
                @endif
                @if ($repair->free_diagnostics)
                    <div class="block fourth">{{ trans('indicator.free_diagnostics') }}</div>
                @endif
                @if ($repair->warranty_years)
                    <div class="block fifth">@include('issues.blocks.warranty_years_block')</div>
                @endif
            </div>
            <div class="dial right">
                @for ($i=0;$i<12;$i++)
                    <?php
                    $style = '';
                    foreach ($right_digits[$i] as $name => $value) {
                        if (is_int($value)) $value .='px';
                        $style .= $name.':'.$value.'; ';
                    }
                    ?>
                    <div class="digits" style="{{ $style }}">{{ $i }}<span>{{ trans('indicator.hour') }}</span></div>
                @endfor
                <div class="arrow"></div>
                <div class="center">
                    <div class="descr">{{ trans('indicator.issue_duration') }}</div>
                    <div class="value">~{{ $repair->work_time }}<span>{{ trans('indicator.hour') }}</span></div>
                </div>
            </div>
        </div>
        <p class="w-100 mt-3 text-center"><b>{!! trans('indicator.you_can_wait') !!}</b></p>
    </x-section>

    @if (count($repair->subRepairs))
        <x-section>
            <div class="rounded-block">
                <ul class="price w-100">
                    @foreach ($repair->subRepairs as $subRepair)
                        @include('blocks.price_item_block',[
                            'name' => $subRepair->name,
                            'value' => $subRepair->price
                        ])
                    @endforeach
                </ul>
            </div>
        </x-section>
    @endif

    @if (count($repair->images))
        <x-section class="gray">
            @include('issues.blocks.carousel_repair_images_block')
        </x-section>
    @endif

    <x-section class="parts-content">
        @if ($repair->text)
            <x-head level="1">{{ trans('content.description') }}</x-head>
            <div class="short-content">
                <div class="pull-right widget-google ms-2">
                    @include('blocks.widget_rating_block')
                </div>
                @php preg_match('/^(.+?)((<\/div>)|(<\/p>)|(<\/ul>)|(<\/details>))/i', str_replace(["\n","\r"],'',$repair->text), $matches); @endphp
                {!! preg_replace('/<div\s.+?<\/div>/i','',$matches[0]) !!}
{{--                @include('blocks.cropped_content_block',['content' => $repair->text, 'length' => 700])--}}
            </div>
            @include('blocks.button_block',[
                'primary' => false,
                'addClass' => 'mt-3 show-more',
                'buttonText' => trans('content.details')
            ])
            <div class="full-content">
                <div class="pull-right widget-google ms-2">
                    @include('blocks.widget_rating_block')
                </div>
                {!! $repair->text !!}
            </div>
            @include('blocks.button_block',[
                'primary' => false,
                'addClass' => 'float-end d-none hide-more',
                'buttonText' => trans('content.collapse')
            ])
        @else
            <div class="widget-google">
                @include('blocks.widget_rating_block')
            </div>
        @endif
    </x-section>

    @if (count($repair->recommendedWorks))
        <x-section class="gray">
            <x-head level="2" class="mt-4">{{ trans('content.we_recommend_with_this_work') }}</x-head>
            <x-table class="simple">
                @include('issues.blocks.repair_table.table_list_repair_head_block')
                @foreach($repair->recommendedWorks as $recommendedWork)
                    @if ($recommendedWork->work->active)
                        @include('issues.blocks.repair_table.table_list_repair_item_block', [
                            'car' => $recommendedWork->work->car,
                            'item' => $recommendedWork->work
                        ])
                    @endif
                @endforeach
            </x-table>
        </x-section>
    @endif

    @if (count($repair->spares))
        <x-section>
            <x-head level="2">{{ trans('content.you_can_purchase_the_necessary_spare_parts_from_us') }}</x-head>
            <div class="w-100 d-flex align-items-center justify-content-center">
                @if ($repair->spares_image)
                    <div class="col-md-3 col-sm-4 col-xs-12 framed-image">
                        <a href="{{ asset($repair->spares_image) }}" class="fancybox">
                            <img src="{{ asset($repair->spares_image) }}" />
                        </a>
                    </div>
                @endif
                <ul>
                    @foreach ($repair->spares as $spare)
                        <li>{{ $spare->head }}</li>
                    @endforeach
                </ul>
            </div>
        </x-section>
    @endif

    <x-section class="pt-0">
        @include('blocks.online_record_block',[
            'type' => 'online_appointment_for_repair'
        ])
    </x-section>

    <script>
        window.timeIndicator = parseInt("{{ $repair->work_time * 30 }}");
    </script>
@endsection
