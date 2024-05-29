<?php

namespace App\Http\Controllers\Admin;
use App\Models\Action;
use App\Models\Article;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use SimpleXMLElement;

class AdminEditSiteMapController extends AdminEditController
{
    private $siteMapXML;

    public function editSiteMap(): RedirectResponse
    {
        $this->siteMapXML = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');
        $loc = Config::get('app.url');

        $this->addChildUrl($loc, time(),1);
        $this->addChildUrl($loc.'/'.str()->slug('о компании'),time(),1);
        $this->addChildUrl($loc.'/'.str()->slug('корпоративным клиентам'),time(),1);
        $this->addChildUrl($loc.'/'.str()->slug('контакты'),time(),1);

        $actions = Action::where('active',1)->get();
        foreach ($actions as $action) {
            $this->addChildUrl($loc.'/'.str()->slug('акции').'/'.$action->slug,time(),1);
        }

//        $homeBlocks = $this->getHomeBlocks();
//        foreach ($homeBlocks as $block) {
//            $this->addChildUrl($loc.'/'.$block->slug, $block->updated_at->timestamp,1);
//        }

        $brands = Brand::where('active',1)->get();
        foreach (['ремонт', 'техобслуживание', 'запчасти'] as $k => $menu) {
            foreach ($brands as $brand) {
                $urlMenu = $loc . '/' . str()->slug($menu) . '/' . strtolower($brand->name_en) . '/';
                $this->addChildUrl($urlMenu, time(), 0.5);

                foreach ($brand->cars as $car) {
                    $urlCar = $urlMenu . $car->slug;
                    $this->addChildUrl($urlCar, time(), 0.3);

                    if ($k == 0 && count($car->repairs)) {
                        foreach ($car->priceRepairs as $priceRepair) {
                            $this->addChildUrl($urlCar . '/' . $priceRepair->slug, time(), 0.2);
                        }
                    } elseif ($k == 2 && count($car->spares)) {
                        foreach ($car->spares as $spare) {
                            if ($spare->text) {
                                $this->addChildUrl($urlCar . '/' . $spare->slug, time(), 0.2);
                            }
                        }
                    }
                }
            }
        }

        $articles = Article::where('active',1)->get();
        $this->addChildUrl($loc.'/article', $articles[count($articles)-1]->updated_at->timestamp, 0.5);

        foreach ($articles as $article) {
            $this->addChildUrl($loc.'/article/'.$article->slug, $article->updated_at->timestamp, 0.1);
        }

        if (file_exists(Config::get('app.sitemap_xml'))) unlink(Config::get('app.sitemap_xml'));
        $this->siteMapXML->asXML(Config::get('app.sitemap_xml'));

        return redirect(route('admin.site_map'));
    }


    private function addChildUrl($loc, $timeChange, $priority): void
    {
        $changefreq = 'hourly';
        $url = $this->siteMapXML->addChild('url');
        $url->addChild('loc',$loc);
        $url->addChild('lastmod',date('Y-m-d\TH:m:s'.'+03:00',$timeChange));
        $url->addChild('priority',$priority);
        $url->addChild('changefreq',$changefreq);
    }
}
