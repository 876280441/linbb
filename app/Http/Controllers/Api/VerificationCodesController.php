<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Overtrue\EasySms\EasySms;

class VerificationCodesController extends ApiController
{
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
        $phone = $request->phone;
        if (!app()->environment('production')) {
            $code = '1234';
        }else{
            // 生成4位随机数，左侧补0
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);
            try {
                $result = $easySms->send($phone, [
                    'template' => config('easysms.gateways.aliyun.templates.register'),
                    'data' => [
                        'code' => $code
                    ],
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
                $message = $exception->getException('aliyun')->getMessage();
                return $this->error(-1,$message ?: '短信发送异常');
            }
        }


        $key = Str::random(15);
        $cacheKey = 'verificationCode_'.$key;
        $expiredAt = now()->addMinutes(5);
        // 缓存验证码 5 分钟过期。
        \Cache::put($cacheKey, ['phone' => $phone, 'code' => $code], $expiredAt);
        return $this->success(200,'获取成功',[
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
