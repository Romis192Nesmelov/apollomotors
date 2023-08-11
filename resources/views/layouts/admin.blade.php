<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apollomotors {{ trans('admin.admin_page').' '.$breadcrumbs[count($breadcrumbs)-1]['name'] }}</title>
    @include('blocks.favicon_block')
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icons/icomoon/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icons/fontawesome/styles.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/bootstrap-switch.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/bootstrap-toggle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fancybox.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/admin.css') }}">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('js/admin/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/core/libraries/bootstrap.min.js') }}"></script>
    <!-- /core JS files -->

{{--    <script type="text/javascript" src="{{ asset('js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('js/plugins/forms/inputs/typeahead/handlebars.min.js') }}"></script>--}}

    <script type="text/javascript" src="{{ asset('js/admin/plugins/tables/datatables/datatables.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/admin/plugins/ui/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/plugins/pickers/daterangepicker.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/admin/plugins/pickers/anytime.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/plugins/pickers/pickadate/picker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/plugins/pickers/pickadate/picker.date.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/admin/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/plugins/forms/styling/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/plugins/forms/styling/bootstrap-switch.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/plugins/forms/styling/bootstrap-toggle.min.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('js/admin/plugins/forms/selects/select2.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('js/admin/plugins/sliders/ion_rangeslider.min.js') }}"></script>--}}

    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.maskedinput.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/core/main.controls.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/loader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/admin.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('js/setbackground.js') }}"></script>--}}
</head>

<body>
@csrf
<x-modal id="message-modal" head="{{ trans('content.message') }}">
    <h2 class="text-center">{{ session()->has('message') ? session()->get('message') : '' }}</h2>
</x-modal>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            @include('admin.blocks.dropdown_menu_item_block',[
                'menuName' => auth()->user()->email,
                'menu' => [['href' => route('logout'), 'icon' => 'icon-switch2', 'text' => trans('admin.exit')]]
            ])

{{--            @include('admin.blocks._dropdown_menu_item_block',[--}}
{{--                'menuName' => trans('menu.language'),--}}
{{--                'icon' => 'icon-earth',--}}
{{--                'menu' => [--}}
{{--                    ['href' => route('change_lang',['lang' => 'ru']), 'text' => trans('menu.ru')],--}}
{{--                    ['href' => route('change_lang',['lang' => 'en']), 'text' => trans('menu.en')]--}}
{{--                ]--}}
{{--            ])--}}
        </ul>

    </div>
</div>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">

<!-- Page content -->
<div class="page-content">

<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <div class="media-body">
                        <div class="text-size-mini text-muted">
                            <i class="glyphicon glyphicon-user text-size-small"></i>
                            {{ trans('content.welcome') }}<br>{{ auth()->user()->email }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <!-- Main -->
                    @foreach ($menu as $k => $item)
                        @if (!$item['hidden'])
                            <li {{ $k == $menu_key ? 'class=active' : '' }}>
                                <a href="{{ route($item['href']) }}"><i class="{{ $item['icon'] }}"></i> <span>{{ $item['name'] }}</span></a>
                                @if (isset($menu['submenu']) && count($menu['submenu']))
                                    <ul>
                                        @foreach ($menu['submenu'] as $submenu)
                                            <li {{ $submenu['id'] == $breadcrumbs[count($breadcrumbs)-1]['id'] ? 'class=active' : '' }}>
                                                <a href="{{ route($submenu['href']) }}">{{ $submenu['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- /main navigation -->
    </div>
</div>
<!-- /main sidebar -->

<!-- Main content -->
<div class="content-wrapper">
    <!-- Page header -->
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4>
                    @foreach ($breadcrumbs as $breadcrumb)
                        @if ($loop->first)
                            <a {{ count($breadcrumbs) > 2 ? 'href='.route($breadcrumbs[count($breadcrumbs)-2]['href']) : '' }}><i class="icon-arrow-left52 position-left"></i></a>
                            <span class="text-semibold">
                                  @include('blocks.cropped_content_block',[
                                    'content' => '- '.$breadcrumb['name'],
                                    'length' => 30
                                  ])
                            </span>
                        @else
                            @include('blocks.cropped_content_block',[
                                'content' => '- '.$breadcrumb['name'],
                                'length' => 30
                              ])
                        @endif
                    @endforeach
                 </h4>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                @foreach ($breadcrumbs as $breadcrumb)
                    <li>
                        <a href="{{ isset($breadcrumb['params']) ? route($breadcrumb['href'],$breadcrumb['params']) : route($breadcrumb['href']) }}{{ isset($breadcrumb['slug']) ? '/'.$breadcrumb['slug'] : '' }}">
                            @include('blocks.cropped_content_block',[
                            'content' => $breadcrumb['name'],
                            'length' => 40
                        ])
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">@yield('content')</div>
    <!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->

@if (session()->has('message'))
    <script>window.showMessage = true;</script>
@endif

</body>

</html>
