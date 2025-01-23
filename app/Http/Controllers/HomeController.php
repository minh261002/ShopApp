<?php

namespace App\Http\Controllers;

use App\Enums\ActiveStatus;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Discount\DiscountRepositoryInterface;
use App\Repositories\FlashSale\FlashSaleRepositoryInterface;
use App\Repositories\Slider\SliderRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $sliderRepository;
    protected $categoryRepository;
    protected $discountRepository;
    protected $flashSaleRepository;

    public function __construct(
        SliderRepositoryInterface $sliderRepository,
        CategoryRepositoryInterface $categoryRepository,
        DiscountRepositoryInterface $discountRepository,
        FlashSaleRepositoryInterface $flashSaleRepository
    ) {
        $this->sliderRepository = $sliderRepository;
        $this->categoryRepository = $categoryRepository;
        $this->discountRepository = $discountRepository;
        $this->flashSaleRepository = $flashSaleRepository;
    }

    public function index()
    {
        $slider = $this->sliderRepository->getByQueryBuilder(['key' => 'home_slider', 'status' => ActiveStatus::Active->value], ['items'])->first();
        $homeCategories = $this->categoryRepository->getByQueryBuilder(['show_home' => true, 'status' => ActiveStatus::Active->value], [])->paginate(5);
        $homeDiscounts = $this->discountRepository->getByQueryBuilder(['show_home' => true, 'status' => ActiveStatus::Active->value], [])->paginate(6);
        $flashSales = $this->flashSaleRepository->getByQueryBuilder(['status' => ActiveStatus::Active->value], ['items'])->get();

        return view(
            'client.home.index',
            [
                'slider' => $slider,
                'homeCategories' => $homeCategories,
                'homeDiscounts' => $homeDiscounts,
                'flashSales' => $flashSales
            ]
        );
    }
}