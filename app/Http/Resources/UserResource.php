<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * 是否过滤敏感数据
     * @var bool
     */
    protected bool $showSensitiveFields = false;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        if (!$this->showSensitiveFields) {
            //清除敏感数据
            $this->resource->makeHidden(['phone', 'email']);
        }
        $data =  parent::toArray($request);
        $data['bound_phone'] = (bool)$this->resource->phone;
        $data['bound_wechat'] = $this->resource->weixin_unionid || $this->resource->weixin_openid;
        return $data;
    }

    /**
     * 敏感数据过滤关闭
     * @return $this
     */
    public function showSensitiveFields(): static
    {
        $this->showSensitiveFields = true;

        return $this;
    }
}
