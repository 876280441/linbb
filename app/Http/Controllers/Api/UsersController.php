<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends ApiController
{
    public function store(UserRequest $request)
    {
        $cacheKey = 'verificationCode_'.$request->verification_key;
        $verifyData = \Cache::get($cacheKey);

        if (!$verifyData) {
            return $this->error(403,'验证码已失效');
        }

        if (!hash_equals($verifyData['code'], $request->verification_code)) {
            return $this->error(401,'验证码错误');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $verifyData['phone'],
            'password' => $request->password,
        ]);

        // 清除验证码缓存
        \Cache::forget($cacheKey);
        return $this->success(200,'注册成功', (array)new UserResource($user));
    }
}
