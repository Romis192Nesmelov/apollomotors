<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-language" content="{{ app()->getLocale() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="yandex-verification" content="f89a759152b7b903" />

    <title>{{ isset($title) && $title ? $title : 'Apollomotors' }}</title>
    @if (isset($keywords) && $keywords)
        <meta name="keywords" content="{{ $keywords }}">
    @endif

    @if (isset($description) && $description)
        <meta name="description" content="{{ $description }}">
    @endif

    @include('blocks.favicon_block')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icons/fontawesome/styles.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icons/icomoon/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icons/fontawesome/styles.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fancybox.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.mCustomScrollbar.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/indicator.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/counter.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/contacts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://yastatic.net/share2/share.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.maskedinput.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/indicators.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/fancybox_init.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/owl_settings.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/max.height.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/loader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/feedback.js') }}"></script>
</head>

<body style="overflow-y: hidden">
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(25496474, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/25496474" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P8K2DXW" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-EPQKX93R99"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-EPQKX93R99');
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    var yaParams = {ip_adress: "{{ $_SERVER['REMOTE_ADDR'] }}"};
    //объявляем параметр ip_adress и записываем в него IP посетителя
</script>

<div id="loader"><div></div></div>

<x-modal id="message-modal" head="{{ trans('content.message') }}">
    <h3 class="text-center"></h3>
</x-modal>

<x-modal id="request-modal" head="???">
    <div class="online-record">
        @include('blocks.request_form_block',['textarea' => true, 'icon' => null])
    </div>
</x-modal>

<x-modal id="brands-modal">
    <div class="brands">
        @foreach ($electedBrands as $brand)
            <div class="brand-logo" style="width:{{ round(100/count($electedBrands)) }}%;">
                <a href="#" class="brand" brand="{{ $brand->slug }}"><img class="w-75" title="{{ $brand->ru }}" src="{{ asset($brand->logo) }}" /></a>
            </div>
        @endforeach
    </div>
    <p><a id="another-brand" href="#">{{ trans('content.another_brand') }}</a></p>
</x-modal>

<div id="feedback-plate">
    <div class="white-plate">
        @foreach ($contacts as $contact)
            @if ($contact->id >= 8 && $contact->id <= 10 && $contact->active)
                <a href="{{ $contact->contact }}" target="_blank"><i class="{{ $contact->icon.(strpos($contact->icon,'icon-') !== false ? ' icon' : '') }}"></i></a>
            @endif
        @endforeach

        @if ($contacts[3]->active)
            @include('blocks.email_block',[
                'email' => $contacts[3]->contact,
                'icon' => $contacts[3]->icon,
                'addClass' => strpos($contacts[3]->icon,'icon') !== false ? 'icon' : false
            ])
        @endif

        @if ($contacts[5]->active)
            @include('blocks.phone_block',[
                'phone' => $contacts[5]->contact,
                'icon' => $contacts[5]->icon,
                'addClass' => strpos($contacts[5]->icon,'icon') !== false ? 'icon' : false
            ])
        @endif
    </div>
    <a href="#" class="get-consult"><i class="icon-headset"></i></a>
    {{ trans('content.online') }}
    <div>{{ trans('content.consultation') }}</div>
</div>

<div id="top-line">
    <div class="container">
        @for ($i=0;$i<5;$i++)
            @if ($contacts[$i]->active && $contacts[$i]->id != 2 && $contacts[$i]->id != 4)
                <span class="contact{{ $i+1 }}"><i class="{{ $contacts[$i]->icon }}"></i>
                    @if ($contacts[$i]->id == 3)
                        @include('blocks.email_block',['email' => $contacts[$i]->contact, 'icon' => null])
                    @else
                        {{ $contacts[$i]->contact }}
                    @endif
                </span>
            @endif
        @endfor
    </div>
</div>
<div id="logo-line">
    <div class="container">
        <div class="logo-block">
            <div class="logo"><a href="{{ route('home') }}"><img class="w-100" src="{{ asset('storage/images/logo.svg') }}" /></a></div>
            <div class="tagline">{{ trans('content.tagline') }}</div>
        </div>
        <div class="search-block">
            <div class="w-100 ya-site-form ya-site-form_inited_no" data-bem="{&quot;action&quot;:&quot;{{ route('search') }}&quot;,&quot;arrow&quot;:false,&quot;bg&quot;:&quot;transparent&quot;,&quot;fontsize&quot;:14,&quot;fg&quot;:&quot;#000000&quot;,&quot;language&quot;:&quot;ru&quot;,&quot;logo&quot;:&quot;rb&quot;,&quot;publicname&quot;:&quot;Apollomotors&quot;,&quot;suggest&quot;:true,&quot;target&quot;:&quot;_self&quot;,&quot;tld&quot;:&quot;ru&quot;,&quot;type&quot;:2,&quot;usebigdictionary&quot;:true,&quot;searchid&quot;:2935064,&quot;input_fg&quot;:&quot;#000000&quot;,&quot;input_bg&quot;:&quot;#ffffff&quot;,&quot;input_fontStyle&quot;:&quot;normal&quot;,&quot;input_fontWeight&quot;:&quot;normal&quot;,&quot;input_placeholder&quot;:&quot;Поиск по сайту&quot;,&quot;input_placeholderColor&quot;:&quot;#000000&quot;,&quot;input_borderColor&quot;:&quot;#7f9db9&quot;}">
                <form action="https://yandex.ru/search/site/" method="get" target="_self" accept-charset="utf-8">
                    <input type="hidden" name="searchid" value="2935064"/>
                    <input type="hidden" name="l10n" value="ru"/>
                    <input type="hidden" name="reqenc" value=""/>
                    <input type="search" name="text" value="" style="padding: 5px;"/>
                    <input type="submit" value="{{ trans('content.search') }}" style="padding: 5px;"/>
                </form>
            </div>
{{--                @include('blocks.input_block',[--}}
{{--                    'type' => 'search',--}}
{{--                    'name' => 'text',--}}
{{--                    'placeholder' => trans('content.search'),--}}
{{--                    'icon' => 'icon-search4'--}}
{{--                ])--}}
            <div class="online-consult">
                <a href="#" class="get-consult">
                    <i class="icon-headset"></i>{{ trans('content.to_get_a_consultation') }}
                </a>
            </div>
        </div>
        <div class="phones-block">
            @foreach ($contacts as $contact)
                @if ( ($contact->id == 6 || $contact->id == 7) && $contact->active )
                    <div class="phone">
                        <i class="{{ $contact->icon }}"></i>
                        @include('blocks.phone_block',['phone' => $contact->contact, 'icon' => null])
                    </div>
                @endif
            @endforeach
            <div class="messengers">
                @foreach ($contacts as $contact)
                    @if ($contact->id > 7 && $contact->id < 12 && $contact->active)
                        <a href="{{ $contact->contact }}" target="_blank"><i class="{{ $contact->icon }}"></i></a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('blocks.main_nav_block', [
    'id' => 'main-nav',
    'useHome' => false,
    'nlAddClass' => 'brands'
])

@if (count($actions))
    <div id="actions-block" class="owl-carousel mt-3">
        @foreach ($actions as $action)
            @include('blocks.action_block')
        @endforeach
    </div>
@endif

@yield('content')

<p class="text-center mt-3"><b>{{ trans('content.share_the_page') }}</b></p>
<div class="ya-share2 text-center mb-4" data-services="vkontakte,facebook,skype,telegram,whatsapp"></div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-2 d-none d-lg-block p-0">
                <a href="{{ route('contacts') }}"><img class="w-100 border border-5 border-white" src="{{ asset('storage/images/apollomotors.jpg') }}" /></a>
            </div>
            @php $addressExistFlag = false; $blockContent = ''; ob_start(); @endphp
            @foreach ($contacts as $contact)
                @if ($contact->id < 8 && $contact->active && $contact->id != 2 && $contact->id != 4)
                    @php $addressExistFlag = true; @endphp
                    <i class="{{ $contact->icon }}"></i>
                    @if ($contact->id == 6 || $contact->id == 7)
                        @include('blocks.phone_block',['phone' => $contact->contact])
                    @else
                        {{ $contact->contact }}
                    @endif
                    <br>
                @endif
            @endforeach
            @php $content = '<p class="fs-7 ps-3 mb-3">'.ob_get_clean().'</p>'; @endphp

            @if ($addressExistFlag)
                @php $blockContent .= $content; @endphp
            @endif

            @php $snExistFlag = false; ob_start(); @endphp
            @foreach ($contacts as $contact)
                @if ($contact->id >= 11 && $contact->active)
                    @php $snExistFlag = true; @endphp
                    <a href="{{ $contact->contact }}" target="_blank"><i class="{{ $contact->icon }} fs-5"></i></a>
                @endif
            @endforeach
            @php $content = '<p class="fs-7 ps-3 mb-3">'.trans('content.we_are_in_social_networks').'<br>'.ob_get_clean().'</p>'; @endphp

            @if ($snExistFlag)
                @php $blockContent .= $content; @endphp
            @endif

            @php $messengersExistFlag = false; ob_start(); @endphp
            @foreach ($contacts as $contact)
                @if ($contact->id >= 8 && $contact->id <= 9 && $contact->active)
                    @php $messengersExistFlag = true; @endphp
                    <a href="{{ $contact->contact }}" target="_blank"><i class="{{ $contact->icon }} fs-5"></i></a>
                @endif
            @endforeach
            @php $content = '<p class="fs-7 ps-3">'.trans('content.write_to_messenger').'<br>'.ob_get_clean().'</p>'; @endphp

            @if ($messengersExistFlag)
                @php $blockContent .= $content; @endphp
            @endif

            @if ($blockContent)
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    {!! $blockContent !!}
                </div>
            @endif

            <div class="col-md-{{ $blockContent ? 2 : 3 }} d-none d-lg-block">
                <ul id="footer-menu">
                    @foreach ($menu as $menuItemKey => $menuItem)
                        @if ($menuItemKey != 'home')
                            @include('blocks.nav-item_block',[
                                'id' => 'footer-menu',
                                'nlAddClass' => 'brands'
                            ])
                        @endif
                    @endforeach
                    @include('blocks.nav-item_block',[
                        'id' => 'footer-menu',
                        'menuItemKey' => 'privacy-policy',
                        'menuItemKey' => 'privacy_policy',
                    ])
                </ul>
            </div>
            <div class="col-lg-{{ $blockContent ? 3 : 4 }} col-md-{{ $blockContent ? 6 : 12 }} col-sm-{{ $blockContent ? 6 : 12 }} col-xs-12 mb-2">
                <h3>{{ trans('content.record_for_repair') }}</h3>
                <form class="use-ajax" action="{{ route('request') }}" method="post">
                    @csrf
                    <input type="hidden" name="type" value="request_for_consultation">
                    @include('blocks.input_block',[
                        'name' => 'name',
                        'icon' => null,
                        'ajax' => true,
                        'placeholder' => trans('content.your_name')
                    ])
                    @include('blocks.input_block',[
                        'name' => 'phone',
                        'icon' => null,
                        'ajax' => true,
                        'placeholder' => '+7 (___) ___-__-__'
                    ])
                    @include('blocks.checkbox_block',[
                        'checked' => false,
                        'name' => 'i_agree',
                        'label' => trans('content.i_agree'),
                    ])
                    @include('blocks.button_block',[
                        'addClass' => 'mt-5',
                        'primary' => true,
                        'buttonType' => 'submit',
                        'buttonText' => trans('content.send')
                    ])
                </form>
            </div>
            <div class="col-lg-{{ $blockContent ? 2 : 3 }} col-xs-12 d-lg-block p-0 text-center">
                <img class="w-50 d-lg-inline-flex d-none" src="{{ asset('storage/images/logo_white.svg') }}" />
                <p class="fs-7 text-center text-uppercase">{{ trans('content.tagline') }}</p>
{{--                <div><iframe src="https://yandex.ru/sprav/widget/rating-badge/1634283920" width="150" height="50" frameborder="0"></iframe></div>--}}
                <div class="w-100 text-center mb-2">
                    @include('blocks.widget_rating_block',['addClass' => $blockContent ? 'w-50' : 'w-25'])
{{--                    <a href="https://search.google.com/local/writereview?placeid=ChIJlU4Dc35OtUYROm3efhYzXxo" target="_blank">--}}
{{--                        <img class="w-{{ $blockContent ? 50 : 25 }}" src="https://www.apollomotors.ru/images/google_reviews.jpg">--}}
{{--                    </a>--}}
                </div>
            </div>
            @include('blocks.hr_block')
            @if ($contacts[3]->active)
                <p class="fs-7 text-center mt-4">{!! trans('content.footer_text',['phone' => view('blocks.phone_block',['phone' => $contacts[6]->contact])->render(), 'email' => view('blocks.email_block',['email' => $contacts[3]->contact])->render()]) !!}</p>
            @endif
            <p class="fs-7 text-center mt-1"><a href="{{ asset('storage/requisites.pdf') }}" target="_blank">{{ trans('content.our_details') }}</a></p>
        </div>
    </div>
</footer>

<script type="text/javascript">(function(w,d,c){var s=d.createElement('script'),h=d.getElementsByTagName('script')[0],e=d.documentElement;if((' '+e.className+' ').indexOf(' ya-page_js_yes ')===-1){e.className+=' ya-page_js_yes';}s.type='text/javascript';s.async=true;s.charset='utf-8';s.src=(d.location.protocol==='https:'?'https:':'http:')+'//site.yandex.net/v2.0/js/all.js';h.parentNode.insertBefore(s,h);(w[c]||(w[c]=[])).push(function(){Ya.Site.Form.init()})})(window,document,'yandex_site_callbacks');</script>
<script>
    window.getConsultHead = "{{ trans('content.to_get_a_consultation') }}";
    window.onlineRegForPromo = "{{ trans('content.online_registration_for_the_promotion') }}";
    window.onlineRegForRepair = "{{ trans('content.online_appointment_for_repair') }}";
    window.onlineRegForMaintenance = "{{ trans('content.online_appointment_for_maintenance') }}";
</script>

</body>
</html>
