<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * 成功响应
     * @param int $code '状态码'
     * @param string $message '提示信息'
     * @param array $data '返回数据'
     * @return \Illuminate\Http\JsonResponse
     */
    public function success(int $code,string $message = '',array $data = [])
    {
        return response()->json(['code' => $code,'message' => $message,'data' => $data]);
    }

    /**
     * 错误响应
     * @param int $code '状态码'
     * @param string $message '响应信息'
     * @return \Illuminate\Http\JsonResponse
     */
    public function error(int $code,string $message = '')
    {
        return response()->json(['code' => $code,'message' => $message]);

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}
