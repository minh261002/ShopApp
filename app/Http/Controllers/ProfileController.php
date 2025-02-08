<?php

namespace App\Http\Controllers;

use App\Enums\Order\OrderStatus;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Repositories\Discount\DiscountRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Services\Profile\ProfileServiceInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    protected $service;
    protected $orderRepository;
    protected $discountRepository;

    public function __construct(
        ProfileServiceInterface $service,
        OrderRepositoryInterface $orderRepository,
        DiscountRepositoryInterface $discountRepository
    ) {
        $this->service = $service;
        $this->orderRepository = $orderRepository;
        $this->discountRepository = $discountRepository;
    }

    public function index()
    {
        $user = auth()->guard('web')->user();
        return view('client.profile.index', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        if ($this->service->updateProfile($request)) {
            return redirect()->back()->with('success', 'Cập nhật thông tin cá nhân thành công');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
        }
    }

    public function changePassword()
    {
        return view('client.profile.change-password');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        if ($this->service->updatePassword($request)) {
            return redirect()->back()->with('success', 'Cập nhật mật khẩu thành công');
        } else {
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
        }
    }

    public function order()
    {
        $orderStatus = OrderStatus::getValues();
        $statusDescriptions = [];
        foreach ($orderStatus as $status) {
            $statusDescriptions[$status] = OrderStatus::getDescription($status);
        }

        $status = request()->get('status');

        $orders = $this->orderRepository->getByQueryBuilder([
            'user_id' => auth()->guard('web')->id(),
        ]);

        if ($status) {
            $orders->where('status', $status);
        }
        $orders = $orders->orderBy('created_at', 'desc')->paginate(10);

        return view('client.profile.order', compact('statusDescriptions', 'orders'));
    }


    public function discount()
    {
        $user = auth()->guard('web')->user();
        $discounts = $user->discounts()->orderBy('created_at', 'desc')->paginate(10);
        return view('client.profile.discount', compact('discounts'));
    }
}