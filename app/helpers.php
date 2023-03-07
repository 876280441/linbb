<?php

use Illuminate\Support\Facades\Route;

/**
 * 将当前请求的路由名称转换为 CSS 类名称
 * @return array|string|string[]|null
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * 焦点
 * @param $category_id
 * @return string
 */
function category_nav_active($category_id)
{
    return active_class((if_route('categories.show') && if_route_param('category', $category_id)));
}

/**
 * 过滤字符
 * @param $value '待过滤数据'
 * @param $length '长度'
 * @return \Illuminate\Support\Stringable|mixed|__anonymous@6424
 */
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str()->limit($excerpt, $length);
}
