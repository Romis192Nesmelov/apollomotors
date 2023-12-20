<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class AdminSiteMapController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke() :View
    {
        $this->data['menu_key'] = 'site_map';
        $this->breadcrumbs[] = [
            'href' => 'admin.site_map',
            'params' => [],
            'name' => trans('admin_menu.site_map')
        ];
        $this->data['sitemap'] = file_exists(Config::get('app.sitemap_xml')) ? simplexml_load_file(Config::get('app.sitemap_xml')) : '';
        return $this->showView('site_map');
    }
}
