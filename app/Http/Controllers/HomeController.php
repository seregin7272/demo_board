<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity\Region;
use App\Entity\Adverts\Category;
class HomeController extends Controller
{

    public function index()
    {
        $regions = Region::roots()->orderBy('name')->getModels();

        //dump($regions);

        $categories = Category::whereIsRoot()->defaultOrder()->getModels();

        return view('home', compact('regions', 'categories'));
    }
}
