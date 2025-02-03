<?php

namespace App\Http\Controllers;

use App\Enums\ActiveStatus;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Discount\DiscountRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Slider\SliderRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $sliderRepository;
    protected $categoryRepository;
    protected $discountRepository;
    protected $productRepository;

    public function __construct(
        SliderRepositoryInterface $sliderRepository,
        CategoryRepositoryInterface $categoryRepository,
        DiscountRepositoryInterface $discountRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->sliderRepository = $sliderRepository;
        $this->categoryRepository = $categoryRepository;
        $this->discountRepository = $discountRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $slider = $this->sliderRepository->getByQueryBuilder(['key' => 'home_slider', 'status' => ActiveStatus::Active->value], ['items'])->first();
        $homeCategories = $this->categoryRepository->getByQueryBuilder(['show_home' => true, 'status' => ActiveStatus::Active->value], [])->paginate(5);
        $homeDiscounts = $this->discountRepository->getByQueryBuilder(['show_home' => true, 'status' => ActiveStatus::Active->value], [])->paginate(6);

        $newProducts = $this->productRepository->getByQueryBuilder(['status' => ActiveStatus::Active->value], ['categories',])->orderBy('created_at', 'desc')->limit(10)->get();
        $viewedProducts = $this->productRepository->getByQueryBuilder(['status' => ActiveStatus::Active->value], ['categories'])->orderBy('viewed', 'desc')->limit(10)->get();

        return view(
            'client.home.index',
            [
                'slider' => $slider,
                'homeCategories' => $homeCategories,
                'homeDiscounts' => $homeDiscounts,
                'newProducts' => $newProducts,
                'viewedProducts' => $viewedProducts,
            ]
        );
    }
}