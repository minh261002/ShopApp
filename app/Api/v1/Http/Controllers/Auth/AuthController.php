<?php

namespace App\Api\V1\Http\Controllers\Auth;

use App\Api\V1\Http\Requests\Auth\ForgotPasswordRequest;
use App\Api\V1\Http\Requests\Auth\LoginRequest;
use App\Api\V1\Http\Requests\Auth\RegisterRequest;
use App\Api\V1\Http\Resources\Auth\LoginResource;
use App\Api\V1\Http\Resources\User\UserResource;
use App\Http\Controllers\Controller;
use App\Mail\UserSendResetLinkMail;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


/**
 * @group Xác thực
 */

class AuthController extends Controller
{
    /**
     * Đăng nhập
     *
     * @bodyParam email string required Email đăng nhập. Example:admin@gmail.com
     * @bodyParam password string required Mật khẩu đăng nhập. Example:password
     *
     * @param LoginRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'status' => 401,
                'error' => 'Thông tin đăng nhập không chính xác',
            ], );
        }

        $user = auth()->guard('api')->user();
        $cookie = $this->setAccessTokenAndRefreshToken($token);

        $accessTokenCookie = $cookie['tokenCookie'];

        return $this->respondWithToken($token, $user)->withCookie($accessTokenCookie);
    }

    /**
     * Đăng ký tài khoản
     *
     * @bodyParam email string required Email đăng nhập. Example:
     * @bodyParam password string required Mật khẩu đăng nhập. Example:
     * @bodyParam password_confirmation string required Nhập lại mật khẩu. Example:
     * @bodyParam name string required Tên. Example:
     *
     * @param RegisterRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */

    public function register(RegisterRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = bcrypt($data['password']);

            $user = User::create($data);
            $user = User::find($user->id);

            $token = auth()->guard('api')->login($user);
            $cookie = $this->setAccessTokenAndRefreshToken($token);
            $accessTokenCookie = $cookie['tokenCookie'];

            return $this->respondWithToken($token, $user)->withCookie($accessTokenCookie);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Đăng ký không thành công',
            ], 401);
        }
    }

    /**
     * Thông tin cá nhân
     *
     * @authenticated
     *
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function me()
    {
        try {
            auth()->guard('api')->login(auth()->guard('api')->user());

            return response()->json([
                'user' => new UserResource(auth()->guard('api')->user()),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Token không hợp lệ',
            ], 401);
        }
    }

    /**
     * Đăng xuất
     *
     * @authenticated
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard('api')->logout();

        $cookie = Cookie::forget('access_token');

        return response()->json(['message' => 'Đăng xuất thành công'])->withCookie($cookie);
    }


    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'user' => new LoginResource($user),
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    private function setAccessTokenAndRefreshToken($token)
    {
        $cookie = Cookie::make(
            'access_token',
            $token,
            52560000,
            "/",
            null,
            true,
            true,
            false,
            "None"
        );

        return [
            'tokenCookie' => $cookie,
        ];
    }

    /**
     * Quên mật khẩu
     * @return void
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $data = $request->validated();

        $email = $data['email'];
        $device = $data['device'];
        $time = $data['time'];

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email không tồn tại!',
            ], 404);
        }

        if ($user->status == 1) {
            return response()->json([
                'message' => 'Tài khoản đã bị khóa!',
            ], 404);
        }
        ;

        $token = Str::random(60);
        //kiểm tra created_at trong bảng password_reset_tokens
        $check = DB::table('password_reset_tokens')->where('email', $email)->first();

        //chỉ được gửi mail mỗi 3 phút
        if ($check) {
            //xoá token cũ
            DB::table('password_reset_tokens')->where('email', $email)->delete();

            //thêm token mới
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now(),
            ]);
        } else {
            //thêm token mới
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now(),
            ]);
        }

        Mail::to($email)->send(new UserSendResetLinkMail($token, $email, $user->name, $device, $time));

        return response()->json([
            'message' => 'Vui lòng kiểm tra email để lấy lại mật khẩu!',
        ], 200);
    }
}