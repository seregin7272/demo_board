<?php

use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Router\AdvertsPath;
use App\Entity\Page;
use App\Http\Router\PagePath;

if (! function_exists('adverts_path')) {

    function adverts_path(?Region $region, ?Category $category)
    {


          $res =   app()->make(AdvertsPath::class)
            ->withRegion($region)
            ->withCategory($category);


        return $res;
    }
}

if (! function_exists('page_path')) {

    function page_path(Page $page)
    {
        return app()->make(PagePath::class)
            ->withPage($page);
    }
}