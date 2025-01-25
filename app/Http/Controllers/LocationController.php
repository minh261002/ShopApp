<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Địa chỉ
 */

class LocationController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $get = $request->input();

        $html = '';
        if ($get['target'] == 'districts') {
            $province = Province::with('districts')->where('code', $get['data']['location_id'])->first();
            $html = $this->renderHtml($province->districts);
        } else if ($get['target'] == 'wards') {
            $district = District::with('wards')->where('code', $get['data']['location_id'])->first();
            $html = $this->renderHtml($district->wards, '[Chọn Phường / Xã]');
        }
        $response = [
            'html' => $html
        ];
        return response()->json($response);
    }

    public function renderHtml($districts, $root = '[Chọn Quận / Huyện]')
    {
        $html = '<option value="0">' . $root . '</option>';
        foreach ($districts as $district) {
            $html .= '<option value="' . $district->code . '">' . $district->name_with_type . '</option>';
        }
        return $html;
    }

    /**
     * Tỉnh/Thành phố
     *
     * Lấy danh sách tỉnh/thành phố
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getProvinces()
    {
        $provinces = Province::all();
        return response()->json($provinces);
    }

    /**
     * Quận/Huyện
     *
     * Lấy danh sách quận/huyện theo mã tỉnh/thành phố
     *
     * @urlParam province_code required Mã tỉnh/thành phố Example: 01
     *
     * @param mixed $province_code
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getDistricts($province_code)
    {
        $districts = District::where('parent_code', $province_code)->get();
        return response()->json($districts);
    }

    /**
     * Phường/Xã
     *
     * Lấy danh sách phường/xã theo mã quận/huyện
     *
     * @urlParam district_code required Mã quận/huyện Example: 001
     *
     * @param mixed $district_code
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getWards($district_code)
    {
        $wards = Ward::where('parent_code', $district_code)->get();
        return response()->json($wards);
    }
}