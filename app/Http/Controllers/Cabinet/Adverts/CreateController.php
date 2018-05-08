<?php

namespace App\Http\Controllers\Cabinet\Adverts;

use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Controllers\Controller;
use App\Http\Requests\Adverts\CreateRequest;
use App\UseCases\Adverts\AdvertService;
use Illuminate\Support\Facades\Auth;

/**
 * @throws \DomainException
 * @throws \Throwable
 */

class CreateController extends Controller
{
    private $service;

    public function __construct(AdvertService $service)
    {
        $this->service = $service;
    }


    /* 1 шаг все категории */
    public function category()
    {
        $categories = Category::defaultOrder()->withDepth()->get()->toTree();

        return view('cabinet.adverts.create.category', compact('categories'));
    }

    /*
        Шаг2
        Мы в выбранной категории
        предлагаем выбор регионов
    */
    public function region(Category $category, Region $region = null)
    {
        $regions = Region::where('parent_id', $region ? $region->id : null)->orderBy('name')->get();

       // dump($category, $region, $regions);

        return view('cabinet.adverts.create.region', compact('category', 'region', 'regions'));
    }

    /*
        Шаг 3
        Форма объявления
    */

    public function advert(Category $category, Region $region = null)
    {
        return view('cabinet.adverts.create.advert', compact('category', 'region'));
    }

    /** @throws \Throwable */
    //Сохраняем через сервис
    public function store(CreateRequest $request, Category $category, Region $region = null)
    {
        try {
            $advert = $this->service->create(
                Auth::id(),
                $category->id,
                $region ? $region->id : null,
                $request
            );
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }
}
