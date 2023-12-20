@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_site_map') }}" method="post">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-body button-settings">
                        @include('blocks.button_block', [
                            'buttonType' => 'submit',
                            'icon' => ' icon-floppy-disk',
                            'buttonText' => trans('admin.create_sitemap_xml')
                        ])
                    </div>
                </div>
                @if ($sitemap)
{{--                    <div class="panel panel-flat">--}}
{{--                        <x-atitle>--}}
{{--                            <h2 class="panel-title">{{ trans('admin.find_urls',['urls' => count((array)$sitemap->url)]).' '.trans('admin.pages', count((array)$sitemap->url)) }}</h2>--}}
{{--                        </x-atitle>--}}
{{--                    </div>--}}
                    <div class="panel panel-flat">
                        <div class="site-map-root-tag"><span class="bkt">{{ '<' }}</span>urlset <span class="red">xmlns</span>=<span class="red"><b>"http://www.sitemaps.org/schemas/sitemap/0.9"</b></span><span class="bkt">{{ '>' }}</span>
                        @foreach($sitemap->url as $url)
                            <div class="site-map-url-tag"><span class="bkt">{{ '<' }}</span>url<span class="bkt">{{ '>' }}</span></div>
                                @include('admin.blocks.sitemap_colors_tags_block',['className' => 'site-map-tag', 'tagName' => 'loc', 'value' => $url->loc])
                                @include('admin.blocks.sitemap_colors_tags_block',['className' => 'site-map-tag', 'tagName' => 'lastmod', 'value' => $url->lastmod])
                                @include('admin.blocks.sitemap_colors_tags_block',['className' => 'site-map-tag', 'tagName' => 'priority', 'value' => $url->priority])
                                @include('admin.blocks.sitemap_colors_tags_block',['className' => 'site-map-tag', 'tagName' => 'changefreq', 'value' => $url->changefreq])
                            <div class="site-map-url-tag"><span class="bkt">{{ '</' }}</span>url<span class="bkt">{{ '>' }}</span></div>
                        @endforeach
                        <div class="site-map-root-tag"><span class="bkt">{{ '</' }}</span>urlset<span class="bkt">{{ '>' }}</span></div>
                    </div>
                @endif
            </form>
        </div>
    </div>

@endsection
