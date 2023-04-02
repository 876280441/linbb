<?php

namespace App\Models\Traits;

Trait QueryBuilderBindable
{
    public function resolveRouteBinding($value,$field = '')
    {
        //检查对象或类是否具有属性
        $queryClass = property_exists($this, 'queryClass')
            ? $this->queryClass
            : '\\App\\Http\\Queries\\'.class_basename(self::class).'Query';

        if (!class_exists($queryClass)) {
            return parent::resolveRouteBinding($value);
        }

        return (new $queryClass($this))
            ->where($this->getRouteKeyName(), $value)
            ->first();
    }
}
